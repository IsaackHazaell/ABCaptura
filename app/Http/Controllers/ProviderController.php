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

    public function showTable()
    {
      $providers = DB::table('providers')
        ->select('providers.*')
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
        $provider = Provider::create($request->all());
        if($request->street != null)
        {
          $address = New Address;
          $address->street = $request->street;
          $address->colony = $request->colony;
          $address->town = $request->town;
          $address->state = $request->state;
          $address->provider_id = $provider->id;
          $address->save();
        }
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

        if(empty($address))
        {
          $address = New Address;
          $address->street = null;
          $address->colony = null;
          $address->town = null;
          $address->state = null;
        }
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
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
