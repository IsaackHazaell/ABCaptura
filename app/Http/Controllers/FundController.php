<?php

namespace App\Http\Controllers;

use DB;
use App\Fund;
use App\Construction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fund.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructions = Construction::select('id','name')->get();
        return view('fund.create', compact('constructions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $construction_id = "";
      for($i=0;$i<strlen($request->construction);$i++)
      {
        if($request->construction[$i] != " ")
          $construction_id .= $request->construction[$i];
        else
          break;
      }
      $fund = New Fund;
      $fund->total = $request->total;
      $fund->construction_id = $construction_id;
      $fund->save();
      return view('fund.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }
}
