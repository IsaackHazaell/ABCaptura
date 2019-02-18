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
        ->select('providers.*','addresses.*')
        ->join('addresses', 'addresses.provider_id', '=', 'providers.id')
        ->get();

        //dd($providers);
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
      //dd($request->all());
      $provider = Provider::findOrFail($request->id);
      $input = $request->all();
      $provider->fill($input)->save();

      $address = Address::where('provider_id', $request->id)->firstOrFail();
      $address->fill($input)->save();
      /*$provider->name = $request->name;
      $provider->comments = $request->comments;
      $provider->save();*/

      /*$data = data_contact::findOrFail($client->data_contact_id);
      $data->name = $request->name;
      $data->lastname = $request->lastname;
      $data->phone1 = $request->phone1;
      $data->phone2 = $request->phone2;
      $data->email = $request->email;
      $data->save();*/


      return view('provider.index');
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
