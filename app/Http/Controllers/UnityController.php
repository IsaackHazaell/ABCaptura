<?php

namespace App\Http\Controllers;

use DB;
use App\Unity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unity.index');
    }

    public function showTableU()
    {
      $unities = DB::table('unities')
        ->select('unities.*')
        ->get();

        return Datatables::of($unities)
        ->addColumn('btn', 'unity.actions')
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
        return view('unity.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $unity = New unity;
      $unity->name = $request->name;
      $unity->reference = $request->reference;
      $unity->equivalent = $request->equivalent;
      $unity->save();
      return view('unity.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function show(Unity $unity)
    {
      return view('unity.show')->with('unity',$unity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function edit(Unity $unity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unity $unity)
    {
      $unity = unity::findOrFail($request->id);
      $input = $request->all();
      $unity->fill($input)->save();

      // $address = Address::where('unity_id', $request->id)->firstOrFail();
      // $address->fill($input)->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Unidad modificado exitosamente.',
        'icon' => 'success'
        ];

        return view('unity.index', $msg);
      //return redirect('unity')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unity $unity)
    {
      $unity->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Unidad eliminada exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
