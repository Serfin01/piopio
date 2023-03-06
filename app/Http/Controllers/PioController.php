<?php

namespace App\Http\Controllers;

use App\Models\Pio;
use Illuminate\Http\Request;

class PioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Pio::with('user')->latest()->get());
        // return "Hola Pio";
        return view('pios.index',[
            'pios'=>Pio::with('user')->latest()->get(),
        ]);
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
        $validated=$request->validate([
            'message'=>'required|string|max:255',
        ]);
        // para debugear
        // dd($validated);
        // dd($request->user());
        $request->user()->pios()->create($validated);
        return redirect(route('pios.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function show(Pio $pio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function edit(Pio $pio)
    {
        $this->authorize('update',$pio);
        return view('pios.edit',[
            'pio'=>$pio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pio $pio)
    {
        $this->authorize('update',$pio);
        $validated=$request->validate([
            'message' => 'required|string|max:255',
        ]);
        $pio->update($validated);
        return redirect(route('pios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pio  $pio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pio $pio)
    {
        $this->authorize('delete',$pio);
        $pio->delete();
        return redirect(route('pios.index'));
    }
}
