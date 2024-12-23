<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNhom;
use App\Models\DeThi;
use App\Models\GiaoDeThi;
use App\Models\KetQua;
use App\Models\MonHoc;
use App\Models\Nhom;
use Illuminate\Http\Request;

class DeThiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = null;
        $dsDeThi = DeThi::get();
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsDeThi = DeThi::orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsDeThi = DeThi::whereRaw('LOWER(tende) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsDeThi) == 0 ? 'Không tìm thấy nhóm' : null;
        }

        $sort = $request->get('sort');
        return view('admin.dethi.index', ['dsDeThi' => $dsDeThi, 'sort' => $sort, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dsMonHoc = MonHoc::get();
        $dsNhom = Nhom::get();
        return view('admin.dethi.create', ['dsMonHoc' => $dsMonHoc, 'dsNhom' => $dsNhom]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tende' => 'required|string|max:255',
            'tglambai' => 'required|integer|min:1',
            'tgbatdau' => 'required|date|before:tgketthuc',
            'tgketthuc' => 'required|date',
            'idMonHoc' => 'required|integer|exists:monhoc,id',
            'socaude' => 'required|integer|min:1',
            'socautrungbinh' => 'required|integer|min:0',
            'socaukho' => 'required|integer|min:0',
        ]);

        $deThi = new DeThi();
        $deThi->tende = $request->tende;
        $deThi->tgthi = $request->tglambai;
        $deThi->tgmode = $request->tgbatdau;
        $deThi->tgketthuc = $request->tgketthuc;
        $deThi->troncauhoi = $request->troncauhoi === 'on' ? true : false;
        $deThi->trondapan = $request->trondapan === 'on' ? true : false;
        $deThi->xemdiemthi = $request->xemdiemthi === 'on' ? true : false;
        $deThi->id_monhoc = $request->idMonHoc;
        $deThi->socaude = $request->socaude;
        $deThi->socautrungbinh = $request->socautrungbinh;
        $deThi->socaukho = $request->socaukho;
        $deThi->save();

        if (isset($request->dsNhom)) {
            foreach ($request->dsNhom as $nhom) {
                GiaoDeThi::create([
                    'id_nhom' => $nhom,
                    'id_dethi' => $deThi->id
                ]);
            }
        }
        return redirect()->route('dethi.addcauhoi', ['id' => $deThi->id]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $dsNhom = DeThi::find($id)->nhoms;
        $deThi = DeThi::find($id);
        $message = null;
        if ($request->get('sort')['enabel']) {
            $column = $request->get('sort')['column'];
            $type = $request->get('sort')['type'];
            $dsNhom = DeThi::find($id)->nhoms()->orderBy($column, $type)->get();
        }
        if ($request->get('searchKey')) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsNhom = DeThi::find($id)->nhoms()->whereRaw('LOWER(name) LIKE ?', ['%' . $searchKey . '%'])->get();
            $message = count($dsNhom) == 0 ? 'Không tìm thấy người dùng' : null;
        }
        $excludedNhomIds = $deThi->nhoms->pluck('id')->toArray();
        $dsNhomNotInDeThi = Nhom::whereNotIn('id', $excludedNhomIds)->get();

        $sort = $request->get('sort');
        return view('admin.dethi.detail', ['dsNhom' => $dsNhom, 'sort' => $sort, 'deThi' => $deThi, 'dsNhomNotInDeThi' => $dsNhomNotInDeThi]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeThi $deThi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeThi $deThi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeThi $deThi)
    {
        //
    }
}
