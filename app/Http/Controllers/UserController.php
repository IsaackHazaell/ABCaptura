<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
      return view('user.index');
    }

    public function showTableU()
    {
      $users = DB::table('users')
        ->select('users.*')
        ->get();
        //dd($users);
        return Datatables::of($users)
        ->addColumn('btn', 'user.actions')
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
      return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'max:255'],
        'user_type' => ['required'],
      ]);

    //  dd("hola");
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => $request->user_type,
      ]);

      $msg = [
          'title' => 'Creado!',
          'text' => 'Usuario creado exitosamente.',
          'icon' => 'success',
      ];



      return redirect('user')->with('message', $msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      return view('user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $user = User::findOrFail($request->id);
      $input = $request->except('password');
      if($request->password != $user->password )
      {
        $user->password = Hash::make($request->password);
      }
      $user->fill($input)->save();

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Usuario modificado exitosamente.',
        'icon' => 'success'
        ];
        return redirect('user')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      if($user->user_type == 'User'){
        $client = Client::where('email', $user->email)->first();
              $client->status = 0;
              $client->save();
      }

      $user->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Usuario eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
