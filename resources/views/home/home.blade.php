@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div style="text-align: center;">
            <h1>Beranda</h1>
            <div class="card-container">
                @foreach ($partners as $partner)
                    <div class="card">
                        <img src="/img/inventory/1.png" height="240px" class="card-img">
                        <div class="card-body">
                            <div class="jenis-kedelai">
                                <p style="text-align: center;">Jenis kedelai : {{ $partner->jenis_kedelai }}</p>
                            </div>
                            <div class="Stok-kedelai">
                                <p style="text-align: center;">Tersedia : {{ $partner->stok }} kg</p>
                            </div>
                            <div class="action-container">
                                <a class="tawar" href="/petani/partners/offers/create/{{ $partner->id }}">Tawar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection