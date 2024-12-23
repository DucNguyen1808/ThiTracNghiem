<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = null;
        $dsUser = User::get();
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
        return view('admin.user.index', ['dsUser' => $dsUser, 'sort' => $sort, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =  $request->validate([
            'ten' => 'required',
            'email' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required',
            'quyen' => 'required',
            'matkhau' => 'required',
        ]);
        $user = new User();
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->gioitinh = $request->gioitinh;
        $user->ngaysinh = $request->ngaysinh;
        $user->quyen = $request->quyen;
        $user->password = $request->matkhau;
        $user->trangthai = 1;
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('account');
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'ten' => 'required',
            'email' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required',
            'quyen' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->gioitinh = $request->gioitinh;
        $user->ngaysinh = $request->ngaysinh;
        $user->quyen = $request->quyen;
        $user->update();
        return redirect()->route('user.index');
    }
    public function capnhathoso(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'ten' => 'required',
            'email' => 'required',
            'gioitinh' => 'required',
            'ngaysinh' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = User::find($id);
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->gioitinh = $request->gioitinh;
        $user->ngaysinh = $request->ngaysinh;
        if ($request->file('avatar') != null) {
            $path = Storage::putFile('public/images', $request->file('avatar'));
            $user->avatar = basename($path);
        }
        $user->update();
        return redirect()->back();
    }
    public function doimatkhau(Request $request, string $id)
    {
        $validatedData =  $request->validate([
            'matkhaucu' => 'required',
            'matkhaumoi' => 'required',
        ]);
        $user = User::find($id);

        if (Hash::check($request->matkhaucu, $user->password)) {
            $user->password = $request->matkhaumoi;
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['matkhaucukhongdung' => 'Mật khẩu cũ không đúng']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id == 1)
            return redirect()->route('user.index');
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
