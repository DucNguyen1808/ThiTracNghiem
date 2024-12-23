<?php

namespace App\Http\Controllers;

use App\Models\GiaoDeThi;
use App\Models\KetQua;
use App\Models\Nhom;
use Illuminate\Http\Request;

class GiaoDeThiController extends Controller
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
        GiaoDeThi::create([
            'id_dethi' => $request->id_dethi,
            'id_nhom' => $request->id_nhom,
        ]);
        $nhom = Nhom::find($request->id_nhom);
        $users = $nhom->users->all();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(GiaoDeThi $giaoDeThi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GiaoDeThi $giaoDeThi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GiaoDeThi $giaoDeThi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        GiaoDeThi::where('id_dethi', $id)->where('id_nhom', $request->id_nhom)->delete();
        return redirect()->back();
    }
}
