<?php

namespace App\Http\Controllers;

use DB;
use App\Honorary;
use App\construction;
use App\HonoraryRemaining;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class HonoraryController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$construction = $request->construction_id;
        $construction_id = "";
        for($i=0; $i<strlen($construction); $i++)
        {
          if($construction[$i] == " ")
            break;
          $construction_id .= $construction[$i];
      }*/
        $honorary_remaining = HonoraryRemaining::where('construction_id', '=', $request->construction_id)->firstOrFail();
        $honorary_remaining = $honorary_remaining->remaining;

        $construction = Construction::select('id','name','honorary')->where('id', '=', $request->construction_id)->firstOrFail();

        $construction_id = $construction->id;

        return view('honorary.index')->with('honorary_remaining',$honorary_remaining)->with('construction',$construction)->with('construction_id',$construction_id);
    }

    public function showTableHo(Request $request)
    {
      $toTable = DB::table('captures')
        ->select(
          'honoraries.*', 'honoraries.id as honorary_id', 'honoraries.total as honorary_total',
          'providers.id as provider_id', 'providers.name as provider_name',
          'captures.*', 'captures.id as capture_id', 'captures.date as capture_date', 'captures.total as capture_total', 'captures.concept as capture_concept')
        ->where('captures.construction_id', '=', $request->construction_id)
        ->join('honoraries', 'captures.id', '=', 'honoraries.capture_id')
        ->join('providers', 'captures.provider_id', '=', 'providers.id')
        ->get();

        for($i=0; $i<$toTable->count(); $i++)
        {
          if($toTable[$i]->status == 0)
            $toTable[$i]->status = "Generado";
          else if($toTable[$i]->status == 1)
            $toTable[$i]->status = "Cobrado";
        }

        return Datatables::of($toTable)
      ->make(true);
    }

    public function selectC()
    {
        $constructions = construction::select('id','name')->get();
        return view('honorary.selectC')->with('constructions', $constructions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Honorary  $honorary
     * @return \Illuminate\Http\Response
     */
    public function show(Honorary $honorary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Honorary  $honorary
     * @return \Illuminate\Http\Response
     */
    public function edit(Honorary $honorary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Honorary  $honorary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Honorary $honorary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Honorary  $honorary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Honorary $honorary)
    {
        //
    }
}
