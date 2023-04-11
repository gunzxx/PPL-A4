@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-inventory-menu></x-inventory-menu>

        <div class="card-container">
            @foreach ($inventories as $inventory)
            <a href="/pengelola/inventory/update/{{ $inventory->id }}" class="card">
                <img src="/img/inventory/1.png" height="240px" class="card-img">
                <div class="card-body">
                    <div class="jenis-kedelai">
                        <p>Jenis kedelai : {{ $inventory->jenis_kedelai }}</p>
                    </div>
                    <div class="Stok-kedelai">
                        <p>Tersedia : {{ $inventory->stok }}kg</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>
@endsection