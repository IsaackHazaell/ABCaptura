<?php

namespace App\Http\Controllers;

use DB;
use App\Provider;
use App\Statement;
use App\Construction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StatementController extends Controller
{
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $constructions = Construction::select('id', 'name')->get();
        $providers = Provider::select('id', 'name')->get();
        return view('statement.create')->with('constructions', $constructions)
        ->with('providers', $providers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
      $input = $request->all();
      $statement->fill($input)->save();

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
