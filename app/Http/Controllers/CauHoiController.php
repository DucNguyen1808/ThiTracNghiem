<?php

namespace App\Http\Controllers;

use App\Models\CauHoi;
use App\Models\DapAn;
use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;
use VanOns\Laraberg\Laraberg;

class CauHoiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = null;
        $dsCauHoi = CauHoi::all();
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsCauHoi = CauHoi::orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsCauHoi = CauHoi::whereRaw('LOWER(noidung) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsCauHoi) == 0 ? 'Không tìm thấy câu hỏi' : null;
        }

        $sort = $request->get('sort');

        return view('admin.CauHoi.index', ['dsCauHoi' => $dsCauHoi, 'sort' => $sort, 'message' => $message]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dsMonHoc = MonHoc::get();
        return view('admin.CauHoi.create', ['dsMonHoc' => $dsMonHoc]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData =  $request->validate([
            'idMonHoc' => 'required',
            'doKho' => 'required',
            'dapAnDung' => 'required',
            'ndCauHoi' => 'required',
            'ndDapAns' => 'required',
            'ndDapAns' => 'required|array',
            'ndDapAns.*' => 'required'
        ]);
        $cauHoi = new CauHoi();
        $cauHoi->noidung = $request->ndCauHoi;
        $cauHoi->dokho = $request->doKho;
        $cauHoi->id_monhoc = $request->idMonHoc;
        $cauHoi->save();
        foreach ($request->ndDapAns as $index => $ndDapAn) {
            $dapAn = new DapAn();
            $dapAn->noidung = $ndDapAn;
            $dapAn->id_cauhoi = $cauHoi->id;
            $dapAn->is_dapan = false;
            if ($request->dapAnDung == $index)
                $dapAn->is_dapan = true;
            $dapAn->save();
        }
        return redirect()->route('cauhoi.index');
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
        $dsMonHoc = MonHoc::get();
        $cauHoi = CauHoi::find($id);
        return view('admin.cauhoi.edit', ['dsMonHoc' => $dsMonHoc, 'cauHoi' => $cauHoi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'idMonHoc' => 'required',
            'doKho' => 'required',
            'dapAnDung' => 'required',
            'ndCauHoi' => 'required',
            'ndDapAns' => 'required',
        ]);
        $cauHoi = CauHoi::find($id);
        $cauHoi->noidung = $request->ndCauHoi;
        $cauHoi->dokho = $request->doKho;
        $cauHoi->id_monhoc = $request->idMonHoc;
        $cauHoi->update();
        foreach ($request->ndDapAns as $index => $ndDapAn) {
            $dapAn = $cauHoi->dapAns[$index];
            $dapAn->noidung = $ndDapAn;
            $dapAn->id_cauhoi = $cauHoi->id;
            $dapAn->is_dapan = false;
            if ($request->dapAnDung == $index)
                $dapAn->is_dapan = true;
            $dapAn->update();
        }
        return redirect()->route('cauhoi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cauHoi = CauHoi::find($id);
        $cauHoi->delete();
        return redirect()->route('cauhoi.index');
    }
}
