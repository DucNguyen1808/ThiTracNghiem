@extends('layout.app')


@section('content')
    <div class="p-4">
        <h4 class="my-4 text-xl text-Mgray font-normal">Môn học</h4>
        <div class="flex justify-between items-center">
            <a href="{{ route('monhoc.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus mr-1"></i>THÊM MÔN HỌC
            </a>
            <div class="w-1/2 flex justify-end items-center">
                <a href="{{ route('monhoc.index') }}"><i class="mr-4 btn-primary fa-solid fa-rotate-right"></i></a>
                    <form class="w-1/2 px-2 py-1 bg-Mcontrol flex rounded-lg" action="" method="GET">
                        <input name="searchKey" class="bg-Mcontrol flex-auto outline-none caret-Mplanet text-[12px]"
                        type="text" placeholder="Tìm kiếm môn học">
                        <button type="submit" class="mr-2 text-Mgray cursor-pointer hover:text-Mplanet"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
            </div>
        </div>
        <div class="relative overflow-x-auto mt-4">
            @if (count($dsMonHoc) == 0)
                <p class="text-[16px] mt-4 text-Minfo text-center">{{ $message ?? 'Danh sách trống' }}</p>
            @else
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                STT
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tên Môn học
                                {!! sortable('tenmon', $sort) !!}

                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày tạo
                                {!! sortable('created_at', $sort) !!}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ngày cập nhật
                                {!! sortable('updated_at', $sort) !!}
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
                                    {{ $monHoc->updated_at ?? 'Chưa cập nhật' }}
                                </td>
                                <td class="px-6 py-4">
                                    <button data-id="{{ $monHoc->id }}" type="submit" class="btn-danger btn_delete"
                                        href=""><i class="fa-solid fa-trash-can"></i></button>
                                    <a class="btn-warning" href="{{ route('monhoc.edit', ['monhoc' => $monHoc->id]) }}"><i
                                            class="fa-regular fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="delete_modal">
        <!--
                                                  Background backdrop, show/hide based on modal state.

                                                  Entering: "ease-out duration-300"
                                                    From: "opacity-0"
                                                    To: "opacity-100"
                                                  Leaving: "ease-in duration-200"
                                                    From: "opacity-100"
                                                    To: "opacity-0"
                                                -->
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!--
                                                      Modal panel, show/hide based on modal state.

                                                      Entering: "ease-out duration-300"
                                                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                        To: "opacity-100 translate-y-0 sm:scale-100"
                                                      Leaving: "ease-in duration-200"
                                                        From: "opacity-100 translate-y-0 sm:scale-100"
                                                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    -->
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Thông báo</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Bạn muốn xóa môn học</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" id="btn_delete_monhoc"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Ok</button>
                        <button type="button" id='btn_cancel'
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form name="delete_monhoc_form" class="inline" method="POST">
        @csrf
        @method('delete')
    </form>
    <script>
        var monHocId
        var deleteModal = document.getElementById('delete_modal')
        var btnCancel = document.getElementById('btn_cancel')
        var deleteBtns = document.querySelectorAll('.btn_delete')
        var btnDeleteCourse = document.getElementById('btn_delete_monhoc')
        var deleteForm = document.forms['delete_monhoc_form']
        btnCancel.onclick = (e) => {
            deleteModal.classList.add('hidden')
        }
        deleteBtns.forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault()
                deleteModal.classList.remove('hidden')
                monHocId = btn.dataset.id
            }
        })
        btnDeleteCourse.onclick = function() {
            deleteForm.action = `/admin/monhoc/${monHocId}`
            deleteForm.submit();
        }
    </script>
@endsection
