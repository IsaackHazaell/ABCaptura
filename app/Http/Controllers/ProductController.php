<?php

namespace App\Http\Controllers;

use App\Product;
use App\Provider;
use App\Price;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
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
      $providers = Provider::where('category' , 1)->where('status' , 1)->orderBy('name', 'asc')->get();
      $products = Product::all();
      return view('product.index', compact('providers', 'products'));
    }

  public function showTableProduct()
  {
    $products = DB::table('products')
      ->select('providers.*','products.*',
      'prices.id as price_id', 'prices.price', 'prices.month', 'prices.year', 'prices.unity')
      ->join('providers', 'providers.id', '=', 'products.provider_id')
      ->join('prices', 'prices.product_id', '=', 'products.id')
      ->where('providers.category', '=' , '1')
      ->where('prices.status', '=' , '1')
      ->where('providers.status', '=', '1')
      ->get();
      for($i=0; $i<$products->count(); $i++)
      {
          $products[$i]->price = number_format($products[$i]->price,2);

          $products[$i]->provider_id .= " " . $products[$i]->name;
          $month = ProductController::month($products[$i]->month);
          $products[$i]->month = $month;
          $products[$i]->month .= " " . $products[$i]->year;
      }
      return Datatables::of($products)
      ->addColumn('btn', 'product.partials.buttons')
      ->rawColumns(['btn'])
    ->make(true);
  }

  public function month($month)
  {
        if($month == 1)
          $month = "Enero";
        else if($month == 2)
          $month = "Febrero";
          else if($month == 3)
            $month = "Marzo";
            else if($month == 4)
              $month = "Abril";
              else if($month == 5)
                $month = "Mayo";
                else if($month == 6)
                  $month = "Junio";
                  else if($month == 7)
                    $month = "Julio";
                    else if($month == 8)
                      $month = "Agosto";
                      else if($month == 9)
                        $month = "Septiembre";
                        else if($month == 10)
                          $month = "Octubre";
                          else if($month == 11)
                            $month = "Noviembre";
                            else if($month == 12)
                              $month = "Diciembre";
      return $month;
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //$providers = Provider::select('id','name')->where('category',1)->where('status',1)->get();
      $providers = Provider::select('id','name')->where('category',1)->where('status',1)->orderBy('name', 'asc')->get();
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
      $product->concept = $request->concept;
      $product->description = $request->description;
      $product->save();

      $price = New Price;
      $price->product_id = $product->id;
      $price->unity = $request->unity;
      $price->price = $request->price;
      $price->year = $request->year;
      $price->month = $request->month;
      $price->save();

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

      $price = Price::where('product_id', $product->id)->firstOrFail();
      $price->fill($request->all());
      $price->save();

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
      $product->price->status = 0;
      $product->price->save();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Proveedor eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
