<?php

namespace App\Http\Controllers;

use App\StatementMaterial;
use Illuminate\Http\Request;

class StatementMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\StatementMaterial  $statementMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(StatementMaterial $statementMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatementMaterial  $statementMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(StatementMaterial $statementMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatementMaterial  $statementMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatementMaterial $statementMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatementMaterial  $statementMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatementMaterial $statementMaterial)
    {
        $statementMaterial->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Proveedor eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
