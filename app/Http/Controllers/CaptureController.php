<?php

namespace App\Http\Controllers;

use App\Capture;
use App\construction;
use App\Provider;
use App\Product;
use App\Price;
use App\Fund;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructions = construction::select('id','name')->get();
        $providers = Provider::select('id','name')->get();
        $funds = DB::table('funds','constructions')
          ->select(
          'funds.id', 'funds.date',
          'constructions.name')
          ->join('constructions', 'constructions.id', '=', 'funds.construction_id')
          ->get();
        return view('capture.create')->with('constructions', $constructions)->with('providers', $providers)->with('funds',$funds);
    }

    public function create2(Request $request)
    {
        $provider_id = "";
        for($i=0;$i<strlen($request->provider_id);$i++){
          if($request->provider_id[$i] != " ")
            $provider_id .= $request->provider_id[$i];
          else
            break;
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
            /*if($products[$i]->category == 0)
              $products[$i]->category = "Mano de obra";
            else if($products[$i]->category == 1)
              $products[$i]->category = "Material";
              else if($products[$i]->category == 2)
                $products[$i]->category = "Logística";*/

              $month = CaptureController::month($prices[$i]->month);
              $prices[$i]->month = $month;
              $prices[$i]->month .= " " . $prices[$i]->year;
          }

        $funds = construction::select('id','name')->get();
        $providers = Provider::select('id','name')->get();
        return view('capture.create2')->with('data', $request)->with('prices', $prices)->with('providers',$providers);
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


      //dd($request);
      //dd($request->price);

      //Precio/product_id/unity_id
      //unidad, producto, cantidad, precio, cargo extra, total, acciones

      /*$product_id=substr($request->product_id,1);
      $product = Product::select('id','concept')->where('id', '=', $product_id)->get();
      $product_toTable = $product[0]->id . " " . $product[0]->concept;
      $request->product_id = $product_toTable;*/

      /*$unity_id=substr($request->unity_id,1);
      $unity = Unity::select('id','name')->where('id', '=', $unity_id)->get();
      $unity_toTable = $unity[0]->id . " " . $unity[0]->name;
      $request->unity_id = $unity_toTable;*/

      /*$toTable = DB::table('products','prices')
        ->select(
        'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
        'prices.*'
        )
        ->where('products.id', '=', $product_id)
        ->join('prices', 'prices.product_id', '=', 'products.id')
        ->get();*/
        //dd($request->price);
        $toTable = DB::table('products','prices')
          ->select(
          'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
          'prices.*'
          )
          ->where('prices.price', '=', $request->price)
          ->join('prices', 'prices.product_id', '=', 'products.id')
          ->get();


        //dd($toTable);

        return Datatables::of($toTable)
        //->addColumn('btn', 'capture.partials.buttons')
        //->rawColumns(['btn'])
      ->make(true);
      return redirect();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
