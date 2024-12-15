@extends('layout.app')
@section('content')
    <div class="p-4">
        <h4 class="my-4 text-xl text-Mgray font-normal">Sửa câu hỏi</h4>
        <form action="{{ route('cauhoi.update',['cauhoi'=>$cauHoi->id]) }}" method="POST" id="addForm">
            @csrf
            @method('put')
            <div class="flex">
                <div class="mr-4">
                    <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Môn
                        học</label>
                    <select id="countries" name="idMonHoc"
                        class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Chọn môn học</option>
                        @foreach ($dsMonHoc as $monhoc)
                            <option {{ $cauHoi->id_monhoc == $monhoc->id ? 'selected' : '' }} value="{{ $monhoc->id }}">
                                {{ $monhoc->tenmon }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-4">
                    <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Độ
                        khó</label>
                    <select id="countries" name="doKho"
                        class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Chọn độ khó</option>
                        <option {{ $cauHoi->dokho == 1 ? 'selected' : '' }} value="1">Dễ</option>
                        <option {{ $cauHoi->dokho == 2 ? 'selected' : '' }} value="2">Trung bình</option>
                        <option {{ $cauHoi->dokho == 3 ? 'selected' : '' }} value="3">Khó</option>
                    </select>
                </div>
                <div>
                    <label for="countries" class="block mb-2 text-sm font-medium text-Mplanet dark:text-white">Đáp án
                        đúng</label>
                    <select id="dapAnDung" name="dapAnDung"
                        class="bg-gray-50 border border-gray-300 text-Mplanet text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Chọn đáp án </option>
                        <option {{ $cauHoi->dapAns[0]->is_dapan ? 'selected' : '' }} value="0">1</option>
                        <option {{ $cauHoi->dapAns[1]->is_dapan ? 'selected' : '' }} value="1">2</option>
                        <option {{ $cauHoi->dapAns[2]->is_dapan ? 'selected' : '' }} value="2">3</option>
                        <option {{ $cauHoi->dapAns[3]->is_dapan ? 'selected' : '' }} value="3">4</option>
                    </select>
                </div>
            </div>
            <div class="mt-2">
                @error('idMonHoc')
                    <p class="text-Merrors font-semibold">Chưa chọn môn học</p>
                @enderror
                @error('doKho')
                    <p class="text-Merrors font-semibold">Chưa chọn độ khó</p>
                @enderror
                @error('dapAnDung')
                    <p class="text-Merrors font-semibold">Chưa chọn đáp án đúng</p>
                @enderror
            </div>
            <div class="mt-4">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Câu hỏi</label>
                <div id="ndeditor">
                    {!! $cauHoi->noidung !!}
                </div>
                <input type="hidden" id="ndCauHoi" name="ndCauHoi">
                @error('ndCauHoi')
                    <p class="text-Merrors font-semibold">Nội dung câu hỏi không được để trống</p>
                @enderror
            </div>
            <div class="grid grid-cols-12">
                <div class="mt-4 col-span-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Đáp án 1</label>
                    <textarea id="message" rows="4" name="ndDapAns[]"
                        class="ndDapAns {{ $cauHoi->dapAns[0]->is_dapan ? 'bg-green-100' : 'bg-red-100' }} block p-2.5 text-sm w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nhập nội dung đáp án">{{ $cauHoi->dapAns[0]->noidung }}</textarea>
                    <input type="hidden" name="idCauHois[]" value="{{ $cauHoi->dapAns[0]->is_dapan }}">
                </div>
                <div class="mt-4 ml-2 col-span-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Đáp án 2</label>
                    <textarea id="message" rows="4" name="ndDapAns[]"
                        class="ndDapAns {{ $cauHoi->dapAns[1]->is_dapan ? 'bg-green-100' : 'bg-red-100' }} block p-2.5 text-sm w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nhập nội dung đáp án">{{ $cauHoi->dapAns[1]->noidung }}</textarea>
                </div>
            </div>
            <div class="grid grid-cols-12">
                <div class="mt-4 col-span-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Đáp án 3</label>
                    <textarea id="message" rows="4" name="ndDapAns[]"
                        class="ndDapAns {{ $cauHoi->dapAns[2]->is_dapan ? 'bg-green-100' : 'bg-red-100' }} block p-2.5 text-sm w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nhập nội dung đáp án">{{ $cauHoi->dapAns[2]->noidung }}</textarea>
                </div>
                <div class="mt-4 ml-2 col-span-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Đáp án 4</label>
                    <textarea id="message" rows="4" name="ndDapAns[]"
                        class="ndDapAns {{ $cauHoi->dapAns[3]->is_dapan ? 'bg-green-100' : 'bg-red-100' }} block p-2.5 text-sm w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nhập nội dung đáp án">{{ $cauHoi->dapAns[3]->noidung }}</textarea>
                </div>
            </div>
            @error('ndDapAns.*')
                <p class="text-Merrors font-semibold">Nội dung đáp án không được để trống</p>
            @enderror
            <div class="mt-4">
                <button type="submit" id="btn_luu" class="btn-success">Lưu</button>
                <button type="reset" class="btn-warning">Hủy</button>
            </div>

        </form>
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor -->

        <script>
            var btnLuu = document.getElementById('btn_luu')
            var addForm = document.getElementById('addForm')
            var ndCauHoi = document.getElementById('ndCauHoi')
            var selectDapAnDung = document.getElementById('dapAnDung')
            var ndDapAns = document.querySelectorAll('.ndDapAns')
            console.log(selectDapAnDung);
            const quill = new Quill('#ndeditor', {
                theme: 'snow'
            });

            btnLuu.onclick = function() {
                ndCauHoi.value = quill.root.innerHTML === '<p><br></p>' ? '' : quill.root.innerHTML;
                addForm.action = `/admin/cauhoi/${cauhoiId}`
                addForm.submit();
            }
            selectDapAnDung.onchange = function() {
                ndDapAns.forEach((ndDapAn, index) => {

                    if (selectDapAnDung.value == index) {
                        ndDapAn.classList.remove('bg-red-100');
                        ndDapAn.classList.add('bg-green-100');
                        console.log('dung')
                    } else {
                        ndDapAn.classList.remove('bg-green-100');
                        ndDapAn.classList.add('bg-red-100');
                        console.log('sai')
                    }

                })
            }
        </script>
    </div>
@endsection
