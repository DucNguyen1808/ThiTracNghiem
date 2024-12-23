<?php

namespace App\Http\Controllers;

use App\Models\CauHoi;
use App\Models\ChiTietDeThi;
use App\Models\DeThi;
use Illuminate\Http\Request;

class ChiTietDeThiController extends Controller
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

    public function create($id, Request $request)
    {
        $deThi = DeThi::find($id);
        $dsCauHoi = $deThi->monHoc->cauHois->filter(function ($cauHoi) use ($deThi) {
            return !$deThi->cauHois->contains($cauHoi);
        })->map(function ($cauHoi) {
            $cauHoi->dapAns = $cauHoi->dapAns;
            return $cauHoi;
        });

        if ($request->get('dokho') != null) {
            if ($request->get('dokho') != 0) {
                $dsCauHoi = $dsCauHoi->filter(function ($cauHoi) use ($request) {
                    return $cauHoi->dokho == $request->get('dokho');
                });
            }
        }
        if ($request->get('searchKey') != null) {
            $searchKey = strtolower($request->get('searchKey'));
            $dsCauHoi = $dsCauHoi->filter(function ($cauHoi) use ($searchKey) {
                return strpos(strtolower($cauHoi->noidung), $searchKey) !== false;
            });
        }
        $deCount = $deThi->cauHois->where('dokho', 1)->count();
        $trungBinhCount = $deThi->cauHois->where('dokho', 2)->count();
        $khoCount = $deThi->cauHois->where('dokho', 3)->count();
        return view('admin.dethi.addcauhoi', [
            'deThi' => $deThi,
            'dsCauHoi' => $dsCauHoi,
            'deCount' => $deCount,
            'trungBinhCount' => $trungBinhCount,
            'khoCount' => $khoCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $deThi = DeThi::find($request->id_dethi);
        $cauHoi = CauHoi::find($request->id_cauhoi);

        $easyCount = $deThi->cauHois->where('dokho', 1)->count();
        $mediumCount = $deThi->cauHois->where('dokho', 2)->count();
        $hardCount = $deThi->cauHois->where('dokho', 3)->count();

        $maxEasy = $deThi->socaude;
        $maxMedium = $deThi->socautrungbinh;
        $maxHard = $deThi->socaukho;

        if (($cauHoi->dokho == 1 && $easyCount >= $maxEasy) ||
            ($cauHoi->dokho == 2 && $mediumCount >= $maxMedium) ||
            ($cauHoi->dokho == 3 && $hardCount >= $maxHard)
        ) {
            return redirect()->back()->withErrors(['msg' => 'Số lượng câu hỏi đã đạt giới hạn']);
        }
        ChiTietDeThi::create([
            'id_de' => $request->id_dethi,
            'id_cauhoi' => $request->id_cauhoi,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ChiTietDeThi $chiTietDeThi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChiTietDeThi $chiTietDeThi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChiTietDeThi $chiTietDeThi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $ChiTietDeThi = ChiTietDeThi::where('id_de', $id)->where('id_cauhoi', $request->id_cauhoi);
        $ChiTietDeThi->delete();
        return redirect()->back();
    }
}
