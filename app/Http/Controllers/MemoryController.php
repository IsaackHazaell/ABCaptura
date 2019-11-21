<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Fund;
use App\construction;
use App\Capture;
use App\Client;
use Yajra\DataTables\DataTables;
use PDF;
use Auth;

class MemoryController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function selectCM()
    {
        $constructions = "";
        if(Auth::user()->user_type == "Admin")
        {
            $constructions = construction::select('id','name')->orderBy('name', 'asc')->get();
        }
        else
        {
            $email = Auth::user()->email;

            $client = Client::select('id')
                ->where('email',$email)->first();
            if($client == null)
            {
                $msg = [
                    'title' => 'Aún no se le han asignado obras.',
                    'text' => 'Contacte al administrador',
                    'icon' => 'alert'
                ];
                return view('admin.dashboard')->with('message', $msg);
            }
            $constructions = construction::select('id','name')
            ->where('client_id',$client->id)->orderBy('name', 'asc')->get();
        }
        return view('memory.selectCM')->with('constructions', $constructions);
    }

    public function viewClient(Request $request)
    {
            $name = construction::select('name','honorary', 'client_id')->where('id',$request->construction_id)->firstOrFail();
            $client = Client::select('name')->where('id',$name->client_id)->firstOrFail();
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
        $totalFunds = MemoryController::getFundsMonth($request->month, $request->construction_id);
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
              ->select('*')
              ->get();

        $total=0;
        for($i=0; $i<$funds->count(); $i++)
        {
          $total += $funds[$i]->total;
        }

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
      $toTable = Capture::whereYear('captures.date', '=', $year)
            ->whereMonth('captures.date', '=', $month)
            ->where('construction_id', '=', $request->construction_id)
            ->where('honorarium', '=', 0)
            ->select('captures.date as capture_date', 'captures.concept as capture_concept',
              'captures.voucher', 'captures.total as capture_total', 'captures.folio as capture_folio', 'captures.category')
            ->get();

            for($i=0; $i<$toTable->count(); $i++)
            {
              if($toTable[$i]->category == 0)
                $toTable[$i]->category = "Mano de obra";
              else if($toTable[$i]->category == 1)
                $toTable[$i]->category = "Material";
              else
                $toTable[$i]->category = "Logística";

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

          return Datatables::of($toTable)
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

      $toTable2 = Capture::whereYear('captures.date', '=', $year)
            ->whereMonth('captures.date', '=', $month)
            ->where('construction_id', '=', $request->construction_id)
            ->where('honorarium', '=', 1)
            ->select('captures.date as capture_date', 'captures.concept as capture_concept',
              'captures.voucher', 'captures.total as capture_total', 'captures.folio as capture_folio', 'captures.category')
            ->get();

            for($i=0; $i<$toTable2->count(); $i++)
            {
              if($toTable2[$i]->category == 0)
                $toTable2[$i]->category = "Mano de obra";
              else if($toTable2[$i]->category == 1)
                $toTable2[$i]->category = "Material";
              else
                $toTable2[$i]->category = "Logística";

              if($toTable2[$i]->voucher == null)
                $toTable2[$i]->voucher = "NO";
              else if($toTable2[$i]->voucher != null)
                $toTable2[$i]->voucher = "SI";
            }

            return $toTable2;

    }

    public function showTableMH(Request $request)
    {
          $toTable = $this->getMH($request);

          return Datatables::of($toTable)
        ->make(true);
    }

    public function generatePDF(Request $request)
    {
      $name = construction::select('name','honorary')->where('id',$request->construction_id)->firstOrFail();
        $data = ['construction_id'=> $request->construction_id, 'date' => $request->date, 'contruction'=> $name, 'total_funds'=>$request->total_funds];
        $table1 = $this->getM($request);
        $table2 = $this->getMH($request);
        $totalM = 0;
        $totalMH = 0;

        $pdf = PDF::loadView('memory.indexPDF', $data, compact('table2', 'table1', 'totalM', 'totalMH'));

        return $pdf->download('reporte.pdf');
    }
}
