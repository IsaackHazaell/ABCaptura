<?php

namespace App\Http\Controllers;

use App\Capture;
use App\construction;
use App\Provider;
use App\Product;
use App\Price;
use App\Fund;
use App\Logistic;
use App\Honorary;
use App\ProductsCapture;
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
        $constructions = construction::select('id','name')->get();
        $providers = DB::table('statements')
          ->select('providers.*')
          ->join('providers', 'providers.id', '=', 'statements.provider_id')
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
        return view('capture.create')->with('constructions', $constructions)->with('providers', $providers);
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
        ->get();

        $provider_id = "";
        $flag=False;
        $category="";
        for($i=0;$i<strlen($request->provider_id);$i++){
          if($request->provider_id[$i] != " " && $flag==False)
            $provider_id .= $request->provider_id[$i];
          if($request->provider_id[$i-2] == ":")
          {
            $flag=True;
          }
          if($flag)
          {
              $category .= $request->provider_id[$i];
          }
        }
        $construction_id="";
        for($i=0;$i<strlen($request->construction_id);$i++){
          if($request->construction_id[$i] != " ")
            $construction_id .= $request->construction_id[$i];
          else
            break;
        }
        $request->construction_id = $construction_id;

        $provider_id = "";
        for($i=0;$i<strlen($request->provider_id);$i++){
          if($request->provider_id[$i] != " ")
            $provider_id .= $request->provider_id[$i];
          else
            break;
        }
        $request["construction_id"] = $construction_id;
        $request["provider_id"] = $provider_id;

        if($category == "Material")
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

          $prices = DB::table('products','prices')
            ->select(
            'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
            'prices.*')
            ->where('providers.id', '=', $provider_id)
            ->join('providers', 'providers.id', '=', 'products.provider_id')
            ->join('prices', 'prices.product_id', '=', 'products.id')
            ->get();

          for($i=0; $i<$prices->count(); $i++)
          {
              $month = CaptureController::month($prices[$i]->month);
              $prices[$i]->month = $month;
              $prices[$i]->month .= " " . $prices[$i]->year;
          }
          return view('capture.create_material')->with('data', $temporary_capture)->with('prices', $prices)->with('funds',$funds)->with('category',$category);
        }
        else
        {
            //dd($request->iva);
            return view('capture.create_logistic')->with('data', $request)->with('funds',$funds)->with('category',$category);

        }

    }

    public function saveTemporalCapture($data)
    {
        $temporary_capture = (new TemporaryCapture)->fill( $data->all() );

        if($data->hasFile('voucher'))
            $temporary_capture->voucher = $data->file('voucher')->store('public');

        $fund = Fund::first();

        if($fund != null)
        {
            $temporary_capture->fund_id = $fund->id;
            $temporary_capture->total = 0;
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
        //dd($request->provider_id);
        $provider_id = $request->provider_id;
        /*for($i=0;$i<strlen($request->provider_id);$i++){
          if($request->provider_id[$i] != " ")
            $provider_id .= $request->provider_id[$i];
          else
            break;
        }*/

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

    public function showTableCa()
    {
        $toTable = DB::table('captures')
          ->select(
              'constructions.id as construction_id', 'constructions.name as construction_name',
                'providers.id as provider_id', 'providers.name as provider_name',
                'captures.*', 'captures.id as capture_id', 'captures.date as capture_date', 'captures.total as capture_total', 'captures.concept as capture_concept')
              ->join('constructions', 'captures.construction_id', '=', 'constructions.id')
              ->join('providers', 'captures.provider_id', '=', 'providers.id')
              ->get();

              for($i=0; $i<$toTable->count(); $i++)
              {
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
        if($request->category == "Material")
        {
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
        }

        //descntar fondo
        $fund = Fund::findOrFail($request->fund_id);
        $fund->remaining = $fund->remaining - $request->total;
        $fund->save();

        //Honorario...
        $generado=false;
        //Checar nombre del proveedor, si no es missa:generado=0
        $provider_name = Provider::findOrFail($request->provider_id);
        $provider_name = $provider_name->name;

        if($request->honorarium == 1 || $provider_name == "Arq. Missael Quintero")
        {
          $construction_honorary = construction::findOrFail($request->construction_id);
          $honorary = New Honorary;
          $total = (float)$request->total;
          $honorary->capture_id = $capture->id;
          $honorary->provider_id = $request->provider_id;
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

        //estado de cuenta...
        $statement = Statement::where('construction_id', '=', $request->construction_id)
        ->where('provider_id', '=', $request->provider_id)
        ->first();
        if($statement != null)
        {
            $statement->remaining -= $request->total;
            $statement->save();
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
        //Seleccionar los productos de esa captura (products_capture)
        //Si no hay, es logistca
        $isProduct=false;
        $products = ProductsCapture::where('capture_id', '=', $capture->id)->get();
        $provider = Provider::select('name')->where('id',$capture->provider_id)->firstOrFail();
        $construction = construction::select('name')->where('id',$capture->construction_id)->firstOrFail();
        //dd($provider->name);
        if($products->count() > 0)
            $isProduct=true;

        if($capture->iva == 0)
            $capture->iva = "No";
        else
            $capture->iva = "Si";

        if($capture->honorarium == 0)
            $capture->honorarium = "No";
        else
            $capture->honorarium = "Si";

        //if($isProduct)
            return view('capture.show')->with('capture',$capture)
                ->with('isProduct',$isProduct)
                ->with('provider',$provider->name)
                ->with('construction',$construction->name);
        /*else
            return view('capture.show')->with('capture',$capture)
                ->with('isProduct',$isProduct)
                ->with('provider',$provider->name)
                ->with('construction',$construction->name);*/
    }

    public function showTablePCshow(Request $request)
    {
        //dd($request);
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
        $funds = Fund::select('*')->get();
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
        //Category: 0=Mano de obra, 1=Material, 2=Logística
        if($capture->provider->category == 1)
        {
            return view('capture.edit_material')
                ->with('funds', $funds)
                ->with('constructions', $constructions)
                ->with('providers', $providers)
                ->with('capture', $capture);
        }
        else
        {
            //Mano de obra o logística
            //dd($capture->provider);
            return view('capture.edit_logistic')
                ->with('funds', $funds)
                ->with('constructions', $constructions)
                ->with('providers', $providers)
                ->with('capture', $capture);
        }
    }

    public function editProducts(Request $request)
    {
        $capture = Capture::select('*')->where('id',$request->id)->firstOrFail();
        //dd($request);
        //return view('capture.create_material')->with('data', $temporary_capture)->with('prices', $prices)->with('funds',$funds)->with('category',$category);
        //return view('capture.edit_products');
        //dd("Hey jude");
        /*dd($request->hasFile('voucher'));
        if (Input::hasFile('logo'))
        {
           dd( "file present" );
        }
        else{
            dd( "file not present" );
        }*/

        $fund = Fund::select('*')->where('id',$request->fund_id)->firstOrFail();
        if($fund->remaining < $request->total)
        {
            $msg = [
                'title' => 'Error!',
                'text' => 'Fondo insuficiente.',
                'icon' => 'warning'
            ];

            if($request->category == 1)
            {
                DB::table('temporary_captures')->delete();
                DB::table('temporary_capture_products')->delete();
            }
            return redirect('capture')->with('message', $msg);
        }
        $provider = Provider::select('*')->where('id',$request->provider_id)->first();
        //dd($request);
        if($provider->category == 1)
        {
            DB::table('temporary_captures')->delete();
            DB::table('temporary_capture_products')->delete();
            $temporary_capture = new TemporaryCapture;
            $temporary_capture->date = $request->date;
            $temporary_capture->total = $capture->total;
            $temporary_capture->iva = $request->iva;
            $temporary_capture->honorarium = $request->honorarium;
            $temporary_capture->voucher = $capture->voucher;
            $temporary_capture->folio = $request->folio;
            $temporary_capture->concept = $request->concept;
            $temporary_capture->fund_id = $request->fund_id;
            $temporary_capture->construction_id = $request->construction_id;
            $temporary_capture->provider_id = $request->provider_id;
            $temporary_capture->save();



            $products = ProductsCapture::where('capture_id', '=', $request->id)->get();
            for($i=0; $i<$products->count(); $i++)
            {
                $temporary_product = New TemporaryCaptureProduct;
                $temporary_product->price_id = $products[$i]->price_id;
                $temporary_product->capture_id = $temporary_capture->id;
                $temporary_product->quantity = $products[$i]->quantity;
                $temporary_product->total = $products[$i]->total;
                $temporary_product->extra = $products[$i]->extra;
                $temporary_product->save();
            }
            $temporary_products = TemporaryCaptureProduct::where('capture_id', '=', $temporary_capture->id)->get();

            $funds = DB::table('funds','constructions')
              ->select(
              'funds.id', 'funds.date', 'funds.remaining',
              'constructions.name')
              ->join('constructions', 'constructions.id', '=', 'funds.construction_id')
              ->get();

            $prices = DB::table('products','prices')
              ->select(
              'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
              'prices.*')
              ->where('providers.id', '=', $request->provider_id)
              ->join('providers', 'providers.id', '=', 'products.provider_id')
              ->join('prices', 'prices.product_id', '=', 'products.id')
              ->get();

            for($i=0; $i<$prices->count(); $i++)
            {
                $month = CaptureController::month($prices[$i]->month);
                $prices[$i]->month = $month;
                $prices[$i]->month .= " " . $prices[$i]->year;
            }



            $view = view('capture.edit_products')
                ->with('data', $temporary_capture)
                ->with('capture_id', $request->id)
                ->with('prices', $prices)
                ->with('funds',$funds)
                ->with('category',$provider->category);

            $data = array('data' => $temporary_capture,
                'capture_id', $request->id,
                'prices', $prices,
                'funds',$funds,
                'category',$provider->category);

                //$data = array('status' => 'ok', 'url' => $view );

            /*return view('capture.edit_products')
                ->with('data', $temporary_capture)
                ->with('capture_id', $request->id)
                ->with('prices', $prices)
                ->with('funds',$funds)
                ->with('category',$provider->category);*/

            //return response()->json(['data'=>$data]);

            $returnHTML = view('capture.edit_products')
                ->with('data', $temporary_capture)
                ->with('capture_id', $request->id)
                ->with('prices', $prices)
                ->with('funds',$funds)
                ->with('category',$provider->category)->render();

            return response()->json(array('success' => true, 'html'=>$returnHTML));
            //return $data;
        }
        else {
            $msg = [
                'title' => 'Alerta!',
                'text' => 'Esta categoría de proveedor no cuenta con productos',
                'icon' => 'warning'
            ];
            return redirect('capture')->with('message', $msg);
        }
    }


    public function update_data(Request $request)
    {
        $honorary_construction = construction::select('honorary')->where('id',$request->construction_id)->firstOrFail();
        $provider_name = Provider::findOrFail($request->provider_id);
        $provider_name = $provider_name->name;

        //Originales
        if($request->with_products == null) { //Find from capture

            $capture = Capture::select('*')->where('id',$request->id)->firstOrFail();

            //Honorarios:
            if($request->honorarium != $capture->honorarium)
            {
                $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $request->construction_id)->firstOrFail();
                if($request->honorarium == 1 && $provider_name != "Arq. Missael Quintero")
                {
                    $honorary = New Honorary;
                    $honorary->capture_id = $request->id;
                    $honorary->provider_id = $request->provider_id;
                    $total = (float)$request->total;
                    $total = $total * $honorary_construction;
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
            }

            //Guardamos todo

            $capture = $capture->fill($request->all());
            if($request->voucher == null)
                $capture->voucher = $request->voucher_prev;
            else
                $capture->voucher = $request->file('voucher')->store('public');

            $capture->save();
            return true;
        }
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
        //dd($request);
        $fund = Fund::select('*')->where('id',$request->fund_id)->firstOrFail();
        if($fund->remaining < $request->total)
        {
            $msg = [
                'title' => 'Error!',
                'text' => 'Fondo insuficiente.',
                'icon' => 'warning'
            ];
            return redirect('capture')->with('message', $msg);
        }
        else {
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
    }
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
        //dd($capture);
        //Ajustar estado de cuenta
        $statement = Statement::where('construction_id', '=', $capture->construction_id)
        ->where('provider_id', '=', $capture->provider_id)
        ->first();
        if($statement != null)
        {
            $statement->remaining += $capture->total;
            $statement->save();
        }

        //Ajustar fondo
        $fund = Fund::findOrFail($capture->fund_id);
        $fund->remaining += $capture->total;
        $fund->save();

        //Ajustar honorariosRemaining:
        $provider = Provider::select('name')->where('id',$capture->provider_id)->first();
        if($capture->honorarium == 1 || $provider->name == "Arq. Missael Quintero")
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
  //  dd($capture);
    return Storage::download($capture->voucher);
  }

}
