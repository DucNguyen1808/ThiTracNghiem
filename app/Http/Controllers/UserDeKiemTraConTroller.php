<?php

namespace App\Http\Controllers;

use App\Models\DapAn;
use App\Models\DeThi;
use App\Models\KetQua;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserDeKiemTraConTroller extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $nhoms = $user->nhoms;
        return view('user.dekiemtra', ['nhoms' => $nhoms]);
    }
    public function show(string $id)
    {
        $daThi = false;
        $user = Auth::user();
        $deThi = DeThi::find($id);
        $kq = KetQua::where('id_dethi', $deThi->id)->where('id_user', $user->id)->first();
        if ($kq != null)
            $kq = $kq->danop == 1 ? $kq : null;
        return view('user.detaildekiemtra', ['deThi' => $deThi, 'kq' => $kq]);
    }
    public function lamkiemtra(string $id)
    {
        $deThi = DeThi::find($id);
        if (date('Y-m-d H:i:s') > $deThi->tgketthuc)
            return redirect()->back();
        if (date('Y-m-d H:i:s') < $deThi->tgmode)
            return redirect()->back();

        $cauHois = $deThi->cauHois->all();
        $user = Auth::user();
        // Cache::forget("$user->id|$deThi->id");
        // dd('1111');
        $kq = KetQua::where('id_dethi', $deThi->id)->where('id_user', $user->id)->first();
        if ($kq == null) {
            $kq = new KetQua();
            $kq->id_user = $user->id;
            $kq->id_dethi = $deThi->id;
            $kq->tgvaothi = now();
            $kq->trangthailambai = 1;
            $kq->save();
        }
        if ($kq->danop == 1 && $kq->trangthailambai == 1) {
            return redirect()->route('user.dekiemtra.show', ['id' => $deThi->id]);
        }
        $startTime = Carbon::parse($kq->tgvaothi);
        $nowtTime = Carbon::parse(now());
        $timeUsed = $startTime->diffInMinutes($nowtTime);
        $thoiGianConLai = $deThi->tgthi - $timeUsed;
        if ($thoiGianConLai < 0) {
            return redirect()->route('user.dekiemtra.show', ['id' => $deThi->id]);
        }
        return view('user.lamkiemtra', ['thoiGianConLai' => $thoiGianConLai, 'deThi' => $deThi, 'cauHois' => $cauHois]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $deThi = DeThi::find($request->id_dethi);
        $cauHois = $deThi->cauHois->all();
        $sodiemmotcau = 10 / count($cauHois);
        $cbDapAns = $request->cbDapAns;
        $diem = 0;
        if ($request->cbDapAns != null) {
            $dsDapAnChon = DapAn::whereIn('id',  $cbDapAns)->get();
            foreach ($dsDapAnChon as $dapAnChon) {
                if ($dapAnChon->is_dapan == 1) {
                    $diem += 1;
                }
            }
            $diemRound = round($diem * $sodiemmotcau, 2);
            DB::table('ketqua')->where('id_dethi', $deThi->id)->where('id_user', $user->id)->update(['diem' => $diemRound, 'danop' => 1, 'socaudung' => $diem]);
        } else {
            DB::table('ketqua')->where('id_dethi', $deThi->id)->where('id_user', $user->id)->update(['diem' => 0, 'danop' => 1, 'socaudung' => 0]);
        }
        return redirect()->route('user.dekiemtra.show', ['id' => $deThi->id]);
    }
}
