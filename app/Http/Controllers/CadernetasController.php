<?php

namespace App\Http\Controllers;

use App\Caderneta;
use Illuminate\Http\Request;

class CadernetasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $caderneta = Caderneta::all();
        $caderneta = '';
        //dd($usuarios);
        return view('cadernetas.index')->with(compact('caderneta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadernetas.create');
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
     * @param  \App\Caderneta  $caderneta
     * @return \Illuminate\Http\Response
     */
    public function show(Caderneta $caderneta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Caderneta  $caderneta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$caderneta = Caderneta::find($id);
        $caderneta = '';
        return view('cadernetas.edit')->with(compact('caderneta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Caderneta  $caderneta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caderneta $caderneta)
    {
        dd('testando');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Caderneta  $caderneta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caderneta $caderneta)
    {
        //
    }
}
