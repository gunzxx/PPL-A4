@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menu-partners></x-menu-partners>

        <div class="search-partner">
            <input type="text" placeholder="Cari kerja sama">
            <span><i class="bi bi-search pointer"></i></span>
        </div>

        @if (count($partners)<1)
        <div class="partner-container center">
            <p align="center">Tidak ada kerja sama yang dibuat.</p>
            <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
        </div>
        @endif
        
        <a href="/pengelola/partners/create" class="partner-add"><i class="bi bi-plus-lg"></i></a>
    </main>
@endsection