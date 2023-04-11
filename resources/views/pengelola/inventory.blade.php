@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        {{-- {{ dd(array_reverse(explode('/',Request::url()))[1]) }} --}}
        <div class="menu">
            <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" ? "active" : '' }}">
                <a href="/pengelola/inventory/">Persediaan</a>
            </div>
            <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "create" ? "active" : '' }}">
                <a href="/pengelola/inventory/create">Tambah Persediaan</a>
            </div>
            <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "update" ? "active" : '' }}">
                <a href="/pengelola/inventory/update">Perbarui Persediaan</a>
            </div>
        </div>

        <div class="search-partner">
            <input type="text" placeholder="Cari kerja sama">
            <span><i class="bi bi-search pointer"></i></span>
        </div>

        {{-- @if (count($partner))
            
        @endif --}}
        <div class="partner-container center">
            <p align="center">Kerja sama belum ada yang dibuat.</p>
            <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
            <div class="action-button">Tambah</div>
        </div>
    </main>
@endsection
@section('script')
    <script src="/js/pengelola.js"></script>
@endsection