@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menu-partners></x-menu-partners>

        <div class="search-partner">
            <input type="text" placeholder="Masukkan judul kerja sama">
            <span><i class="bi bi-search pointer"></i></span>
        </div>

    </main>
@endsection
@section('script')
    <script src="/js/pengelola.js"></script>
@endsection