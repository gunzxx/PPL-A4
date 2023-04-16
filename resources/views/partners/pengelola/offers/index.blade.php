@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="search-partner">
            <input type="text" placeholder="Cari kerja sama">
            <span><i class="bi bi-search pointer"></i></span>
        </div>

        <div class="partner-container">
            @if (count($details)<1)
                <div>
                    <p align="center">Tidak ada penawaran.</p>
                    <p align="center">Silahkan lihat kerja sama anda.</p>
                </div>
            @else
                @foreach ($details as $detail)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col img">
                            <img src="/img/profile/2.png">
                        </div>
                        <div class="card-header-col">
                            <h1>{{ ucfirst($detail->offer->petani->fullname) }}</h1>
                            <p>No Telp. {{ ucfirst($detail->offer->petani->number_phone) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <p class="tanggal">{{ date("d F Y",strtotime($detail->offer->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ Str::limit(strip_tags($detail->offer->description),500) }}</p>
                    </div>
                    <div class="card-price">
                        <p>{{ $detail->offer->stok }}kg/bulan</p>
                        <p>{{ $detail->offer->price }}</p>
                        <p>{{ $detail->offer->inventory->bean_type }}</p>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->offer->petani->address }}</h3>
                    </div>
                    <div class="card-action">
                        <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}"  class="btn confirm" type="button">Terima</button>
                        <button class="btn cancel" type="button">Tolak</button>
                    </div>
                </div>
                @endforeach
                <a class="btn create-btn" href="/petani/home">Tambah</a>
                <a href="/petani/offers/create" class="create-button"></a>
            @endif
        </div>
    </main>
@endsection

@section('script')
    <script src="/js/partner/petani/offers.js"></script>
    <script src="/js/partner/petani/offers/index.js"></script>
@endsection