@extends('layout.app')

@section('content')
    <div class="p-4 h-full overflow-scroll">
        <div class="bg-white p-8 m-auto rounded-lg shadow-md w-[550px]">
            <h4 class="text-center text-[17px] font-medium mb-8">{{ $deThi->tende }}</h4>
            <div class="mb-1 flex justify-between text-Mplanet">
                <p><i class="text-Minfo mr-2 fa-regular fa-clock"></i>Thời gian làm bài</p>
                <p>{{ $deThi->tgthi }} phút</p>
            </div>
            <div class="mb-1 flex justify-between text-Mplanet">
                <p><i class="text-Minfo mr-2 fa-solid fa-calendar-days"></i>Thời gian mở đề</p>
                <p>{{ $deThi->tgmode }}</p>
            </div>
            <div class="mb-1 flex justify-between text-Mplanet">
                <p><i class="text-Minfo mr-2 fa-regular fa-calendar-xmark"></i>Thời gian kết thúc</p>
                <p>{{ $deThi->tgketthuc }}</p>
            </div>
            <div class="mb-1 flex justify-between text-Mplanet">
                <p><i class="text-Minfo mr-2 fa-regular fa-circle-question"></i>Tổng số câu hỏi
                </p>
                <p>{{ $deThi->socaude + $deThi->socautrungbinh + $deThi->socaukho }}</p>
            </div>
            <div class="mb-4 flex justify-between text-Mplanet">
                <p><i class="text-Minfo mr-2 fa-solid fa-book"></i>Môn học</p>
                <p>{{ $deThi->monHoc->tenmon }}</p>
            </div>
            @if ($kq != null)
                <span
                    class="px-3 py-2 bg-green-600 text-white block text-center w-full rounded-[6px] text-[12px] font-medium">Bạn
                    đã hoàn thành bài thi</span>
            @else
                @if (date('Y-m-d H:i:s') > $deThi->tgmode && date('Y-m-d H:i:s') < $deThi->tgketthuc)
                    <a href="{{ route('user.dekiemtra.lamkiemtra', ['id' => $deThi->id]) }}"
                        class="block text-center btn-primary w-full">Vào làm bài thi</a>
                @elseif(date('Y-m-d H:i:s') > $deThi->tgketthuc)
                    <span class="px-3 py-2 bg-red-400 block text-center w-full rounded-[6px] text-[12px] font-medium">Đã kết
                        thúc thời gian làm bài</span>
                @else
                    <span class="px-3 py-2 bg-gray-300 block w-full text-center rounded-[6px] text-[12px] font-medium">Chưa
                        tới thời gian mở đề</span>
                @endif
            @endif


        </div>
        @if ($kq != null)
            <div class="p-8 mx-auto mt-4 w-[550px] rounded-lg shadow-md bg-white">
                <h4 class="text-center text-[20px] font-medium mb-8">Điểm của bạn: <span class="text-red-400">{{ $kq->diem }}</span> </h4>
                <div>
                    <div class="mb-1 flex justify-between text-Mplanet">
                        <p><i class="text-Minfo mr-2 fa-regular fa-clock"></i>Thời gian vào thi</p>
                        <p>{{ $kq->tgvaothi }}</p>
                    </div>
                    <div class="mb-1 flex justify-between text-Mplanet">
                        <p><i class="text-Minfo mr-2 fa-regular fa-clock"></i>Số câu đúng</p>
                        <p>{{ $kq->socaudung }}</p>
                    </div>
                    <div class="mb-1 flex justify-between text-Mplanet">
                        <p><i class="text-Minfo mr-2 fa-regular fa-clock"></i>Tổng số câu</p>
                        <p>{{ $deThi->socaude + $deThi->socautrungbinh + $deThi->socaukho }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
