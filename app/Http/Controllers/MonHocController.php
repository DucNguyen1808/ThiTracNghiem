<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use Illuminate\Support\Facades\Auth;

class MonHocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message=null;
        $dsMonHoc = MonHoc::get();
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsMonHoc = MonHoc::orderBy($column, $type)->get();
        }
        if($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsMonHoc = MonHoc::whereRaw('LOWER(tenmon) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsMonHoc) == 0 ? 'Không tìm thấy môn học' : null;
        }

        $sort = $request->get('sort');
        return view('admin.monhoc.index', ['dsMonHoc' => $dsMonHoc, 'sort' => $sort,'message'=>$message]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.monhoc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'tenMon' => 'required',
        ]);
        $monHoc = new MonHoc();
        $monHoc->tenmon = $request->tenMon;
        $monHoc->save();
        return redirect()->route('monhoc.index');
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
        $monHoc = MonHoc::find($id);
        return view('admin.monhoc.edit', ['monHoc' => $monHoc]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'tenMon' => 'required',
        ]);
        $monHoc = MonHoc::find($id);
        $monHoc->tenmon = $request->tenMon;
        $monHoc->save();
        return redirect()->route('monhoc.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $monHoc = MonHoc::find($id);
        $monHoc->delete();
        return redirect()->route('monhoc.index');
    }
}
