<?php

namespace App\Http\Controllers;

use App\Provider;
use App\Capture;
use App\Statement;
use App\Product;
use App\Address;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProviderController extends Controller
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
        return view('provider.index');
    }

    public function showTableP()
    {
      $providers = DB::table('providers')
        ->select('providers.*', 'providers.id as provider_id', 'addresses.*', 'addresses.id as address_id')
        ->join('addresses', 'addresses.provider_id', '=', 'providers.id')
        ->where('providers.status', '=', 1)
        ->get();

        for($i=0; $i<$providers->count(); $i++)
        {
          if($providers[$i]->category == 0)
            $providers[$i]->category = "Mano de obra";
          else if($providers[$i]->category == 1)
            $providers[$i]->category = "Material";
            else if($providers[$i]->category == 2)
              $providers[$i]->category = "Logística";
        }

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

        $msg = [
            'title' => 'Creado!',
            'text' => 'Proveedor creado exitosamente.',
            'icon' => 'success'
        ];

        return redirect('provider')->with('message', $msg);
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
        if($provider->category == 0)
          $provider->category = "Mano de obra";
        else if($provider->category == 1)
          $provider->category = "Material";
          else if($provider->category == 2)
            $provider->category = "Logística";
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        // 0 = muerto, 1 = vivo
        $captures = Capture::where('provider_id', $provider->id)->first();
        $products = Product::where('provider_id', $provider->id)->first();
        $statement = Statement::where('provider_id', $provider->id)->first();
        if($captures == null && $products == null)
        {
            $provider->delete();
        }
        else
        {
            $provider->status = 0;
            $provider->save();
            $statement->status=0;
            $statement->save();
        }
        $msg = [
            'title' => 'Eliminado!',
            'text' => 'Proveedor eliminado exitosamente.',
            'icon' => 'success'
        ];
        return response()->json($msg);
    }
}
