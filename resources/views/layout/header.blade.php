<div class="flex justify-between items-center h-[60px] border-b-[1px] border-solid px-6 py-3">
    <a href="">Logo</a>
    <div class="flex items-center">
        <p>Xin chào {{ Auth::user()->name }}</p>
        <img class="ml-4 w-[45px] h-[45px] border-2  object-fill rounded-full"
        src="{{ Auth::user()->avatar != null ? asset('storage/images/'.Auth::user()->avatar) : asset('storage/images/default_avatar.png')  }}" alt="Lỗi">

    </div>
</div>
