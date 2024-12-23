<?php

namespace App\Http\Controllers;

use App\Models\Nhom;
use App\Models\User;
use Illuminate\Http\Request;

class NhomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = null;
        $dsNhom = Nhom::get();
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsNhom = Nhom::orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsNhom = Nhom::whereRaw('LOWER(tennhom) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsNhom) == 0 ? 'Không tìm thấy nhóm' : null;
        }

        $sort = $request->get('sort');
        return view('admin.nhom.index', ['dsNhom' => $dsNhom, 'sort' => $sort, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.nhom.create');
    }
    public function adduser(string $id,Request $request)
    {
        $message = null;
        $dsUser = User::whereNotIn('id',function($query) use ($id){
            $query->select('id_user')
                  ->from('chitietnhom')
                  ->where('id_nhom',$id);
        })->get();
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsUser = User::orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsUser = User::whereRaw('LOWER(name) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsUser) == 0 ? 'Không tìm thấy người dùng' : null;
        }
        $sort = $request->get('sort');
        return view('admin.nhom.adduser', ['idNhom'=>$id,'dsUser' => $dsUser, 'sort' => $sort, 'message' => $message]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'tenNhom' => 'required',
            'siSo' => 'required|integer',
            'namHoc' => 'required',
            'hocKy' => 'required',
        ]);
        $nhom = new Nhom();
        $nhom->tennhom = $request->tenNhom;
        $nhom->siso = $request->siSo;
        $nhom->namhoc = $request->namHoc;
        $nhom->hocky = $request->hocKy;
        $nhom->save();
        return redirect()->route('nhom.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Request $request)
    {
        $dsUser = Nhom::find($id)->users;
        $nhom = Nhom::find($id);
        $message = null;
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsUser = Nhom::find($id)->users()->orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsUser = Nhom::find($id)->users()->whereRaw('LOWER(name) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsUser) == 0 ? 'Không tìm thấy người dùng' : null;
        }
        $sort = $request->get('sort');
        return view('admin.nhom.detail', ['dsUser' => $dsUser,'sort'=>$sort,'nhom'=>$nhom]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nhom = Nhom::find($id);
        return view('admin.nhom.edit', ['nhom' => $nhom]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'tenNhom' => 'required',
            'siSo' => 'required|integer',
            'namHoc' => 'required',
            'hocKy' => 'required',
        ]);
        $nhom = Nhom::find($id);
        $nhom->tennhom = $request->tenNhom;
        $nhom->siso = $request->siSo;
        $nhom->namhoc = $request->namHoc;
        $nhom->hocky = $request->hocKy;
        $nhom->save();
        return redirect()->route('nhom.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nhom = Nhom::find($id);
        $nhom->delete();
        return redirect()->route('nhom.index');
    }
}
