<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Address;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('provider.index');
    }

    public function showTableP()
    {
      $providers = DB::table('providers')
        ->select('providers.*','addresses.*')
        ->join('addresses', 'addresses.provider_id', '=', 'providers.id')
        ->get();

        return Datatables::of($providers)
        ->addColumn('btn', 'provider.actions')
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
        return view('provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->flash();
        $provider = Provider::create($request->all());

        $address = New Address;
        if($request->street != null)
          $address->street = $request->street;
        if($request->colony != null)
          $address->colony = $request->colony;
        if($request->town != null)
          $address->town = $request->town;
        if($request->state != null)
          $address->state = $request->state;

        $address->provider_id = $provider->id;
        $address->save();
        return view('provider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        $address = DB::table('addresses')->where('provider_id', $provider->id)->first();
        return view('provider.show')->with('provider',$provider)->with('address',$address);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $provider = Provider::findOrFail($request->id);
      $input = $request->all();
      $provider->fill($input)->save();

      $address = Address::where('provider_id', $request->id)->firstOrFail();
      $address->fill($input)->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Proveedor modificado exitosamente.',
        'icon' => 'success'
        ];

      return redirect('provider')->with('message', $msg);
      //return view('provider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        $msg = [
            'title' => 'Eliminado!',
            'text' => 'Proveedor eliminado exitosamente.',
            'icon' => 'success'
        ];

        return response()->json($msg);
    }
}
