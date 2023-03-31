<?php

namespace App\Http\Controllers;

use App\Models\Khoas;
use App\Http\Requests\StoreKhoasRequest;
use App\Http\Requests\UpdateKhoasRequest;

class KhoasController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKhoasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKhoasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Khoas  $khoas
     * @return \Illuminate\Http\Response
     */
    public function show(Khoas $khoas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Khoas  $khoas
     * @return \Illuminate\Http\Response
     */
    public function edit(Khoas $khoas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKhoasRequest  $request
     * @param  \App\Models\Khoas  $khoas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKhoasRequest $request, Khoas $khoas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Khoas  $khoas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Khoas $khoas)
    {
        //
    }
}
