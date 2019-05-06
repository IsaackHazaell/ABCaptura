<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\construction;
use App\Capture;
use Yajra\DataTables\DataTables;

class MemoryController extends Controller
{
    public function selectCM()
    {
        $constructions = construction::select('id','name')->get();
        return view('memory.selectCM')->with('constructions', $constructions);
    }

    public function index(Request $request)
    {
        $name = construction::select('name','honorary')->where('id',$request->construction_id)->firstOrFail();
        //dd($name->name);
        //$name = construction::where('id', $request->construction_id)->firstOrFail();
        return view('memory.index')->with('construction_id', $request->construction_id)->with('date', $request->month)->with('contruction', $name);
    }

    public function showTableM(Request $request)
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

              //dd($toTable[0]);

          return Datatables::of($toTable)
          //->addColumn('btn', 'memory.partials.buttons')
          //->rawColumns(['btn'])
        ->make(true);
    }
}
