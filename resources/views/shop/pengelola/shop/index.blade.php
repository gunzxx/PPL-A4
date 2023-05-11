@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            <div class="">
                <p align="center">Tidak ada pembelian.</p>
                <p align="center">Silahkan buat persetujuan atau tunggu petani menjual kedelainya terlebih dahulu.</p>
            </div>
        </div>
    </main>
@endsection