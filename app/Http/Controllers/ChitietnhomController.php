<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNhom;
use Illuminate\Http\Request;

class ChitietnhomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'id_user' => 'required',
            'id_nhom' => 'required',
        ]);
        $idNhom=$request->id_nhom;
        $chitietnhom = new ChiTietNhom();
        $chitietnhom->id_user = $request->id_user;
        $chitietnhom->id_nhom = $request->id_nhom;
        $chitietnhom->save();
        return redirect()->route('nhom.adduser',['id'=>$idNhom]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $chiTietNhom = ChiTietNhom::where('id_nhom',$id)->where('id_user',$request->id_user);
        $chiTietNhom->delete();
        return redirect()->route('nhom.show',['nhom'=>$id]);
    }
}
