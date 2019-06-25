<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\fund;
use App\construction;
use App\Capture;
use App\Client;
use Yajra\DataTables\DataTables;
use PDF;
class MemoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function selectCM()
    {
        $constructions = construction::select('id','name')->get();
        return view('memory.selectCM')->with('constructions', $constructions);
    }

    public function viewClient(Request $request)
    {
        $name = construction::select('name','honorary')->where('id',$request->construction_id)->firstOrFail();
        $client = Client::select('name')->where('construction_id',$request->construction_id)->firstOrFail();
        $totalFunds = MemoryController::getTotalfunds($request->construction_id);
        $totalCaptures = MemoryController::getTotalCaptures($request->construction_id);
        return view('memory.viewClient')
            ->with('construction_id', $request->construction_id)
            ->with('contruction', $name)
            ->with('client',$client)
            ->with('total_funds',$totalFunds)
            ->with('total_captures',$totalCaptures);
    }

    public function getTotalCaptures($construction_id)
    {
        $captures = Capture::where('construction_id', '=', $construction_id)
              ->select('total')
              ->get();

        $total=0;
        for($i=0; $i<$captures->count(); $i++)
        {
          $total += $captures[$i]->total;
        }

        return $total;
    }

    public function getTotalfunds($construction_id)
    {
        $funds = Fund::where('construction_id', '=', $construction_id)
              ->select('total')
              ->get();

        $total=0;
        for($i=0; $i<$funds->count(); $i++)
        {
          $total += $funds[$i]->total;
        }

        return $total;
    }

    public function index(Request $request)
    {
        //dd($request);
        $name = construction::select('name','honorary')->where('id',$request->construction_id)->firstOrFail();
        //dd($request->month);
        $totalFunds = MemoryController::getFundsMonth($request->month, $request->construction_id);
        //dd($name->name);
        //$name = construction::where('id', $request->construction_id)->firstOrFail();
        return view('memory.index')->with('construction_id', $request->construction_id)->with('date', $request->month)->with('contruction', $name)->with('total_funds',$totalFunds);
    }

    public function getFundsMonth($date, $construction_id)
    {
        //dd($date);
        $month = "";
        $year = "";
        $flag=false;
        for($i=0; $i<strlen($date); $i++)
        {
            if($date[$i] == "-")
            {
                $flag = true;
                $i++;
            }
            if($flag)
                $month .= $date[$i];
            else
                $year .= $date[$i];
        }
        //dd($year);
        $funds = Fund::whereYear('funds.date', '=', $year)
              ->whereMonth('funds.date', '=', $month)
              ->where('construction_id', '=', $construction_id)
              ->select('*')/*,
              'honoraries.total as honorary_total')*/
              ->get();

        $total=0;
        for($i=0; $i<$funds->count(); $i++)
        {
          $total += $funds[$i]->total;
        }

        //dd($total);
        return $total;
    }

    public function getM($request)
    {
      $month = "";
      $year = "";
      $flag=false;
      for($i=0; $i<strlen($request->date); $i++)
      {
          if($request->date[$i] == "-")
          {
              $flag = true;
              $i++;
          }
          if($flag)
              $month .= $request->date[$i];
          else
              $year .= $request->date[$i];
      }
      //dd($year);
      $toTable = Capture::whereYear('captures.date', '=', $year)
            ->whereMonth('captures.date', '=', $month)
            ->where('construction_id', '=', $request->construction_id)
            ->where('honorarium', '=', 0)
            ->join('providers', 'captures.provider_id', '=', 'providers.id')
            //->join('honoraries', 'captures.id', '=', 'honoraries.capture_id')
            ->select('captures.date as capture_date', 'captures.concept as capture_concept',
            'captures.voucher', 'captures.total as capture_total', 'captures.folio as capture_folio',
            'providers.name as provider_name')/*,
            'honoraries.total as honorary_total')*/
            ->get();

            for($i=0; $i<$toTable->count(); $i++)
            {
              if($toTable[$i]->voucher == null)
                $toTable[$i]->voucher = "NO";
              else if($toTable[$i]->voucher != null)
                $toTable[$i]->voucher = "SI";
            }

            return $toTable;
    }
    public function showTableM(Request $request)
    {

        $toTable = $this->getM($request);
              //dd($toTable[0]);

          return Datatables::of($toTable)
          //->addColumn('btn', 'memory.partials.buttons')
          //->rawColumns(['btn'])
        ->make(true);
    }

    public function getMH($request)
    {
      $month = "";
      $year = "";
      $flag=false;
      for($i=0; $i<strlen($request->date); $i++)
      {
          if($request->date[$i] == "-")
          {
              $flag = true;
              $i++;
          }
          if($flag)
              $month .= $request->date[$i];
          else
              $year .= $request->date[$i];
      }
      //dd($year);
      $toTable = Capture::whereYear('captures.date', '=', $year)
            ->whereMonth('captures.date', '=', $month)
            ->where('construction_id', '=', $request->construction_id)
            ->where('honorarium', '=', 1)
            ->join('providers', 'captures.provider_id', '=', 'providers.id')
            //->join('honoraries', 'captures.id', '=', 'honoraries.capture_id')
            ->select('captures.date as capture_date', 'captures.concept as capture_concept',
            'captures.voucher', 'captures.total as capture_total', 'captures.folio as capture_folio',
            'providers.name as provider_name')/*,
            'honoraries.total as honorary_total')*/
            ->get();

            for($i=0; $i<$toTable->count(); $i++)
            {
              if($toTable[$i]->voucher == null)
                $toTable[$i]->voucher = "NO";
              else if($toTable[$i]->voucher != null)
                $toTable[$i]->voucher = "SI";
            }


            return $toTable;

    }

    public function showTableMH(Request $request)
    {
              //dd($toTable[0]);

          $toTable = $this->getMH($request);

          return Datatables::of($toTable)
          //->addColumn('btn', 'memory.partials.buttons')
          //->rawColumns(['btn'])
        ->make(true);
    }

    public function generatePDF(Request $request)
    {
      //dd($request->name);
      //$cons = ['name' => $request->name, 'honorary' => $request->honorary ];
      $name = construction::select('name','honorary')->where('id',$request->id)->firstOrFail();
    //  $name = construction::select('name','honorary')->where('id',$request->construction_id)->firstOrFail();
      //dd($request->month);
    //  $totalFunds = MemoryController::getFundsMonth($request->month, $request->construction_id);

        $data = ['construction_id'=> $request->id, 'date' => $request->date, 'contruction'=> $name, 'total_funds'=>$request->total_funds];

        $pdf = PDF::loadView('memory.index', $data);

        //dd($pdf);
        return $pdf->download('reporte.pdf');
    }
}
