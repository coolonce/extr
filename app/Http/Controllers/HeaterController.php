<?php

namespace App\Http\Controllers;

use App\Models\Heater;
use Illuminate\Http\Request;

class HeaterController extends Controller
{


    public function get(Request $request)
    {
        return response()->json(["data" => Heater::all()]);
    }


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
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Heater  $heater
     * @return \Illuminate\Http\Response
     */
    public function show(Heater $heater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Heater  $heater
     * @return \Illuminate\Http\Response
     */
    public function edit(Heater $heater)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Heater  $heater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Heater $heater)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Heater  $heater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Heater $heater)
    {
        //
    }
}
