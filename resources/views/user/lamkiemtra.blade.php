<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Thi trắc nghiệm</title>
</head>

<body class="bg-MgrayLighter overflow-hidden">

    <form method="POST" id="exam-form" action="{{ route('user.dekiemtra.store') }}">
        <input type="hidden" name="id_dethi" value="{{ $deThi->id }}">
        @csrf
        <div class="flex justify-end p-4 items-center bg-white shadow-sm fixed top-0 left-0 right-0">
            <p class="mr-4 text-[17px] font-medium">Thí sinh: {{ Auth::user()->name }}</p>
            <div class="flex items-center">
                <p class="text-[17px]"><i class="fa-regular fa-clock"></i><span id="timer"
                        class="ml-2">00:00:00</span> </p>
                <button id="btn_nopbai" type="submit" class="ml-4 btn-primary"><i class="fa-solid fa-file"></i> Nộp
                    bài</button>

            </div>
        </div>
        <div class="grid grid-cols-12 w-[1440px] mx-auto">
            <div class="col-span-8 w-full sticky top-20 h-4/5 overflow-y-scroll">
                @foreach ($cauHois as $cauHoi)
                    <div id='{{ $cauHoi->id }}' class="mb-4">
                        <div class="p-6 bg-white">
                            <div class="mb-3 font-semibold flex">
                                <span>{{ $loop->iteration }}.</span>{!! $cauHoi->noidung !!}
                            </div>
                            <p class="mb-1">A. {{ $cauHoi->dapAns[0]->noidung }} </p>
                            <p class="mb-1">B. {{ $cauHoi->dapAns[1]->noidung }}</p>
                            <p class="mb-1">C. {{ $cauHoi->dapAns[2]->noidung }}</p>
                            <p class="mb-1">D. {{ $cauHoi->dapAns[3]->noidung }}</p>
                        </div>
                        <div class="bg-blue-800 px-6 py-2 text-white flex">
                            <span class="text-white mr-4">Đáp án của bạn:</span>
                            <div class="flex items-center mr-4">
                                <span class="mr-2">A</span>
                                <input data-id='{{ $cauHoi->id }}' class="cb w-3 h-3 scale-150 text-blue-500"
                                    value="{{ $cauHoi->dapAns[0]->id }}" name="cbDapAns[{{ $loop->iteration }}]"
                                    type="radio">
                            </div>
                            <div class="flex items-center mr-4">
                                <span class="mr-2">B</span>
                                <input data-id='{{ $cauHoi->id }}' class="cb w-3 h-3 scale-150 text-blue-500"
                                    value="{{ $cauHoi->dapAns[1]->id }}" name="cbDapAns[{{ $loop->iteration }}]"
                                    type="radio">
                            </div>
                            <div class="flex items-center mr-4">
                                <span class="mr-2">C</span>
                                <input data-id='{{ $cauHoi->id }}' class="cb w-3 h-3 scale-150 text-blue-500"
                                    value="{{ $cauHoi->dapAns[2]->id }}" name="cbDapAns[{{ $loop->iteration }}]"
                                    type="radio">
                            </div>
                            <div class="flex items-center mr-4">
                                <span class="mr-2">D</span>
                                <input data-id='{{ $cauHoi->id }}' class="cb w-3 h-3 scale-150 text-blue-500"
                                    value="{{ $cauHoi->dapAns[3]->id }}" name="cbDapAns[{{ $loop->iteration }}]"
                                    type="radio">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="flex h-[600px] items-start overflow-y-scroll flex-wrap col-span-4 bg-white mt-20 ml-4 text-center p-4 self-start sticky top-20">
                @foreach ($cauHois as $cauHoi)
                    <div onclick="scrollToQuestion('{{ $cauHoi->id }}')" id='{{ $cauHoi->id }}'
                        class="btncauhoi btn-primary w-[40px] ml-1   bg-white text-Mplanet border-[1px] mb-2">
                        {{ $loop->iteration }}</div>
                @endforeach
                {{-- @for ($i = 0; $i < 100; $i++)
                        <div onclick="scrollToQuestion('{{ $i }}')"
                            class="btn-primary w-[50px] ml-1 bg-white text-Mplanet border-[1px] mb-2">{{ $i }}</div>
                    @endfor --}}

            </div>
        </div>
    </form>
    <script>
        let timeLeft = {{ $thoiGianConLai }} * 60;
        const timerElement = document.getElementById('timer');
        const examForm = document.getElementById('exam-form');
        const btn = document.getElementById('btn');
        const cb = document.querySelectorAll('.cb');
        const btncauhoi = document.querySelectorAll('.btncauhoi');
        const btnNopBai = document.getElementById('btn_nopbai');
        var timerInterval = setInterval(updateTimer, 1000);

        function xulytruockhichuyentrang(event) {
            event.preventDefault();
            saveAnswers();
            event.returnValue = '';
        }

        function updateTimer() {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor((timeLeft % 3600) / 60);
            const seconds = Math.floor(timeLeft % 60);
            timerElement.textContent =
                `${hours > 0 ? hours + ' giờ ' : ''}${minutes} phút ${seconds < 10 ? '0' : ''}${seconds} giây`;
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                window.removeEventListener('beforeunload', xulytruockhichuyentrang);
                localStorage.clear();
                examForm.submit();
            }
            timeLeft--;
        }

        function saveAnswers() {
            const form = document.getElementById('exam-form');
            const formData = new FormData(form);
            formData.forEach((value, key) => {
                localStorage.setItem(key + {{ $deThi->id }}, value);
            });
        }

        function loadAnswers() {
            const form = document.getElementById('exam-form');
            const elements = form.elements;
            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                if (element.type === 'radio') {
                    const savedValue = localStorage.getItem(element.name + {{ $deThi->id }});
                    if (savedValue === element.value) {
                        element.checked = true;
                        btncauhoi.forEach(btn => {
                            if (element.getAttribute('data-id') == btn.id) {
                                btn.classList.remove('bg-white');
                                btn.classList.add('bg-green-600');
                                console.log(btn)
                            }

                        })
                    }
                }
            }
        }
        btnNopBai.onclick = (e) => {
            e.preventDefault();
            window.removeEventListener('beforeunload', xulytruockhichuyentrang);
            localStorage.clear();
            examForm.submit();
        }
        window.addEventListener('beforeunload', xulytruockhichuyentrang);
        document.addEventListener('DOMContentLoaded', loadAnswers);

        function scrollToQuestion(questionId) {
            const element = document.getElementById(questionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
        cb.forEach(c => {
            c.onchange = (element) => {
                //  console.log(element.target.getAttribute('data-id'));
                btncauhoi.forEach(btn => {
                    if (element.target.getAttribute('data-id') == btn.id) {
                        btn.classList.remove('bg-white');
                        btn.classList.add('bg-green-600');
                        console.log(btn)
                    }

                })
            }
        })
    </script>
</body>

</html>
