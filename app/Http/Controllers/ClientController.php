<?php

namespace App\Http\Controllers;
use DB;
use App\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use CArbon\Carbon;

class ClientController extends Controller
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
        //

        return view('client.index');
    }
    public function showTableCl()
    {
      $clients = DB::table('clients')
      ->where('status', 1)
        ->get();

    //    dd($clients);

        return Datatables::of($clients)
        ->addColumn('btn', 'client.partials.buttons')
        ->rawColumns(['btn'])
      ->make(true);
    }

    public function showTableCC(Request $request)
    {
      $constructions = DB::table('constructions')
        ->select('constructions.*', 'constructions.id as construction_id' ,
        'constructions.name as construction_name','clients.*',
        'clients.id as client_id', 'clients.name as client_name')
        ->where('constructions.client_id', '=', $request->client_id)
        ->join('clients', 'clients.id', '=', 'constructions.client_id')
        ->get();
        for ($i=0; $i<$constructions->count(); $i++) {

          $constructions[$i]->date = Carbon::parse($constructions[$i]->date)->format('d-F-Y');
          $constructions[$i]->square_meter = number_format($constructions[$i]->square_meter,2);
          if($constructions[$i]->status=="0")
            $constructions[$i]->status="Activo";
          else if($constructions[$i]->status=="1")
            $constructions[$i]->status="Finalizado";
          else if($constructions[$i]->status=="2")
              $constructions[$i]->status="Espera";
        }
        return Datatables::of($constructions)
      ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('client.create');
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
        $client = New Client;
        $client->name = $request->name;
        $client->cellphone = $request->cellphone;
        $client->email = $request->email;
        $client->phonelandline = $request->phonelandline;
        $client->address = $request->address;
        $client->save();

        $msg = [
            'title' => 'Creado!',
            'text' => 'Clientes creado exitosamente.',
            'icon' => 'success'
        ];

        return redirect('client')->with('message', $msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //  dd($client);


        return view('client.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      $client = Client::findOrFail($request->id);
      $client->fill($request->all());
      $client->email = $request->email;
      $client->save();


  //   dd($input);
    /*
      $client->fill($input)->save();

*/
      $msg = [
        'title' => 'Modificado!',
        'text' => 'Cliente modificado exitosamente.',
        'icon' => 'success'
        ];

      return redirect('client')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
          $msg = [
              'title' => 'Eliminado!',
              'text' => 'Cliente eliminado exitosamente.',
              'icon' => 'success'
          ];

          return response()->json($msg);
    }
}
