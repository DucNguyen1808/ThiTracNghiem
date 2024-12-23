@extends('layout.app')


@section('content')
    <div class="p-4 w-full h-full grid grid-cols-12 ">
        <div class="h-full col-span-4 mr-8 p-4 overflow-auto">
            @if ($errors->has('msg'))
                <p class="text-Merrors font-semibold">
                    {{ $errors->first('msg') }}
                </p>
            @endif
            <div class="w-full  flex justify-end items-center">
                <form class="w-full px-2 py-1 bg-Mcontrol flex rounded-lg" action="" method="GET">
                    <input name="searchKey" class="w-full bg-Mcontrol flex-auto outline-none caret-Mplanet text-[12px]"
                        type="text" placeholder="Tìm kiếm câu hỏi">
                    <button type="submit" class="mr-2 text-Mgray cursor-pointer hover:text-Mplanet"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="mt-4">
                <div class="mr-4">
                    <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Độ
                        khó</label>
                    <select id="doKho" name="doKho"
                        class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Chọn độ khó</option>
                        <option value="0">Tất cả</option>
                        <option value="1">Dễ</option>
                        <option value="2">Trung bình</option>
                        <option value="3">Khó</option>
                    </select>
                </div>
            </div>
            <ul class="mt-3 list-cauhoi">
                @foreach ($dsCauHoi as $item)
                    @php
                        $dokhos = ['Dễ', 'Trung bình', 'Khó'];
                        $dokho = $dokhos[$item->dokho - 1];
                    @endphp
                    <form method="POST" action="{{ route('ChiTietDeThi.store') }} ">
                        @csrf
                        <li class="p-4 bg-white border-[1px] text-[14px] text-Mplanet flex items-center">
                            <span>{!! $item->noidung !!}</span>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-2">{{ $dokho }}</span>
                            <input type="hidden" name="id_cauhoi" value="{{ $item->id }}">
                            <input type="hidden" name="id_dethi" value="{{ $deThi->id }}">
                            <button class="ml-auto btn-primary" type="submit"><i class="fa-solid fa-plus"></i></button>
                        </li>
                    </form>
                @endforeach
            </ul>
        </div>
        <div class="overflow-auto  col-span-8 ">
            <div class="p-5 w-full min-h-[300px] bg-white rounded-md border-gray-200 border-[1px]">
                <div class="flex justify-between items-center">
                    <div>
                        <span>Số lượng</span>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-2">Dễ
                            {{ $deCount }} / {{ $deThi->socaude }}</span>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-2">Trung
                            bình {{ $trungBinhCount }} / {{ $deThi->socautrungbinh }}</span>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ml-2">Khó
                            {{ $khoCount }} / {{ $deThi->socaukho }}</span>
                    </div>
                    <div>
                        <a href="{{ route('dethi.index') }}" class="btn-primary"><i class="fa-regular fa-floppy-disk"></i> Tạo Đề Thi</a>
                    </div>
                </div>
                <p class="mt-4 text-center">{{ $deThi->tende }}</p>
                <p class="mt-2 text-center">Thời Gian: {{ $deThi->tgthi }} phút</p>
                <div class="mt-4">
                    <ul id='dscauhoichon'>
                        @foreach ($deThi->cauHois as $item)
                            <li
                                class="p-4 bg-white border-[1px] text-[14px] text-Mplanet flex items-center justify-between">
                                <div>
                                    <p>{!! $item->noidung !!}</p>
                                    <p>A. {{ $item->dapAns[0]->noidung }}</p>
                                    <p>B. {{ $item->dapAns[1]->noidung }}</p>
                                    <p>C. {{ $item->dapAns[2]->noidung }}</p>
                                    <p>D. {{ $item->dapAns[3]->noidung }}</p>
                                </div>
                                <form action="{{ route('ChiTietDeThi.destroy', $deThi->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id_cauhoi" value="{{ $item->id }}" id="">
                                    <button class="btn-danger"><i class="fa-solid fa-xmark"></i></button>
                                </form>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('doKho').addEventListener('change', function() {
            const value = this.value;
            if (value) {
                window.location.href = `?dokho=${value}`;
            }
        });
    </script>
@endsection
