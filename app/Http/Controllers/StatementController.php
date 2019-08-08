<?php

namespace App\Http\Controllers;

use DB;
use App\Provider;
use App\Statement;
use App\Construction;
use App\StatementMaterial;
use App\StatementProviderMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class StatementController extends Controller
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
        return view('statement.index');
    }

    public function showTableSt()
    {
      $statements = DB::table('statements')
        ->select('statements.*', 'statements.id as statement_id',
        'constructions.name as construction_name', 'providers.name as provider_name')
        ->join('constructions', 'constructions.id', '=', 'statements.construction_id')
        ->join('providers', 'providers.id', '=', 'statements.provider_id')
        ->get();
        for ($i=0; $i<$statements->count(); $i++) {
          $statements[$i]->total = number_format($statements[$i]->total,2);
          $statements[$i]->remaining = number_format($statements[$i]->remaining,2);
          if($statements[$i]->status=="0")
            $statements[$i]->status="Liquidado";
          else if($statements[$i]->status=="1")
            $statements[$i]->status="Activo";
        }
        return Datatables::of($statements)
        ->addColumn('btn', 'statement.actions')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function showTableProvMat(Request $request)
    {
      $statements_materials = DB::table('statement_materials')
        ->select('statement_materials.*', 'statement_materials.id as statement_id', 'statement_materials.name as statement_name',
        'constructions.name as construction_name')
        ->join('constructions', 'constructions.id', '=', 'statement_materials.construction_id')
        ->get();
        for ($i=0; $i<$statements_materials->count(); $i++) {
          $statements_materials[$i]->total = number_format($statements_materials[$i]->total,2);
          $statements_materials[$i]->remaining = number_format($statements_materials[$i]->remaining,2);
          if($statements_materials[$i]->status=="0")
            $statements_materials[$i]->status="Liquidado";
          else if($statements_materials[$i]->status=="1")
            $statements_materials[$i]->status="Activo";
        }
        return Datatables::of($statements_materials)
        ->addColumn('btn', 'statement.partials.actions_materials')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function showTableSC(Request $request)
    {
      //dd($request);
      $toTable = DB::table('captures')
        ->select(
            'constructions.id as construction_id', 'constructions.name as construction_name',
              'providers.id as provider_id', 'providers.name as provider_name',
              'captures.*', 'captures.id as capture_id', 'captures.date as capture_date', 'captures.total as capture_total', 'captures.concept as capture_concept')
              ->where('captures.construction_id', '=', $request->construction_id)
              ->where('captures.provider_id', '=', $request->provider_id)
            ->join('constructions', 'captures.construction_id', '=', 'constructions.id')
            ->join('providers', 'captures.provider_id', '=', 'providers.id')
            ->get();


            for($i=0; $i<$toTable->count(); $i++)
            {
              $toTable[$i]->capture_total = number_format($toTable[$i]->capture_total,2);
              $toTable[$i]->capture_date = Carbon::parse($toTable[$i]->capture_date)->format('d-F-Y');
              if($toTable[$i]->voucher == null)
                $toTable[$i]->voucher = "NO";
              else if($toTable[$i]->voucher != null)
                $toTable[$i]->voucher = "SI";
             }

            // dd($toTable);
        return Datatables::of($toTable)
        ->addColumn('btn', 'statement.partials.buttons')
        ->addColumn('voucher', 'statement.partials.icon')
        ->rawColumns(['voucher','btn'])
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructions = Construction::select('id', 'name')->orderBy('name', 'asc')->get();
        $providers = Provider::select('id', 'name')->where('name', '!=', 'Arq. Missael Quintero')->where('status',1)->orderBy('name', 'asc')->get();
        $category = Provider::select('id', 'name')->where('category',1)->get();
        return view('statement.create')->with('constructions', $constructions)
        ->with('providers', $providers)
        ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd($request);
      if($request->category == 0)
      {
        $exists = Statement::where('construction_id',$request->construction_id)->where('provider_id',$request->provider_id)->first();
        if($exists == null)
        {
            $statement = (new Statement)->fill($request->all());
            $statement->remaining = $request->total;
            $statement->save();

            $msg = [
              'title' => 'Guardado!',
              'text' => 'Estado de cuenta guardado exitosamente.',
              'icon' => 'success'
              ];

              return redirect('statement')->with('message', $msg);
        }
        else
        {
            $msg = [
              'title' => 'Error!',
              'text' => 'Este proveedor ya cuenta con un estado de cuenta para esa obra.',
              'icon' => 'error'
              ];

              return Redirect::back()->with('message', $msg);
        }
      }
       else {
         $statement_material = StatementMaterial::create([
            'name' => $request->name,
            'construction_id' => $request->construction_id,
            'status' => $request->status,
            'total' => $request->total,
            'remaining' => $request->total,
          ]);

          foreach($request->provider_material as $provider)
          {
            StatementProviderMaterial::create([
              'statement_material_id' => $statement_material->id,
              'provider_id' => $provider,
            ]);
          }

        $msg = [
          'title' => 'Guardado!',
          'text' => 'Estado de cuenta guardado exitosamente.',
          'icon' => 'success'
          ];

          return redirect('statement')->with('message', $msg);
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function show(Statement $statement)
    {
      $construction = Construction::findOrFail($statement->construction_id);
      $provider = Provider::findOrFail($statement->provider_id);
      if($statement->status=="0")
        $statement->status="Liquidado";
      else if($statement->status=="1")
        $statement->status="Activo";
      return view('statement.show')->with('statement', $statement)->with('provider', $provider)->with('construction', $construction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function edit(Statement $statement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $statement = Statement::findOrFail($request->id);
      $total_prev = $statement->total;
      $total_new = $request->total;
      $diference = $total_new - $total_prev;
      $statement->remaining += $diference;
      $statement->status = $request->status;
      $statement->total = $request->total;
      $statement->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Fondo modificado exitosamente.',
        'icon' => 'success'
        ];
        return redirect('statement')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Statement  $statement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statement $statement)
    {
      $statement->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Proveedor eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
