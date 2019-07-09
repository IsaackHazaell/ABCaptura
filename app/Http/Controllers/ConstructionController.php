<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use App\construction;
use App\HonoraryRemaining;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;



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
      $clients = Client::all();
          return view('construction.index', compact('clients'));
    }

    public function showTableC()
    {
      $constructions = DB::table('constructions')
        ->select('constructions.*', 'constructions.id as construction_id' ,
        'constructions.name as construction_name', 'constructions.status as construction_status',
        'clients.*', 'clients.id as client_id', 'clients.name as client_name', 'clients.status as client_status')
        ->join('clients', 'clients.id', '=', 'constructions.client_id')
        ->get();
        for ($i=0; $i<$constructions->count(); $i++)
        {
          $constructions[$i]->date = Carbon::parse($constructions[$i]->date)->format('d-F-Y');
          $constructions[$i]->square_meter = number_format($constructions[$i]->square_meter,2);
          if($constructions[$i]->construction_status == 0)
            $constructions[$i]->construction_status = "Activo";
          else if($constructions[$i]->construction_status == 1)
            $constructions[$i]->construction_status = "Finalizado";
          else if($constructions[$i]->construction_status == 2)
              $constructions[$i]->construction_status = "Espera";
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
        $construction = New Construction;
        $construction->name = $request->name;
        $construction->honorary = $request->honorary;
        $construction->date = $request->date;
        $construction->square_meter = $request->square_meter;
        if($request->status=="Activo")
          $construction->status="0";
        else if($request->status=="Finalizado")
          $construction->status="1";
        else if($request->status=="Espera")
            $construction->status="2";
        $construction->client_id = $request->client_id;
        $construction->save();

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
      $status = null;
      if($construction->status==0)
        $status="Activo";
      else if($construction->status==1)
        $status="Finalizado";
      else if($construction->status==2)
          $status="Espera";

      $construction->status = $status;
      $client = Client::select('*')->where('id', $construction->client_id)->first();
      $clients = Client::all();
      return view('construction.show')->with('construction',$construction)->with('client', $client)->with('clients', $clients);
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
      $construction = Construction::findOrFail($request->id);
      $construction->name = $request->name;
      $construction->honorary = $request->honorary;
      $construction->date = $request->date;
      $construction->square_meter = $request->square_meter;
      if($request->status=="Activo")
        $construction->status="0";
      else if($request->status=="Finalizado")
        $construction->status="1";
      else if($request->status=="Espera")
          $construction->status="2";
      $construction->client_id = $request->client_id;
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
         $construction->delete();
         $msg = [
             'title' => 'Eliminada!',
             'text' => 'Obra eliminada exitosamente.',
             'icon' => 'success'
         ];

         return response()->json($msg);
     }
}
