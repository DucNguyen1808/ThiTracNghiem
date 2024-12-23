@extends('layout.app')


@section('content')
    <div class="p-4 h-full overflow-scroll">
        <h4 class="my-4 text-xl text-Mgray font-normal">Sửa nhóm</h4>
        <div>
            <form method="POST" action="{{ route('nhom.update',['nhom'=>$nhom->id]) }}">
                @csrf
                @method('put')
                <div class="flex items-center">
                    <div class="mr-2">
                        <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Năm
                            học</label>
                        <select id="hocKy" name="namHoc"
                            class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Chọn năm học</option>
                            @for ($year = 2010; $year <= date('Y'); $year++)
                                @php
                                    $Preyear = $year - 1;
                                @endphp
                                <option {{ $nhom->namhoc == "$Preyear - $year" ? 'selected' : '' }}
                                    value='{{ "$Preyear - $year" }}'>{{ "$Preyear - $year" }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Học
                            kỳ</label>
                        <select id="hocKy" name="hocKy"
                            class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Chọn học kỳ</option>
                            <option {{ $nhom->hocky == "I" ? 'selected' : '' }} value="I">I</option>
                            <option {{ $nhom->hocky == "II" ? 'selected' : '' }} value="II">II</option>

                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Tên nhóm</label>
                    </div>
                    <input value="{{ $nhom->tennhom }}" type="text" class="w-full border-2 p-1 rounded-[6px] outline-none" name="tenNhom">
                </div>
                <div class="mt-4">
                    <div>
                        <label class="text-Mplanet text-sm font-medium" for="tenMon">Sĩ số</label>
                    </div>
                    <input value="{{ $nhom->siso }}" type="text" class="w-full border-2 p-1 rounded-[6px] outline-none" name="siSo">
                </div>
                <div class="mt-4">
                    <button class="btn-success" type="submit">Lưu</button>
                    <button class="btn-warning" type="reset">Hủy</button>
                </div>
                @error('tenMon')
                    <p class="text-Merrors font-semibold">Tên môn không được để trống</p>
                @enderror
            </form>
        </div>
    </div>
@endsection
