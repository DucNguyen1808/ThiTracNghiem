@extends('layout.app')


@section('content')
    <div class="p-4 h-full overflow-scroll">
        <h4 class="my-4 text-xl text-Mgray font-normal">{{ $deThi->tende }}</h4>
        <div class="flex justify-between items-center">
            <h4 class="font-medium text-Minfo">Quản lý nhóm làm đề thi</h4>
            <div>
                <a href="{{ route('dethi.addcauhoi', ['id' => $deThi->id]) }}" class="btn-primary mr-2">
                    <i class="fa-solid fa-gear"></i> Câu hỏi
                </a>
            </div>
        </div>
        <div class="grid grid-cols-12">
            <div class="col-span-4 mt-4 mr-2">
                <ul>
                    @foreach ($dsNhomNotInDeThi as $nhom)
                        <form method="POST" action="{{ route('giaodethi.store') }} ">
                            @csrf
                            <li class="p-4 bg-white border-[1px] text-[14px] text-Mplanet flex items-center">
                                <span> {{ $nhom->tennhom }} </span>
                                <input type="hidden" name="id_nhom" value="{{ $nhom->id }}">
                                <input type="hidden" name="id_dethi" value="{{ $deThi->id }}">
                                <button class="ml-auto btn-primary" type="submit"><i class="fa-solid fa-plus"></i></button>
                            </li>
                        </form>
                    @endforeach
                </ul>
            </div>
            <div class="col-span-8 relative overflow-x-auto mt-4">
                @if (count($dsNhom) == 0)
                    <p class="text-[16px] mt-4 text-Minfo text-center">{{ $message ?? 'Danh sách trống' }}</p>
                @else
                    <ul>
                        @foreach ($dsNhom as $nhom)
                        <form method="POST" action="{{ route('giaodethi.destroy',['id'=>$deThi->id]) }} ">
                            @method('DELETE')
                            @csrf
                            <li class="p-4 bg-white border-[1px] text-[14px] text-Mplanet flex items-center">
                                <span> {{ $nhom->tennhom }} </span>
                                <input type="hidden" name="id_nhom" value="{{ $nhom->id }}">
                                <button class="ml-auto btn-danger" type="submit"><i class="fa-solid fa-xmark"></i></button>
                            </li>
                        </form>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
