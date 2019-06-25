<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use App\construction;
use App\HonoraryRemaining;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ConstructionController extends Controller
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
          return view('construction.index');
    }

    public function showTableC()
    {
      $constructions = DB::table('constructions')
        ->select('constructions.*', 'constructions.id as construction_id' ,
        'constructions.name as construction_name','clients.*',
        'clients.id as client_id', 'clients.name as client_name')
        ->join('clients', 'clients.construction_id', '=', 'constructions.id')
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
      $clients = Client::all();
        return view('construction.create', compact('clients'));
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
        $construction->client_id = $request->client_id;
        $construction->save();
/*
        $client = New Client;
        $client->construction_id = $construction->id;
        $client->name = $request->client_name;
        $client->cellphone = $request->cellphone;
        $client->phonelandline = $request->phonelandline;
        $client->address = $request->address;
        $client->save(); */

        $msg = [
            'title' => 'Creado!',
            'text' => 'Obra creada exitosamente.',
            'icon' => 'success'
        ];

        $honorary_remaining = New HonoraryRemaining;
        $honorary_remaining->construction_id = $construction->id;
        $honorary_remaining->remaining = 0;
        $honorary_remaining->save();

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
      // $client = DB::table('clients')->where('construction_id', $construction->id)->first();
      $status = null;
      if($construction->status==0)
        $status="Activo";
      else if($construction->status==1)
        $status="Finalizado";
      else if($construction->status==2)
          $status="Espera";

      $construction->status = $status;
      $client = Client::select('*')->where('construction_id', $construction->id)->first();
      // dd($client->name);
      return view('construction.show')->with('construction',$construction)->with('client', $client);
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

      $client = Client::where('construction_id', $request->id)->firstOrFail();
      $client->name = $request->client_name;
      $client->phonelandline = $request->phonelandline;
      $client->cellphone = $request->cellphone;
      $client->address = $request->address;
      $client->save();

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
         $construction->delete();
         $msg = [
             'title' => 'Eliminada!',
             'text' => 'Obra eliminada exitosamente.',
             'icon' => 'success'
         ];

         return response()->json($msg);
     }
}
