@extends('layout.app')


@section('content')
    <div class="p-4">
        <h4 class="my-4 text-xl text-Mgray font-normal">Thêm môn học</h4>
        <div>
            <form method="POST" action="{{ route('monhoc.store') }}">
                @csrf
                <div>
                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Tên môn học</label>
                </div>
                <div>
                    <input type="text" class="w-1/2 border-2 p-1 rounded-[6px] outline-none" name="tenMon">
                    <button class="ml-2 btn-success" type="submit">Lưu</button>
                </div>
                @error('tenMon')
                    <p class="text-Merrors font-semibold">Tên môn không được để trống</p>
                @enderror
            </form>
        </div>
    </div>
@endsection
