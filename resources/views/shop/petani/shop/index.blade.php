@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>
        <x-createButton :url="'/petani/shop/create'"></x-createButton>

        <div class="box-container">
            <div class="">
                <p align="center">Tidak ada penjualan.</p>
                <p align="center">Silahkan jual kedelai terlebih dahulu.</p>
            </div>
        </div>
    </main>
@endsection