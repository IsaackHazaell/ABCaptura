<?php

namespace App\Http\Controllers;

use App\construction;
use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('construction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $construction= construction::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(construction $construction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function edit(construction $construction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, construction $construction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(construction $construction)
    {
        //
    }
}
