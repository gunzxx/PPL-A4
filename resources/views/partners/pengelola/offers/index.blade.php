@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <x-searchPartner :value="(isset($search)?$search:'')"></x-searchPartner>

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
                            <div class="card-header-img-container bg-transparent-img">
                                <img src="{{ $detail->petani->getFirstMediaUrl("profile") != "" ? $detail->offer->petani->getFirstMediaUrl("profile") : "/img/profile/default.png" }}">
                            </div>
                            <div class="card-header-identity">
                                <h1>{{ ucfirst($detail->offer->petani->fullname) }}</h1>
                                <p>No Telp. {{ ucfirst($detail->offer->petani->number_phone) }}</p>
                            </div>
                        </div>
                        <div class="card-header-col end">
                            <p class="tanggal">{{ date("d F Y",strtotime($detail->offer->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p title="klik untuk menampilkan lebih lengkap" class="card-description">{{ strip_tags($detail->offer->description) }}</p>
                    </div>
                    <div class="card-information">
                        <div class="card-price">
                            <p>{{ $detail->offer->stok }}kg/bulan</p>
                            <p>Rp {{ number_format($detail->offer->price,0,',','.') }}/kg</p>
                            <p>{{ $detail->offer->inventory->bean_type }}</p>
                        </div>
                        <div class="card-body-partner">
                            <p>Untuk kerja sama : {{ $detail->partner->name }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->offer->petani->address }}</h3>
                    </div>
                    <div class="card-action">
                        @if ($detail->status == "waiting")
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" data-partner-id="{{ $detail->partner->id }}" class="btn confirm" type="button">Accept<i class="bi bi-check-lg"></i></button>
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn reject" type="button">Reject<i class="bi bi-x-lg"></i></button>
                        @elseif($detail->status == "accept")
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle-fill"></i></span>
                            {{-- <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn cancel" type="button">Hapus<i class="bi bi-x-lg"></i></button> --}}
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $details->links() }}
            @endif
        </div>
    </main>


@endsection

@section('script')
    <script src="/js/partner/pengelola/offers.js"></script>
@endsection