@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menu-inventory></x-menu-inventory>

        @if (count($inventories)>0)
        <div class="title-page">
            <h1>Pilih persediaan yang ingin anda perbarui</h1>
        </div>
        <div class="card-container">
            @foreach ($inventories as $inventory)
            <div class="card">
                <img src="/img/inventory/1.png" height="240px" class="card-img">
                <div class="card-body">
                    <p style="text-align: center;">Jenis kedelai : {{ $inventory->jenis_kedelai }}</p>
                    <p style="text-align: center;">Tersedia : {{ number_format($inventory->stok/1000,2,',','.') }} kg kedelai</p>
                    <div class="action-container">
                        <a href="/inventory/update/{{ $inventory->id }}" class="btn-danger edit-inv pointer"><i class="bi bi-pencil"></i></a>
                        <span data-inv-id="{{ $inventory->id }}" class="btn-danger delete-inv pointer"><i class="bi bi-trash"></i></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <h1 style="text-align: center;padding:50px 0;">Persediaan masih kosong. <a href="/inventory/create">Tambah sekarang!</a></h1>
        @endif
    </main>
@endsection