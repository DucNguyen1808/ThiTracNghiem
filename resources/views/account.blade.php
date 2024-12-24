@extends('layout.app')
@section('content')
    <div class="p-4 h-full overflow-auto">
        <form method="POST" enctype="multipart/form-data"
            action="{{ route('account.capnhathoso', ['id' => Auth::user()->id]) }}">
            @csrf
            @method('put')
            <div class="mx-auto shadow-md h-[250px] bg-white rounded-lg w-10/12 relative overflow-hidden">
                <div class="w-full h-2/3 "><img class="h-full w-full" src="{{ asset('storage/images/anhnen.jpg') }}"
                        alt="">
                </div>
                <div class="w-full h-1/3 ">
                </div>
                <img class="border-[2px] mr-4 w-[100px] h-[100px] object-fill rounded-full absolute bottom-4 left-6"
                    src="{{ Auth::user()->avatar != null ? asset('storage/images/' . Auth::user()->avatar) : asset('storage/images/default_avatar.png') }}"
                    alt="Lỗi">
                <div class="absolute bottom-5 left-[148px]">
                    <h4 class="text-[17px] font-semibold text-Mplanet">
                        {{ Auth::user()->name }}
                    </h4>
                    <p class="text-Mgray">chỉnh sửa hồ sơ</p>
                </div>
            </div>
            <div class="flex p-6 mt-6 mx-auto shadow-md min-h-[250px] bg-white rounded-lg w-10/12">
                <div class="w-1/2 pr-6">
                    <p>Hồ sơ</p>
                    <div class="mt-4 w-full  ">
                        <div>
                            <label class="text-Mplanet text-sm font-medium" for="tenMon">Họ tên</label>
                        </div>
                        <input value="{{ Auth::user()->name }}" type="text"
                            class="w-full border-2 p-1 rounded-[6px] outline-none" name="ten">
                    </div>
                    <div class="mt-4 w-full ">
                        <div>
                            <label class="text-Mplanet text-sm font-medium" for="email">Email</label>
                        </div>
                        <input value="{{ Auth::user()->email }}" type="text"
                            class="w-full border-2 p-1 rounded-[6px] outline-none" name="email">
                    </div>
                    <div class="mt-4 w-full flex items-center">
                        <label class="text-Mplanet text-sm font-medium mr-4" for="tenMon">Giới tính</label>
                        <input {{ Auth::user()->gioitinh == 'Nam' ? 'checked' : '' }} type="radio" value="Nam"
                            class="" name="gioitinh">Nam
                        <input {{ Auth::user()->gioitinh == 'Nữ' ? 'checked' : '' }} type="radio" value="Nữ"
                            class="ml-6" name="gioitinh">Nữ
                    </div>
                    <div class="mt-4 w-full ">
                        <div>
                            <label class="text-Mplanet text-sm font-medium" for="tenMon">Ngày sinh</label>
                        </div>
                        <input value="{{ Auth::user()->ngaysinh }}" type="date"
                            class="w-full border-2 p-1 rounded-[6px] outline-none" name="ngaysinh">
                    </div>

                    <div class="mt-4">
                        <label for="small-file-input" class="text-Mplanet text-sm font-medium">Chọn hình ảnh</label>
                        <input type="file" name="avatar" id="small-file-input"
                            class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                      file:bg-gray-50 file:border-0
                      file:me-4
                      file:py-2 file:px-4
                      dark:file:bg-neutral-700 dark:file:text-neutral-400">
                    </div>
                    <button class="mt-4 btn-primary">Cập nhật hồ sơ</button>
                </div>
        </form>
        <div class="pl-6 w-1/2">
            <form method="POST" action="{{ route('account.doimatkhau', ['id' => Auth::user()->id]) }}">
                @csrf
                @method('put')
                <h4>Mật khẩu</h4>
                @if ($errors->has('matkhaucukhongdung'))
                    <p class="text-red-400">Mật khẩu cũ không đúng</p>
                @endif
                <div class="mt-4 w-full  ">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Mật khẩu cũ</label>
                    </div>
                    <input type="text" class="w-full border-2 p-1 rounded-[6px] outline-none" name="matkhaucu">
                </div>
                <div class="mt-4 w-full ">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="email">Mật khẩu mới</label>
                    </div>
                    <input type="text" class="w-full border-2 p-1 rounded-[6px] outline-none" name="matkhaumoi">
                    <button class="mt-4 btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>

    <div class="h-[100px]">

    </div>
    </div>
@endsection
