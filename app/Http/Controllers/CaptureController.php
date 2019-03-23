<?php

namespace App\Http\Controllers;

use App\Capture;
use App\construction;
use App\Provider;
use App\Product;
use App\Price;
use App\Unity;
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
        return view('capture.create')->with('constructions', $constructions)->with('providers', $providers);
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

        $prices = DB::table('products','prices', 'unities')
          ->select(
          'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
          'prices.*',
          'unities.id as unity_id', 'unities.name as unity_name'
          )
          ->where('providers.id', '=', $provider_id)
          ->join('providers', 'providers.id', '=', 'products.provider_id')
          ->join('prices', 'prices.product_id', '=', 'products.id')
          ->join('unities', 'unities.id', '=', 'prices.unity_id')
          ->get();

          //dd($prices);

        $funds = construction::select('id','name')->get();

        return view('capture.create2')->with('data', $request)->with('funds', $funds)->with('prices', $prices);
    }

    public function showTablePC(Request $request)
    {

      //Precio/product_id/unity_id
      //unidad, producto, cantidad, precio, cargo extra, total, acciones
      $product_id=substr($request->product_id,1);
      $product = Product::select('id','concept')->where('id', '=', $product_id)->get();
      $product_toTable = $product[0]->id . " " . $product[0]->concept;
      $request->product_id = $product_toTable;

      $unity_id=substr($request->unity_id,1);
      $unity = Unity::select('id','name')->where('id', '=', $unity_id)->get();
      $unity_toTable = $unity[0]->id . " " . $unity[0]->name;
      $request->unity_id = $unity_toTable;

      $toTable = DB::table('products','prices', 'unities')
        ->select(
        'products.id as product_id', 'products.concept as product_concept', 'products.provider_id',
        'prices.*',
        'unities.id as unity_id', 'unities.name as unity_name'
        )
        ->where('products.id', '=', $product_id)
        ->join('prices', 'prices.product_id', '=', 'products.id')
        ->join('unities', 'unities.id', '=', 'prices.unity_id')
        ->get();

        return Datatables::of($toTable)
        //->addColumn('btn', 'capture.partials.buttons')
        //->rawColumns(['btn'])
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
