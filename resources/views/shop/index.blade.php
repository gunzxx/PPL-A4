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

        <div style="text-align: center;">
            <h1>Jual beli</h1>
        </div>
    </main>
@endsection
@section('script')
    <script src="/js/pengelola.js"></script>
@endsection