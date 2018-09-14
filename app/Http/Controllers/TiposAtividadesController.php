<?php

namespace App\Http\Controllers;

use App\TiposAtividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TiposAtividadesController extends Controller
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
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TiposAtividades  $tiposAtividades
     * @return \Illuminate\Http\Response
     */
    public function show(TiposAtividades $tiposAtividades)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TiposAtividades  $tiposAtividades
     * @return \Illuminate\Http\Response
     */
    public function edit(TiposAtividades $tiposAtividades)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TiposAtividades  $tiposAtividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiposAtividades $tiposAtividades)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TiposAtividades  $tiposAtividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiposAtividades $tiposAtividades)
    {
        if (Gate::denies('gerenciar')) {
            return abort(403);
        }
    }
}
