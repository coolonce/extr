<?php

namespace App\Http\Controllers;

use App\Models\Coolant;
use Illuminate\Http\Request;

class CoolantController extends Controller
{

    public function get(Request $request)
    {
        return response()->json(["data" => Coolant::all()]);
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
     * @param  \App\Coolant  $coolant
     * @return \Illuminate\Http\Response
     */
    public function show(Coolant $coolant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coolant  $coolant
     * @return \Illuminate\Http\Response
     */
    public function edit(Coolant $coolant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coolant  $coolant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coolant $coolant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coolant  $coolant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coolant $coolant)
    {
        //
    }
}
