@extends('layout.app')


@section('content')
    <div class="p-4 h-full overflow-scroll">
        <h4 class="my-4 text-xl text-Mgray font-normal">Thêm nhóm</h4>
        <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
            <div class="mx-auto flex items-center flex-col w-3/4 bg-white rounded-lg p-4 ">
                @csrf
                @method('put')
                <div class="mt-4 w-full ">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Họ tên</label>
                    </div>
                    <input value="{{ $user->name }}" type="text" class="w-full border-2 p-1 rounded-[6px] outline-none"
                        name="ten">
                </div>
                <div class="mt-4 w-full">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Email</label>
                    </div>
                    <input value="{{ $user->email }}" type="text" class="w-full border-2 p-1 rounded-[6px] outline-none"
                        name="email">
                </div>
                <div class="mt-4 w-full flex items-center">
                    <label class="text-Mplanet text-sm font-medium mr-4" for="tenMon">Giới tính</label>
                    <input {{ $user->gioitinh == 'Nam' ? 'checked' : '' }} type="radio" value="Nam" class=""
                        name="gioitinh">Nam
                    <input {{ $user->gioitinh == 'Nữ' ? 'checked' : '' }} type="radio" value="Nữ" class="ml-6"
                        name="gioitinh">Nữ
                </div>
                <div class="mt-4 w-full">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Ngày sinh</label>
                    </div>
                    <input value="{{ $user->ngaysinh }}" type="date"
                        class="w-full border-2 p-1 rounded-[6px] outline-none" name="ngaysinh">
                </div>
                <div class="mt-4 w-full">
                    <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Nhóm
                        quền</label>
                    <select id="hocKy" name="quyen"
                        class="bg-gray-50 border w-full border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected></option>
                        <option value="1" {{ $user->quyen == 1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $user->quyen == 2 ? 'selected' : '' }}>Sinh viên</option>
                    </select>
                </div>
                <div class="mt-4 self-start">
                    <button class="btn-success" type="submit">Lưu</button>
                    <button class="btn-warning" type="reset">Hủy</button>
                </div>
                @error('tenMon')
                    <p class="text-Merrors font-semibold">Tên môn không được để trống</p>
                @enderror
            </div>
        </form>
    </div>
@endsection
