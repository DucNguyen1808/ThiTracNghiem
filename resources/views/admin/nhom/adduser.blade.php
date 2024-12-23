@extends('layout.app')


@section('content')
    <div class="p-4 h-full overflow-scroll">
        <h4 class="my-4 text-xl text-Mgray font-normal">Người dùng</h4>
        <div class="flex justify-between items-center">
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-plus mr-1"></i>THÊM VÀO NHÓM
            </button>
            <div class="w-1/2 flex justify-end items-center">
                <a href="{{ route('user.index') }}"><i class="mr-4 btn-primary fa-solid fa-rotate-right"></i></a>
                <form class="w-1/2 px-2 py-1 bg-Mcontrol flex rounded-lg" action="" method="GET">
                    <input name="searchKey" class="bg-Mcontrol flex-auto outline-none caret-Mplanet text-[12px]"
                        type="text" placeholder="Tìm kiếm người dùng">
                    <button type="submit" class="mr-2 text-Mgray cursor-pointer hover:text-Mplanet"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <div class="relative overflow-x-auto mt-4">
            @if (count($dsUser) == 0)
                <p class="text-[16px] mt-4 text-Minfo text-center">{{ $message ?? 'Danh sách trống' }}</p>
            @else
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                <input id="selectedAll" type="checkbox">
                            </th>
                            <th scope="col" class="px-6 py-3">
                                STT
                            </th>
                            <th scope="col" class="px-6 py-3">
                                MSSV
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tên sinh viên
                                {!! sortable('name', $sort) !!}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Giới tính
                                {!! sortable('gioitinh', $sort) !!}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày sinh
                                {!! sortable('ngaysinh', $sort) !!}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày tạo
                                {!! sortable('created_at', $sort) !!}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hành Động
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsUser as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="col" class="px-6 py-3">
                                    <input class="selected_users" type="checkbox">
                                </td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span class="">{{ $loop->iteration }}</span>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex">
                                        <img class="w-[40px] rounded-full"
                                            src="{{ asset('storage/images/default_avatar.png') }}" alt="">
                                        <div class="ml-2">
                                            <p class="text-Minfo font-medium">{{ $user->name }}</p>
                                            <p class="text-Mplanet">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->gioitinh }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->ngaysinh }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    <form method="post" action="{{ route('chitietnhom.store') }}">
                                        @csrf
                                        <input type="hidden" name="id_user" value="{{ $user->id }}">
                                        <input type="hidden" name="id_nhom" value="{{ $idNhom }}">
                                        <button type="submit" class="btn-primary"><i class="fa-solid fa-square-plus"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <script>
        $('#selectedAll').change(function(e) {
            if ($(this).is(':checked')) {
                    $('.selected_users').each(function(index, checkbox) {
                    $(checkbox).prop('checked', true);
                    })
            } else {
                $('.selected_users').each(function(index, checkbox) {
                    $(checkbox).prop('checked', false);
                    })
            }
        })
    </script>

@endsection
