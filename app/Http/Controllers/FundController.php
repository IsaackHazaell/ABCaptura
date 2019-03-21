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

    public function showTableF()
    {
      $funds = DB::table('funds')
        ->select('funds.*', 'constructions.*')
        ->join('constructions', 'constructions.id', '=', 'funds.construction_id')
        ->get();

        return Datatables::of($funds)
        ->addColumn('btn', 'fund.actions')
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
      return view('fund.show')->with('fund',$fund);
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
    public function update(Request $request)
    {
      $fund = fund::findOrFail($request->id);
      $input = $request->all();
      $fund->fill($input)->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Fondo modificado exitosamente.',
        'icon' => 'success'
        ];
        //return view('fund.index', $msg);
        return redirect('fund')->with('message', $msg);
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
