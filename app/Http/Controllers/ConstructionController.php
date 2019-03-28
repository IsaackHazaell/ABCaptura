<?php

namespace App\Http\Controllers;

use App\construction;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;


class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return view('construction.index');
    }

    public function showTableC()
    {
      $constructions = DB::table('constructions')
        ->select('constructions.*')
        ->get();
        for ($i=0; $i<$constructions->count(); $i++) {
          if($constructions[$i]->status=="0")
            $constructions[$i]->status="Activo";
          else if($constructions[$i]->status=="1")
            $constructions[$i]->status="Finalizado";
          else if($constructions[$i]->status=="2")
              $constructions[$i]->status="Espera";
        }

        return Datatables::of($constructions)
        ->addColumn('btn', 'construction.actions')
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
        return view('construction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = null;
        if($request->status=="Activo")
          $status=0;
        else if($request->status=="Finalizado")
          $status=1;
        else if($request->status=="Espera")
            $status=2;

        $request->status = $status;
        $construction = New Construction;
        $construction->name = $request->name;
        $construction->honorary = $request->honorary;
        $construction->date = $request->date;
        $construction->square_meter = $request->square_meter;
        $construction->status = $status;
        $construction->save();
        $msg = [
            'title' => 'Creado!',
            'text' => 'Obra creada exitosamente.',
            'icon' => 'success'
        ];

        return redirect('construction')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(construction $construction)
    {

      $status = null;
      if($construction->status==0)
        $status="Activo";
      else if($construction->status==1)
        $status="Finalizado";
      else if($construction->status==2)
          $status="Espera";

      $construction->status = $status;
      return view('construction.show')->with('construction',$construction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function edit(construction $construction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      // dd($construction);
      $status = null;
      if($request->status=="Activo")
        $status=0;
      else if($request->status=="Finalizado")
        $status=1;
      else if($request->status=="Espera")
          $status=2;

      $construction = Construction::findOrFail($request->id);

      $construction->name = $request->name;
      $construction->honorary = $request->honorary;
      $construction->date = $request->date;
      $construction->square_meter = $request->square_meter;
      $construction->status = $status;
      $construction->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Obra modificada exitosamente.',
        'icon' => 'success'
        ];

      return redirect('construction')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(construction $construction)
    {
      $provider->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Obra eliminada exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
