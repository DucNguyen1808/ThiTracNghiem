@extends('layout.app')

@section('content')
    <div class="p-4 h-full overflow-scroll">
        <div class="mt-6">
            @foreach ($nhoms as $nhom)
                <ul>
                    @if ($nhom->deThis->count() > 0)
                        <div class="mb-4 block text-[18px] border-b-[1px] border-gray-300">{{ $nhom->tennhom }}</div>
                        @foreach ($nhom->deThis as $dethi)
                            @php
                                $openDate = new DateTime($dethi->tgmode);
                                $openDate = $openDate->format('d-m-Y h:i:s A');
                                $closeDate = new DateTime($dethi->tgketthuc);
                                $closeDate = $closeDate->format('d-m-Y h:i:s A');
                            @endphp
                            <li
                                class="flex items-center justify-between p-5 bg-white border-l-4 border-gray-400 rounded-md mb-4">
                                <div>
                                    <h2 class="text-[20px] font-medium text-Mplanet mb-2">{{ $dethi->tende }}</h2>
                                    <p class="mb-1"><i class="fa-solid fa-layer-group text-Minfo"></i> <span
                                            class="text-Mplanet font-normal">{{ $dethi->monhoc->tenmon }} -
                                            {{ $nhom->tennhom }}</span></p>
                                    <p><i class="fa-regular fa-clock text-Minfo"></i> <span
                                            class="text-Mplanet font-light">Bất
                                            đầu từ
                                            {{ $openDate }} đến
                                            {{ $closeDate }}</span></p>
                                </div>
                                <div>
                                    <div>
                                        @if (date('Y-m-d H:i:s') > $dethi->tgmode && date('Y-m-d H:i:s') < $dethi->tgketthuc)
                                            <span
                                                class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">ĐANG
                                                MỞ</span>
                                        @elseif(date('Y-m-d H:i:s') > $dethi->tgketthuc)
                                            <span
                                                class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">ĐÃ
                                                ĐÓNG</span>
                                        @else
                                            <span
                                                class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">CHƯA
                                                MỞ</span>
                                        @endif
                                        <a href="{{ route('user.dekiemtra.show', $dethi->id) }}"
                                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">XEM
                                            CHI TIẾT</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            @endforeach




        </div>
    </div>
@endsection
