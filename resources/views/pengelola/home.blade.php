@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div class="menu">
            <div class="menu-item active">
                <a href="{{ Request::url() }}/partners">Kerja Sama</a>
            </div>
            <div class="menu-item">
                <a href="{{ Request::url() }}/offers">Penawaran</a>
            </div>
            <div class="menu-item">
                <a href="{{ Request::url() }}/agreements">Persetujuan</a>
            </div>
            <div class="menu-item">
                <a href="{{ Request::url() }}/history">Riwayat</a>
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