@extends('layout.app')


@section('content')
    <div class="p-4">
        <h4 class="my-4 text-xl text-Mgray font-normal">Môn học</h4>
        <a href="{{ route('monhoc.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus mr-1"></i>THÊM MÔN HỌC
        </a>
        <div class="relative overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            STT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tên Môn học
                           {!!sortable('tenmon',$sort)!!}

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ngày tạo
                             {!!sortable('created_at',$sort) !!}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ngày cập nhật
                            {!!sortable('updated_at',$sort) !!}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hành Động
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dsMonHoc as $monHoc)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }} 
                            </th>
                            <td class="px-6 py-4">
                                {{ $monHoc->tenmon }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $monHoc->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $monHoc->updated_at ?? "Chưa cập nhật"}}
                            </td>
                            <td class="px-6 py-4">
                                <form class="inline" method="POST" action="{{ route('monhoc.destroy', ['monhoc' => $monHoc->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn-danger" href=""><i
                                            class="fa-solid fa-trash-can"></i></button>
                                </form>
                                <a class="btn-warning" href="{{ route('monhoc.edit',['monhoc'=>$monHoc->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
