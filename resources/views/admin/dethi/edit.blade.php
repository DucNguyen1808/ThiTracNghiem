@extends('layout.app')


@section('content')
    <div class="p-4 h-full overflow-scroll">
        <form class="" method="POST" action="{{ route('dethi.update',['dethi'=>$deThi->id]) }}">
            @csrf
            @method('PUT');
            <div class="w-full grid grid-cols-12">
                <div class="col-span-9">
                    <div class="m-auto p-4 bg-white w-10/12 rounded-lg border-[.1px]">
                        <p>Tạo mới đề thi</p>
                        @if ($errors->any())
                            <div class="mt-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-Merrors">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mt-4 w-full ">
                            <div>
                                <label class="text-Mplanet text-sm font-medium" for="tenMon">Tên đề</label>
                            </div>
                            <input value="{{ $deThi->tende }}" type="text" class="w-full border-2 p-1 rounded-[6px] outline-none" name="tende">
                        </div>
                        <div class="mt-4 w-full flex ">
                            <div class="w-9/12 mr-2">
                                <div>
                                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Thời gian bắt đầu</label>
                                </div>
                                <input value="{{ $deThi->tgmode }}" type="datetime-local" class="w-full border-2 p-1 rounded-[6px] outline-none" name="tgbatdau">
                            </div>
                            <div class="w-9/12 ml-2">
                                <div>
                                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Thời gian kết
                                        thúc</label>
                                </div>
                                <input value="{{ $deThi->tgketthuc }}" type="datetime-local" class="w-full border-2 p-1 rounded-[6px] outline-none" name="tgketthuc">
                            </div>
                        </div>
                        <div class="mt-4 w-full ">
                            <div>
                                <label class="text-Mplanet text-sm font-medium" for="tenMon">Thời gian làm bài</label>
                            </div>
                            <input value="{{ $deThi->tgthi }}" type="number" class="w-full border-2 p-1 rounded-[6px] outline-none" name="tglambai">
                        </div>
                        <div class="flex">
                            <div class="mt-4 w-full mr-2 ">
                                <div>
                                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Số câu dễ</label>
                                </div>
                                <input value="{{ $deThi->socaude }}" type="number" class="w-full border-2 p-1 rounded-[6px] outline-none" name="socaude">
                            </div>
                            <div class="mt-4 w-full mx-2 ">
                                <div>
                                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Số câu trung bình</label>
                                </div>
                                <input value="{{ $deThi->socautrungbinh }}" type="number" class="w-full border-2 p-1 rounded-[6px] outline-none" name="socautrungbinh">
                            </div>
                            <div class="mt-4 w-full ml-2">
                                <div>
                                    <label class="text-Mplanet text-sm font-medium" for="tenMon">Số câu khó</label>
                                </div>
                                <input value="{{ $deThi->socaukho }}" type="number" class="w-full border-2 p-1 rounded-[6px] outline-none" name="socaukho">
                            </div>
                        </div>
                        <div class="flex">
                            <div class="mt-4 mr-4">
                                <label for="countries"
                                    class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Môn
                                    học</label>
                                <select id="countries" name="idMonHoc"
                                    class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Chọn môn học</option>
                                    @foreach ($dsMonHoc as $monHoc)
                                        <option {{ $deThi->id_monhoc == $monHoc->id ? 'selected' : ''  }} value="{{ $monHoc->id }}">{{ $monHoc->tenmon }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="mt-4 btn-primary">Sửa đề thi</button>
                    </div>
                </div>
                <div class="col-span-3 flex flex-col bg-white p-4 rounded-lg border-[.1px]">
                    <h4>Cấu hình</h4>
                    <label class="mt-4 inline-flex items-center cursor-pointer">
                        <input name="troncauhoi" type="checkbox" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Trộn câu hỏi</span>
                    </label>
                    <label class="mt-2 inline-flex items-center cursor-pointer">
                        <input name="trondapan" type="checkbox" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Trộn đáp án</span>
                    </label>
                    <label class="mt-2 inline-flex items-center cursor-pointer">
                        <input name="xemdiemthi" type="checkbox" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Xem điểm thi</span>
                    </label>
                </div>

            </div>
        </form>
    </div>
@endsection
