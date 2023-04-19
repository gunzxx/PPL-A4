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
                    <p align="center">Tidak ada penawaran yang dibuat.</p>
                    <p align="center">Silahkan cari kerja sama terlebih dahulu.</p>
                </div>
                <a class="btn create-btn" href="/petani/home">Cari</a>
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
                    <div class="card-information">
                        <div class="card-price">
                            <p>{{ $detail->offer->stok }}kg/bulan</p>
                            <p>Rp {{ number_format($detail->offer->price,2,',','.') }}/kg</p>
                            <p>{{ $detail->offer->inventory->bean_type }}</p>
                        </div>
                        <div class="keterangan-partner">
                            <div class="keterangan-list">
                                <p>Nama kerja sama : </p>
                                <p>&nbsp;{{ " {$detail->partner->name}" }}</p>
                            </div>
                            <div class="keterangan-list">
                                <p>Nama pengelola : </p>
                                <p>&nbsp;{{ $detail->pengelola->fullname }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->petani->address }}</h3>
                    </div>
                    <div class="card-action">
                        @if ($detail->is_approved == 0 && $detail->is_rejected == 0)
                            <a class="btn" href="/petani/partners/offers/edit/{{ $detail->id }}">Update<i class="bi bi-pencil-square"></i></a>
                            <button class="btn delete batal-tawar" data-offer-id="{{ $detail->offer->id }}" data-detail-id="{{ $detail->id }}" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                        @elseif($detail->is_approved == 1)
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle-fill"></i></span>
                            <button class="btn delete batal-tawar" data-offer-id="{{ $detail->offer->id }}" data-detail-id="{{ $detail->id }}" type="button">Batalkan<i class="bi bi-x-lg"></i></button>
                        @elseif($detail->is_rejected == 1)
                            <span class="status is_reject">Ditolak</span>
                            <button class="btn delete batal-tawar" data-offer-id="{{ $detail->offer->id }}" data-detail-id="{{ $detail->id }}" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                <a class="btn fixed create-btn" href="/petani/home">Tambah</a>
            @endif
        </div>
    </main>

    @error('message')
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror
@endsection

@section('script')
    <script src="/js/partner/petani/offers.js"></script>
@endsection