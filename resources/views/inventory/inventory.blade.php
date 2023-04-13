@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menu-inventory></x-menu-inventory>

        @if (count($inventories)>0)
        <div class="card-container">
            @foreach ($inventories as $inventory)
            <a href="/inventory/update/{{ $inventory->id }}" class="card">
                <img src="/img/inventory/1.png" height="240px" class="card-img">
                <div class="card-body">
                    <div class="jenis-kedelai">
                        <p style="text-align: center;">Jenis kedelai : {{ $inventory->jenis_kedelai }}</p>
                    </div>
                    <div class="Stok-kedelai">
                        <p style="text-align: center;">Tersedia : {{ number_format($inventory->stok/1000,2,',','.') }} kg</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <h1 style="text-align: center;padding:50px 0;">Persediaan masih kosong. <a href="/inventory/create">Tambah sekarang!</a></h1>
        @endif
    </main>
@endsection