<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $providers = Provider::select('id','name')->get();
      return view('product.index', compact('providers'));
    }

  public function showTableProduct()
  {
    $products = DB::table('products')
      ->select('providers.*','products.*')
      ->join('providers', 'providers.id', '=', 'products.provider_id')
      ->get();

      for($i=0; $i<$products->count(); $i++)
      {
        if($products[$i]->category == 0)
          $products[$i]->category = "Mano de obra";
        else if($products[$i]->category == 1)
          $products[$i]->category = "Material";
          else if($products[$i]->category == 2)
            $products[$i]->category = "Logística";

          $products[$i]->provider_id .= " " . $products[$i]->name;
      }

      return Datatables::of($products)
      ->addColumn('btn', 'product.partials.buttons')
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
      $providers = Provider::select('id','name')->get();
      return view('product.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $provider_id = "";
      for($i=0;$i<strlen($request->provider_id);$i++){
        if($request->provider_id[$i] != " ")
          $provider_id .= $request->provider_id[$i];
        else
          break;
      }
      $product = New Product;
      $product->provider_id = $provider_id;
      $product->concept =   $request->concept;
      $product->description =   $request->description;
      $product->save();

      $msg = [
          'title' => 'Creado!',
          'text' => 'Producto creado exitosamente.',
          'icon' => 'success'
      ];

      return redirect('product')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $provider_id = "";
      for($i=0;$i<strlen($request->provider_id);$i++){
        if($request->provider_id[$i] != " ")
          $provider_id .= $request->provider_id[$i];
        else
          break;
      }

      $product = Product::findOrFail($request->id);
      $product->provider_id = $provider_id;
      $product->concept = $request->concept;
      $product->description = $request->description;
      $product->save();
      /*$request->provider_id = $provider_id;

      $product = Product::findOrFail($request->id);
      $input = $request->all();
      $product->fill($input)->save();*/

      $msg = [
        'title' => 'Modificado!',
        'text' => 'Proveedor modificado exitosamente.',
        'icon' => 'success'
        ];

      return redirect('product')->with('message', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      $product->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Proveedor eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
