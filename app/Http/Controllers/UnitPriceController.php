<?php

namespace App\Http\Controllers;

use App\UnitPrice;
use Illuminate\Http\Request;
use App\Provider;
use DB;
use Yajra\DataTables\DataTables;

class UnitPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unitPrice.index');
    }

    public function showTable()
    {
      $unitPrices = DB::table('unit_prices')
        ->select('unit_prices.*')
        ->get();

        //dd($unitPrices);
        return Datatables::of($unitPrices)
        ->addColumn('btn', 'unitPrice.actions')
        ->rawColumns(['btn'])
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::select('id','name')->get();
        //dd($providers);
        return view('unitPrice.create', compact('providers'));//->with('providers', $providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $provider_id = "";
      for($i=0;$i<strlen($request->provider);$i++){
        if($request->provider[$i] != " ")
          $provider_id .= $request->provider[$i];
        else
          break;
      }
        //dd($provider_id);

        $unitPrice = New UnitPrice;
        $unitPrice->name = $request->name;
        $unitPrice->year = $request->year;
        $unitPrice->cost = $request->cost;
        $unitPrice->unit = $request->unit;
        $unitPrice->provider_id = $provider_id;
        $unitPrice->save();
        return view('unitPrice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitPrice  $unitPrice
     * @return \Illuminate\Http\Response
     */
    public function show(UnitPrice $unitPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitPrice  $unitPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitPrice $unitPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitPrice  $unitPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnitPrice $unitPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitPrice  $unitPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitPrice $unitPrice)
    {
        //
    }
}
