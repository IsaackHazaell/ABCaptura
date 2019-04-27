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
use App\TemporaryCaptureProduct;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class CaptureController extends Controller
{
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
        return view('capture.create')->with('constructions', $constructions)->with('providers', $providers);
    }

    public function create2(Request $request)
    {
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
            return view('capture.create_logistic')->with('data', $request)->with('funds',$funds)->with('category',$category);
    }

    public function saveTemporalCapture($data)
    {
        $temporary_capture = New TemporaryCapture;
        $temporary_capture->construction_id = $data->construction_id;
        $temporary_capture->provider_id = $data->provider_id;
        $temporary_capture->fund_id = 1;
        $temporary_capture->date = $data->date;
        $temporary_capture->voucher = $data->file;
        $temporary_capture->total = 0;
        $temporary_capture->folio = $data->folio;
        $temporary_capture->honorarium = $data->honorarium;
        $temporary_capture->iva = $data->iva;
        $temporary_capture->concept = $data->concept;
        $temporary_capture->save();

        return $temporary_capture;
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
        $provider_id = "";
        for($i=0;$i<strlen($request->provider_id);$i++){
          if($request->provider_id[$i] != " ")
            $provider_id .= $request->provider_id[$i];
          else
            break;
        }
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

        return back()->with('message', $msg);
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
        //dd($product);
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

          return Datatables::of($toTable)
          ->addColumn('btn', 'capture.partials.buttons')
          ->rawColumns(['btn'])
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
          $honorary->capture_id = $capture->id;
          $honorary->provider_id = $request->provider_id;
          $total = (float)$request->total;
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

        return view('capture.create')->with('constructions', $constructions)->with('providers', $providers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function show(Capture $capture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function edit(Capture $capture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capture $capture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capture  $capture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capture $capture)
    {
        //
    }
}
