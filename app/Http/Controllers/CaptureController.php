<?php

namespace App\Http\Controllers;

use App\Capture;
use App\CaptureLogistic;
use App\CaptureMaterial;
use App\construction;
use App\Provider;
use App\Product;
use App\Price;
use App\Fund;
use App\Logistic;
use App\Honorary;
use App\ProductsCapture;
use App\StatementMaterial;
use App\HonoraryRemaining;
use App\TemporaryCapture;
use App\Statement;
use App\TemporaryCaptureProduct;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use CArbon\Carbon;

class CaptureController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
  }
    //Category: 0=Mano de obra, 1=Material, 2=Logística
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('capture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructions = construction::select('id','name')->orderBy('name', 'asc')->get();
        $providers = DB::table('statements')
          ->select('providers.*', 'providers.id as provider_id', 'statements.*', 'statements.id as statement_id')
          ->join('providers', 'providers.id', '=', 'statements.provider_id')
          ->where('providers.status', '=', 1)
          ->where('providers.category', '!=', 1)
          ->orderBy('providers.name', 'asc')
          ->get();

        $providers_material = DB::table('statement_materials')
          ->select('statement_materials.*', 'statement_materials.id as statement_id', 'statement_materials.name as statement_name',
          'constructions.name as construction_name')
          ->join('constructions', 'constructions.id', '=', 'statement_materials.construction_id')
          ->get();

          for($i=0; $i<$providers->count(); $i++)
          {
            if($providers[$i]->category == 0)
              $providers[$i]->category = "Mano de obra";
            else if($providers[$i]->category == 1)
              $providers[$i]->category = "Material";
              else if($providers[$i]->category == 2)
                $providers[$i]->category = "Logística";
          }

          $missa = Provider::where('name', 'Arq. Missael Quintero')->first();
          if($missa != null)
          {
              if($missa->category == 0)
                $missa->category = "Mano de obra";
              else if($missa->category == 1)
                $missa->category = "Material";
                else if($missa->category == 2)
                  $missa->category = "Logística";
          }

        return view('capture.create')->with('constructions', $constructions)
                  ->with('providers', $providers)
                  ->with('missa',$missa)
                  ->with('providers_material',$providers_material);
    }

    public function create2(Request $request)
    {
        if($request->hasFile('voucher'))
            $request->voucher = $request->file('voucher')->store('public');

      $funds = DB::table('funds','constructions')
        ->select(
        'funds.id', 'funds.date', 'funds.remaining',
        'constructions.name')
        ->join('constructions', 'constructions.id', '=', 'funds.construction_id')
        ->where('funds.status', '=', 1)
        ->orderBy('constructions.name')
        ->get();

        /* $provider = Provider::where('id',$request->provider_id)->orderBy('name', 'asc')->first(); */
        $category = $request->category;
        if($category == 1)
        {
          //Borramos todos los temporales (de capturas y de productos)
          DB::table('temporary_captures')->delete();
          DB::table('temporary_capture_products')->delete();

          //Guardamos captura temporal
          $temporary_capture = CaptureController::saveTemporalCapture($request);
          if($temporary_capture == false)
          {
              $msg = [
                  'title' => 'Error!',
                  'text' => 'No cuenta con fondos en la base de datos',
                  'icon' => 'warning'
              ];
              return redirect('fund')->with('message', $msg);
          }

          
          $statement_material = StatementMaterial::where('id',$request->statemnt_material_id)->first();
          //dd($statement_material->providers[0]->products[0]->price);

          /* $prices = DB::table('products','prices')
            ->select(
            'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
            'prices.*')
            ->where('providers.id', '=', $request->provider_id)
            ->join('providers', 'providers.id', '=', 'products.provider_id')
            ->join('prices', 'prices.product_id', '=', 'products.id')
            ->where('prices.status', '=' , '1')
            ->orderBy('products.concept')
            ->get(); */
              //dd($request);

            
            /* $prices = DB::table('products','prices','statement_materials')
            ->select(
              'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
              'prices.*', 'prices.id as price_id')
            ->where('prices.status', '=' , '1')
            ->join('prices', 'prices.product_id', '=', 'products.id')
            ->join('products', 'products.provider_id', '=', 'providers.id')
            ->join('providers', 'providers.id', '=', 'statement_provider_materials.provider_id')
            ->join('statement_provider_materials', 'statement_provider_materials.statement_material_id', '=', 'statement_materials.id')
            ->where('statement_materials.id',$request->statemnt_material_id)
            ->orderBy('products.concept')
            ->groupBy('products')
            ->get(); */

          /* for($i=0; $i<$prices->count(); $i++)
          {
              $month = CaptureController::month($prices[$i]->month);
              $prices[$i]->month = $month;
              $prices[$i]->month .= " " . $prices[$i]->year;
          } */
          return view('capture.create_material')->with('data', $temporary_capture)->with('statement_material_id', $statement_material->id)->with('funds',$funds)->with('category',$category)->with('honorary_remaining', null)->with('provider_name',null)->with('statement_material', $statement_material);
        }
        else
        {
          $provider = Provider::where('id',$request->provider_id)->orderBy('name', 'asc')->first();
            $honorary_remaining = HonoraryRemaining::where('construction_id',$request->construction_id)->first();
            $honorary_remaining = $honorary_remaining->remaining;
            return view('capture.create_logistic')->with('data', $request)->with('funds',$funds)->with('category',$category)->with('honorary_remaining', $honorary_remaining)->with('provider',$provider)->with('provider_name',$provider->name)->with('statement_material_id', null);
        }
    }

    public function saveTemporalCapture($data)
    {
        $temporary_capture = (new TemporaryCapture)->fill( $data->all() );

        if($data->hasFile('voucher'))
            $temporary_capture->voucher = $data->file('voucher')->store('public');
          
        $temporary_capture->category = 1;

        $fund = Fund::first();

        if($fund != null)
        {
            $temporary_capture->fund_id = $fund->id;
            $temporary_capture->total = 0;
            $temporary_capture->statement_material_id = $data->statemnt_material_id;
            $temporary_capture->save();

            return $temporary_capture;
        }
        else
            return false;
    }

    public function month($month)
    {
          if($month == 1)
            $month = "Enero";
          else if($month == 2)
            $month = "Febrero";
            else if($month == 3)
              $month = "Marzo";
              else if($month == 4)
                $month = "Abril";
                else if($month == 5)
                  $month = "Mayo";
                  else if($month == 6)
                    $month = "Junio";
                    else if($month == 7)
                      $month = "Julio";
                      else if($month == 8)
                        $month = "Agosto";
                        else if($month == 9)
                          $month = "Septiembre";
                          else if($month == 10)
                            $month = "Octubre";
                            else if($month == 11)
                              $month = "Noviembre";
                              else if($month == 12)
                                $month = "Diciembre";
        return $month;
    }

    public function saveProduct(Request $request)
    {
        $provider_id = $request->provider_id;
        $product = New Product;
        $product->provider_id = $provider_id;
        $product->concept = $request->concept;
        $product->description = $request->description;
        $product->save();

        $price = New Price;
        $price->product_id = $product->id;
        $price->unity = $request->unity;
        $price->price = $request->price;
        $price->year = $request->year;
        $price->month = $request->month;
        $price->save();
        $msg = [
            'title' => 'Creado!',
            'text' => 'Producto creado exitosamente.',
            'icon' => 'success'
        ];
        return Redirect::back()->with('message', $msg);
        //return back()->with('message', $msg);
        //return back()->with('message', $msg);
        //return Redirect::to(URL::previous());

    }

    public function showTablePC(Request $request)
    {
        if($request->price != null && $request->quantity != 0)
        {
            $price_id="";
            $flag=false;
            for($i=0;$i<strlen($request->price);$i++){
              if($flag)
                $price_id .= $request->price[$i];
              if($request->price[$i] == "/")
                $flag=true;
            }

            $temporary_product = New TemporaryCaptureProduct;
            $temporary_product->price_id = $price_id;
            $temporary_product->capture_id = $request->capture_id;
            $temporary_product->quantity = $request->quantity;
            $temporary_product->total = $request->total;
            $temporary_product->extra = $request->extra;
            $temporary_product->save();
        }

        $toTable = DB::table('temporary_capture_products')
          ->select(
            'temporary_capture_products.id as temporary_id', 'temporary_capture_products.quantity', 'temporary_capture_products.extra', 'temporary_capture_products.total',
            'prices.id as price_id', 'prices.price', 'prices.unity',
            'products.id as product_id', 'products.concept'
          )
          ->where('temporary_capture_products.capture_id', '=', $request->capture_id)
          ->join('prices', 'prices.id', '=', 'temporary_capture_products.price_id')
          ->join('products', 'products.id', '=', 'prices.product_id')
          ->get();

        return Datatables::of($toTable)
        ->addColumn('btn', 'capture.partials.buttons_product')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function addProductEdit(Request $request)
    {
        if($request->price != null && $request->quantity != 0)
        {
          //Validar si el fondo alcanza, si si restar de fondo el total
          $capture = Capture::find($request->capture_id);
          $fund = Fund::find($capture->fund_id);
          //$flag = false;
          //if($fund->remaining >= $request->total)
          //{
            $fund->remaining -= $request->total;
            $fund->save();
            //$flag=true;

            //sumar al total de la captura
            $capture->total += $request->total;
            $capture->save();

            $price_id="";
            $flag=false;
            for($i=0;$i<strlen($request->price);$i++){
              if($flag)
                $price_id .= $request->price[$i];
              if($request->price[$i] == "/")
                $flag = true;
            }

            $products_capture = New ProductsCapture;
            $products_capture->price_id = $price_id;
            $products_capture->capture_id = $request->capture_id;
            $products_capture->quantity = $request->quantity;
            $products_capture->total = $request->total;
            $products_capture->extra = $request->extra;
            $products_capture->save();

            //Modificar honorario si es que hubo
            if($capture->honorarium == 1)
            {
              $honorary = Honorary::where('capture_id', $capture->id)->firstOrFail();
              $honorary_remaining = HonoraryRemaining::where('construction_id', $capture->construction_id)->firstOrFail();
              $honorary_remaining->remaining -= $honorary->total;
              
              $total = (float)$capture->total;
              $total = $total * $honorary_remaining->construction->honorary;
              $total = $total/100;
              $honorary->total = $total;
              $honorary->save();

              $honorary_remaining->remaining += $total;
              $honorary_remaining->save();
            }

            //Restar al estado de cuenta
            $capture_material = CaptureMaterial::where('capture_id', $capture->id)->firstOrFail();
            $statement_material = StatementMaterial::find($capture_material->statement_material_id);
            $statement_material->remaining -= $request->total;
            $statement_material->save();
          //}
          
        }

        $toTable = DB::table('products_captures')
          ->select(
            'products_captures.id as temporary_id', 'products_captures.quantity', 'products_captures.extra', 'products_captures.total',
            'prices.id as price_id', 'prices.price', 'prices.unity',
            'products.id as product_id', 'products.concept'
          )
          ->where('products_captures.capture_id', '=', $request->capture_id)
          ->join('prices', 'prices.id', '=', 'products_captures.price_id')
          ->join('products', 'products.id', '=', 'prices.product_id')
          ->get();

        return Datatables::of($toTable)
        ->addColumn('btn', 'capture.partials.buttons_product')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function showTableEPC(Request $request)
    {
          $toTable = DB::table('products_captures')
          ->select(
            'products_captures.id as temporary_id', 'products_captures.quantity', 'products_captures.extra', 'products_captures.total',
            'prices.id as price_id', 'prices.price', 'prices.unity',
            'products.id as product_id', 'products.concept'
          )
          ->where('products_captures.capture_id', '=', $request->capture_id)
          ->join('prices', 'prices.id', '=', 'products_captures.price_id')
          ->join('products', 'products.id', '=', 'prices.product_id')
          ->get();

        return Datatables::of($toTable)
        ->addColumn('btn', 'capture.partials.buttons_product')
        ->rawColumns(['btn'])
      ->make(true);
    }


    public function deleteTemporalCaptureProduct(Request $request)
    {
        $product = TemporaryCaptureProduct::findOrFail($request->id);
        $product->delete();
        $msg = [
            'title' => 'Eliminado!',
            'text' => 'Se removió el producto de la captura',
            'icon' => 'success'
        ];

        return response()->json($msg);
    }

    public function deleteCaptureProduct(Request $request)
    {
      //dd()
        $product = ProductsCapture::findOrFail($request->id);
        //Restar del total de captura
        $capture = Capture::find($product->capture_id);
        $capture->total -= $product->total;
        $capture->save();
        //Sumar al total del fondo
        $fund = Fund::find($capture->fund_id);
        $fund->remaining += $product->total;
        $fund->save();

        //Modificar honorario si es que hubo
        if($capture->honorarium == 1)
        {
          $honorary = Honorary::where('capture_id', $capture->id)->firstOrFail();
          $honorary_remaining = HonoraryRemaining::where('construction_id', $capture->construction_id)->firstOrFail();
          $honorary_remaining->remaining -= $honorary->total;
          $total = (float)$capture->total;
          $total = $total * $honorary_remaining->construction->honorary;
          $total = $total/100;
          $honorary->total = $total;
          $honorary->save();

          $honorary_remaining->remaining += $total;
          $honorary_remaining->save();
        }

        //Sumar al estado de cuenta
        $capture_material = CaptureMaterial::where('capture_id', $capture->id)->firstOrFail();
        $statement_material = StatementMaterial::find($capture_material->statement_material_id);
        $statement_material->remaining += $product->total;
        $statement_material->save();

        $product->delete();
        $msg = [
            'title' => 'Eliminado!',
            'text' => 'Se removió el producto de la captura',
            'icon' => 'success'
        ];

        return response()->json($msg);
    }

    public function showTableCa()
    {
        $toTable = DB::table('captures')
          ->select(
              'constructions.id as construction_id', 'constructions.name as construction_name',
                //'providers.id as provider_id', 'providers.name as provider_name',
                'captures.*', 'captures.id as capture_id', 'captures.date as capture_date', 'captures.total as capture_total', 'captures.concept as capture_concept')
              ->join('constructions', 'captures.construction_id', '=', 'constructions.id')
              //->join('providers', 'captures.provider_id', '=', 'providers.id')
              ->get();

              for($i=0; $i<$toTable->count(); $i++)
              {
                if($toTable[$i]->category == 0)
                  $toTable[$i]->category = "Mano de obra";
                else if($toTable[$i]->category == 1)
                  $toTable[$i]->category = "Material";
                else
                $toTable[$i]->category = "Logística";
                
                $toTable[$i]->capture_total = number_format($toTable[$i]->capture_total,2);
                $toTable[$i]->capture_date = Carbon::parse($toTable[$i]->capture_date)->format('d-F-Y');
                if($toTable[$i]->voucher == null)
                  $toTable[$i]->voucher = "NO";
                else if($toTable[$i]->voucher != null)
                  $toTable[$i]->voucher = "SI";
              }

          return Datatables::of($toTable)
          ->addColumn('btn', 'capture.partials.buttons')
          ->addColumn('voucher', 'capture.partials.icon')
          ->rawColumns(['voucher','btn'])
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Guardar captura
        $capture = Capture::create($request->all());
        $provider_name = "";
        if($request->category == 1)
        {
          $temporary_capture = TemporaryCapture::where('id', '=', $request->temporary_capture)->first();
          $statement_material = StatementMaterial::where('id', '=', $temporary_capture->statement_material_id)
            ->first();

          $capture_material = CaptureMaterial::create([
            'capture_id' => $capture->id,
            'statement_material_id' =>$temporary_capture->statement_material_id,
          ]);

            //Guardar productos_capture
            $temporal_products = DB::table('temporary_capture_products')
              ->select('temporary_capture_products.*')
              ->where('capture_id', '=', $request->temporary_capture)
              ->get();

              for($i=0; $i<$temporal_products->count(); $i++)
              {
                  $product = New ProductsCapture;
                  $product->quantity = $temporal_products[$i]->quantity;
                  $product->extra = $temporal_products[$i]->extra;
                  $product->total = $temporal_products[$i]->total;
                  $product->capture_id = $capture->id;
                  $product->price_id = $temporal_products[$i]->price_id;
                  $product->save();
              }
            //Borramos temporales
            DB::table('temporary_captures')->delete();
            DB::table('temporary_capture_products')->delete();

            //estado de cuenta...
          if($statement_material != null)
          {
              $statement_material->remaining -= $request->total;
              $statement_material->save();
          }
        }
        else {
          $provider = Provider::findOrFail($request->provider_id);
          $provider_name = $provider->name;
          $capture_logistic = CaptureLogistic::create([
            'capture_id' => $capture->id,
            'provider_id' => $provider->id,
          ]);
          //estado de cuenta...
          if($provider_name != "Arq. Missael Quintero")
          {
            $statement = Statement::where('construction_id', '=', $request->construction_id)
            ->where('provider_id', '=', $request->provider_id)
            ->first();
            if($statement != null)
            {
                $statement->remaining -= $request->total;
                $statement->save();
            }
          }
          
          
        }

        //descntar fondo
        $fund = Fund::findOrFail($request->fund_id);
        $fund->remaining = $fund->remaining - $request->total;
        $fund->save();

        //Honorario...
        $generado=false;
        //Checar nombre del proveedor, si no es missa:generado=0
        if($request->honorarium == 1 || $provider_name == "Arq. Missael Quintero")
        {
          $construction_honorary = construction::findOrFail($request->construction_id);
          $honorary = New Honorary;
          $total = (float)$request->total;
          $honorary->capture_id = $capture->id;
          if($provider_name != "Arq. Missael Quintero" && $request->honorarium == 1)
          {
            $total = $total * $construction_honorary->honorary;
            $total = $total/100;
            $generado=true;
            $honorary->status = 0;
          }
          else if($provider_name == "Arq. Missael Quintero" && $request->honorarium == 0)
          {
            $honorary->status = 1;
            $generado=false;
          }
          $honorary->total = $total;
          $honorary->save();

          //Honorary_remaining
          $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $request->construction_id)->firstOrFail();
          if($generado)
            $honorary_remaining->remaining += $total;
          else
            $honorary_remaining->remaining -= $total;
          $honorary_remaining->save();
        }

        $constructions = construction::select('id','name')->get();
        $providers = Provider::select('id','name','category')->get();

          for($i=0; $i<$providers->count(); $i++)
          {
            if($providers[$i]->category == 0)
              $providers[$i]->category = "Mano de obra";
            else if($providers[$i]->category == 1)
              $providers[$i]->category = "Material";
              else if($providers[$i]->category == 2)
                $providers[$i]->category = "Logística";
          }

          $msg = [
              'title' => 'Capturado correctamente!',
              'text' => 'Se ha capturado correctamente',
              'icon' => 'success'
          ];

        return redirect('capture')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function show(Capture $capture)
    {
      //dd($capture);
        $construction = construction::select('name')->where('id',$capture->construction_id)->firstOrFail();
        if($capture->iva == 0)
            $capture->iva = "No";
        else
            $capture->iva = "Si";

        if($capture->honorarium == 0)
            $capture->honorarium = "No";
        else
            $capture->honorarium = "Si";
        if($capture->category == 1)
        {
          $products = ProductsCapture::where('capture_id', '=', $capture->id)->get();
          $cap_material = CaptureMaterial::where('capture_id', '=', $capture->id)->firstOrFail();
          $statement_material = StatementMaterial::where('id', '=', $cap_material->statement_material_id)->firstOrFail();
          return view('capture.show_material')->with('capture',$capture)
            ->with('statement_material',$statement_material)
            ->with('construction',$construction->name);
        }
        else {
          $catpure_logisic =  CaptureLogistic::where('capture_id',$capture->id)->firstOrFail();
          $provider = Provider::select('name')->where('id',$catpure_logisic->provider_id)->firstOrFail();
          return view('capture.show_logistic')->with('capture',$capture)
            ->with('provider',$provider->name)
            ->with('construction',$construction->name);
        }
    }

    public function showTablePCshow(Request $request)
    {
        $products = DB::table('products_captures')
          ->select('*')
          ->where('capture_id', '=', $request->capture_id)
          ->join('prices', 'products_captures.price_id', '=', 'prices.id')
          ->join('products', 'prices.product_id', '=', 'products.id')
          ->get();
        return Datatables::of($products)
      ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function edit(Capture $capture)
    {
      $funds = Fund::select('*')->where('status', '1')->get();
        $constructions = construction::select('id','name')->get();
      if($capture->category == 1)
      {
        return view('capture.edit_material')
                ->with('funds', $funds)
                ->with('constructions', $constructions)
                ->with('capture', $capture);
      }
      else {
        $providers = DB::table('statements')
          ->select('providers.*', 'providers.id as provider_id', 'statements.*', 'statements.id as statement_id')
          ->join('providers', 'providers.id', '=', 'statements.provider_id')
          ->where('providers.status', '=', 1)
          ->where('providers.category', '=', $capture->category)
          ->get();
          for($i=0; $i<$providers->count(); $i++)
          {
            if($providers[$i]->category == 0)
              $providers[$i]->category = "Mano de obra";
            else if($providers[$i]->category == 1)
              $providers[$i]->category = "Material";
              else if($providers[$i]->category == 2)
                $providers[$i]->category = "Logística";
          }

          return view('capture.edit_logistic')
                ->with('funds', $funds)
                ->with('constructions', $constructions)
                ->with('providers', $providers)
                ->with('capture', $capture);
      }
    }

    public function editProducts($id)
    {
      $capture = Capture::find($id);
      $products = ProductsCapture::where('capture_id', $id)->get();
      $fund = Fund::find($capture->fund_id);
      $capture_materials = CaptureMaterial::where('capture_id', $id)->first();
      //$statement_material = StatementMaterial::where();
      //dd($producs);
        //$statement_material = StatementMaterial::where('id',$request->statemnt_material_id)->first();
      return view('capture.edit_products')->with('data', $capture)->with('fund',$fund)->with('products',$products)->with('statement_material', $capture_materials->statement_material);
    }

    public function update_data(Request $request)
    {
      $capture = Capture::where('id',$request->id)->firstOrFail();
      $capture->date = $request->date;
      $capture->folio = $request->folio;
      $capture->concept = $request->concept;
      $capture->iva = $request->iva;
      if($request->hasFile('voucher'))
      {
        Storage::delete($capture->voucher);
        $capture->voucher = $request->file('voucher')->store('public');
      }
      
      $provider_name = "";
      if($request->category != 1)
      {
        $logistic = CaptureLogistic::where('capture_id',$request->id)->firstOrFail();
        $provider = Provider::where('id',$logistic->provider_id)->firstOrFail();
        $provider_name = $provider->name;
      }
      
      if($request->honorarium != $capture->honorarium)
      {
        $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $capture->construction_id)->firstOrFail();
        if($request->honorarium == 1 && $provider_name != "Arq. Missael Quintero")
        {
            $honorary = New Honorary;
            $honorary->capture_id = $request->id;
            //$honorary->provider_id = $provider_id;
            $total = (float)$capture->total;
            //$honorary_construction = floatval($honorary_remaining->construction->honorary);
            $total = $total * $honorary_remaining->construction->honorary;
            $total = $total/100;
            $honorary->status = 0;
            $honorary->total = $total;
            $honorary->save();
            $honorary_remaining->remaining += $total;
            $honorary_remaining->save();
        }
        else if($provider_name != "Arq. Missael Quintero" && $request->honorarium == 0)
        {
            //Borramos
            $honorary = Honorary::where('capture_id', '=', $request->id)->firstOrFail();
            $total = $honorary->total;
            $honorary_remaining->remaining -= $total;
            $honorary_remaining->save();
            $honorary->delete();
        }
      }
      $capture->honorarium = $request->honorarium;
      $capture->save();
      
        /* $construction_id = Capture::select('construction_id')->where('id',$request->id)->firstOrFail();
        $construction_id = $construction_id->construction_id;
        $provider_id = Capture::select('provider_id')->where('id',$request->id)->firstOrFail();
        $provider_id = $provider_id->provider_id;
        $honorary_construction = construction::select('honorary')->where('id',$construction_id)->firstOrFail();
        $provider_name = Provider::findOrFail($provider_id);
        $provider_name = $provider_name->name; */

        //Originales
        //if($request->category != 1) { //Find from capture

            //$capture = Capture::select('*')->where('id',$request->id)->firstOrFail();
            //if($request->voucher != null && $capture->voucher != $request->voucher)
                //Storage::delete($capture->voucher);
            //Honorarios:
            
            /*
            //Provider:
            if($request->provider_id != $capture->provider_id)
            {
                if($provider_name == "Arq. Missael Quintero")
                {
                    if($request->honorarium == 0)
                    {
                        //Buscamos el honorario, si no existe creamos:
                        $honorary = Honorary::where('capture_id', '=', $request->id)->first();
                        if($honorary == null)
                            $honorary = New Honorary;
                        $honorary->capture_id = $request->id;
                        $honorary->provider_id = $request->provider_id;
                        $honorary->status = 1;
                        $honorary->total = $request->total;
                        $honorary->save();
                        //Modificamos el remaining
                        $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $request->construction_id)->firstOrFail();
                        $honorary_remaining->remaining -= $request->total;
                        $honorary_remaining->save();
                    }
                    else {
                        $msg = [
                            'title' => 'Error!',
                            'text' => 'Proveedor no puede generar honorarios',
                            'icon' => 'warning'
                        ];
                        return redirect('capture')->with('message', $msg);
                    }
                }
                else {
                    //Estado de cuenta
                    $statement = Statement::where('provider_id', '=', $capture->provider_id)
                    ->where('construction_id', '=', $capture->construction_id)->first();
                    if($statement != null)
                    {
                        $statement->remaining += $capture->total;
                        $statement->save();
                    }

                    $statement = Statement::where('provider_id', '=', $request->provider_id)
                    ->where('construction_id', '=', $request->construction_id)->first();
                    if($statement != null)
                    {
                        $statement->remaining -= $capture->total;
                        $statement->save();
                    }

                }
            }

            //Fund:
            if($request->fund_id != $capture->fund_id)
            {
                $fund_prev = Fund::select('*')->where('id',$capture->fund_id)->firstOrFail();
                $fund_prev->remaining += $capture->total;
                $fund_prev->save();
                $fund->remaining -= $request->total;
                $fund->save();
            }*/

            //Guardamos todo

            //$capture = $capture->fill($request->all());
            

            //$capture->save();
            
        //}
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*$fund = Fund::select('*')->where('id',$request->fund_id)->firstOrFail();
        if($fund->remaining < $request->total)
        {
            $msg = [
                'title' => 'Error!',
                'text' => 'Fondo insuficiente.',
                'icon' => 'warning'
            ];
            return redirect('capture')->with('message', $msg);
        }*/
        //else {
            //dd($request);
            $save = CaptureController::update_data($request);
            if($save)
            {
                $msg = [
                    'title' => 'Modificado!',
                    'text' => 'La captura se ha modificado exitosamente',
                    'icon' => 'success'
                ];

                return redirect('capture')->with('message', $msg);
            }
    //}
//}
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capture $capture)
    {
      //Material
      $provider = "";
      if($capture->category == 1)
      {
        //Estado de cuenta
        $capture_material = CaptureMaterial::where('capture_id', $capture->id)->first();
        $statement_material = StatementMaterial::find($capture_material->statement_material_id);
        if($statement_material != null)
        {
            $statement_material->remaining += $capture->total;
            $statement_material->save();
        }
      }
      else //Mano de obra / logística
      {
        //Estado de cuenta
        $capture_logistic = CaptureLogistic::where('capture_id', $capture->id)->first();
        $statement = Statement::where('construction_id', '=', $capture->construction_id)
          ->where('provider_id', '=', $capture_logistic->provider_id)
          ->first();
        if($statement != null)
        {
            $statement->remaining += $capture->total;
            $statement->save();
        }
        $provider = Provider::select('name')->where('id',$capture_logistic->provider_id)->first();
        $provider = $provider->name;
      }
        //Ajustar fondo
        $fund = Fund::findOrFail($capture->fund_id);
        $fund->remaining += $capture->total;
        $fund->save();

        //Ajustar honorariosRemaining:
        
        if($capture->honorarium == 1 || $provider == "Arq. Missael Quintero")
        {
            $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $capture->construction_id)->firstOrFail();
            $honorary = Honorary::where('capture_id', '=', $capture->id)->first();
            if($honorary->status == 0)
              $honorary_remaining->remaining -= $honorary->total;
            else
              $honorary_remaining->remaining += $honorary->total;

            $honorary_remaining->save();
        }

        //Borrar captura
        if($capture->voucher != null)
          Storage::delete($capture->voucher);
        $capture->delete();

        $msg = [
            'title' => 'Eliminado!',
            'text' => 'Captura eliminada exitosamente.',
            'icon' => 'success'
        ];

        return response()->json($msg);
    }

  public function download($id)
  {
    $capture = Capture::find($id);
    return Storage::download($capture->voucher);
  }
  public function show_storage($id)
    {
      $capture = Capture::find($id);
      return Storage::response($capture->voucher);
        
    }

}
