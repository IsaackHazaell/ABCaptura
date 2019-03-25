<?php

namespace App\Http\Controllers;

use App\Price;
use App\Product;
use App\Unity;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::select('id','concept')->get();
      $unities = Unity::select('id','name')->get();
      return view('price.index')->with('products', $products)->with('unities', $unities);
    }

    public function showTablePrice()
    {
      $prices = DB::table('prices')
        ->select('products.id as id_product', 'products.concept as concept_product',
        'unities.id as id_unity', 'unities.name as name_unity',
        'prices.*')
        ->join('products', 'products.id', '=', 'prices.product_id')
        ->join('unities', 'unities.id', '=', 'prices.unity_id')
        ->get();
        $month="";
        for($i=0; $i<$prices->count(); $i++)
        {
            $month = PriceController::month($prices[$i]->month);
            $prices[$i]->month = $month;
        }

        return Datatables::of($prices)
        ->addColumn('btn', 'price.partials.buttons')
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
      $products = Product::select('id','concept')->get();
      $unities = Unity::select('id','name')->get();
      return view('price.create')->with('products', $products)->with('unities', $unities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $product_id = "";
      for($i=0;$i<strlen($request->product_id);$i++){
        if($request->product_id[$i] != " ")
          $product_id .= $request->product_id[$i];
        else
          break;
      }

      $unity_id = "";
      for($i=0;$i<strlen($request->unity_id);$i++){
        if($request->unity_id[$i] != " ")
          $unity_id .= $request->unity_id[$i];
        else
          break;
      }

      $price = New Price;
      $price->product_id = $product_id;
      $price->unity_id = $unity_id;
      $price->price = $request->price;
      $price->year = $request->year;
      $price->month = $request->month;
      $price->save();

      $msg = [
          'title' => 'Creado!',
          'text' => 'Precio creado exitosamente.',
          'icon' => 'success'
      ];

      return redirect('price')->with('message', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
      $price->delete();
      $msg = [
          'title' => 'Eliminado!',
          'text' => 'Producto eliminado exitosamente.',
          'icon' => 'success'
      ];

      return response()->json($msg);
    }
}
