<?php

namespace App\Http\Controllers;

use DB;
use App\Fund;
use App\Construction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use CArbon\Carbon;

class FundController extends Controller
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
    public function index()
    {
        return view('fund.index');
    }

    public function showTableF()
    {
      $funds = DB::table('funds')
        ->select('funds.*', 'funds.id as fund_id', 'funds.date as fund_date', 'constructions.*', 'constructions.id as construction_id', 'constructions.date as construction_date')
        ->join('constructions', 'constructions.id', '=', 'funds.construction_id')
        ->where('funds.status', '=' , '1')
        ->get();
        for($i=0; $i<$funds->count(); $i++)
        {
            $funds[$i]->fund_date = Carbon::parse($funds[$i]->fund_date)->format('d-F-Y');
            $funds[$i]->total = number_format($funds[$i]->total,2);
            $funds[$i]->remaining = number_format($funds[$i]->remaining,2);
         }
        return Datatables::of($funds)
        ->addColumn('btn', 'fund.actions')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function showTableFC(Request $request)
    {
        //dd($request->fund_id);
        $toTable = DB::table('captures')
          ->select(
              'constructions.id as construction_id', 'constructions.name as construction_name',
                'providers.id as provider_id', 'providers.name as provider_name',
                'captures.*', 'captures.id as capture_id', 'captures.date as capture_date', 'captures.total as capture_total', 'captures.concept as capture_concept')
                ->where('captures.fund_id', '=', $request->fund_id)
              ->join('constructions', 'captures.construction_id', '=', 'constructions.id')
              ->join('providers', 'captures.provider_id', '=', 'providers.id')
              ->get();

              for($i=0; $i<$toTable->count(); $i++)
              {
                $toTable[$i]->capture_date = Carbon::parse($toTable[$i]->capture_date)->format('d-F-Y');
                $toTable[$i]->capture_total = number_format($toTable[$i]->capture_total,2);
              //  $toTable[$i]->remaining = number_format($toTable[$i]->remaining,2);
                if($toTable[$i]->voucher == null)
                  $toTable[$i]->voucher = "NO";
                else if($toTable[$i]->voucher != null)
                  $toTable[$i]->voucher = "SI";
              }

          return Datatables::of($toTable)
          ->addColumn('btn', 'fund.partials.buttons_capture')
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
      $fund->date = $request->date;
      $fund->remaining = $request->total;
      $fund->construction_id = $construction_id;
      $fund->save();
      $msg = [
          'title' => 'Creado!',
          'text' => 'Fondo creado exitosamente.',
          'icon' => 'success'
      ];

      return redirect('fund')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
      $construction = Construction::findOrFail($fund->construction_id);
      $fund->construction_id .= " ";
      $fund->construction_id .= $construction->name;
      return view('fund.show')->with('fund', $fund);
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
      $total_prev = $fund->total;
      $total_new = $request->total;
      $diference = $total_new - $total_prev;
      $fund->date = $request->date;
      $fund->remaining += $diference;
      $fund->total = $request->total;
      $fund->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Fondo modificado exitosamente.',
        'icon' => 'success'
        ];
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
        // 0 = muerto, 1 = vivo
        $captures = Capture::where('provider_id', $fund->id)->first();
        if($captures == null)
            $fund->delete();
        else {
            $fund->status = 0;
            $fund->save();
        }
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Proveedor eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
