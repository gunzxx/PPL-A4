@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <x-searchPartner :value="(isset($search)?$search:'')"></x-searchPartner>

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
                            <div class="card-header-img-container bg-transparent-img">
                                <img src="{{ $detail->petani->getFirstMediaUrl("profile") != "" ? $detail->petani->getFirstMediaUrl("profile") : "/img/profile/default.png" }}">
                            </div>
                            <div class="card-header-identity">
                                <h1>{{ ucfirst($detail->petani->fullname) }}</h1>
                                <p>No Telp. {{ ucfirst($detail->petani->number_phone) }}</p>
                            </div>
                        </div>
                        <div class="card-header-col end">
                            <p title="klik untuk menampilkan lebih lengkap" class="tanggal">{{ date("d F Y",strtotime($detail->offer->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-description">{{ strip_tags($detail->offer->description) }}</p>
                    </div>
                    <div class="card-information">
                        <div class="card-price">
                            <p>{{ $detail->offer->stok }}kg/bulan</p>
                            <p>Rp {{ number_format($detail->offer->price,2,',','.') }}/kg</p>
                            <p>{{ $detail->offer->inventory->bean_type }}</p>
                        </div>
                        <div class="card-body-partner">
                            <p>Untuk kerja sama : {{ $detail->partner->name }}</p>
                        </div>
                        <div class="card-body-partner">
                            <p>Pengelola susu kedelai : {{ $detail->pengelola->fullname }}</p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->petani->address }}</h3>
                    </div>
                    <div class="card-action">
                        @if ($detail->status == "waiting")
                            <a class="btn" href="/petani/partners/offers/edit/{{ $detail->id }}">Update<i class="bi bi-pencil-square"></i></a>
                        @elseif($detail->status == "accept")
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle-fill"></i></span>
                        @elseif($detail->status == "reject")
                            <span class="status is_reject">Ditolak <i class="bi bi-x-circle-fill"></i></span>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $details->links() }}
                <a class="btn fixed create-btn" href="/petani/home">Tambah</a>
            @endif
        </div>
    </main>

    <div class="popup-backdrop batal-tawar-popup">
        <div class="popup-container">
            <div class="popup-text">Batalkan penawaran?</div>
            <div class="popup-alert">
                <button onclick="cancelOffer()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    <div class="popup-backdrop hapus-tawar-popup">
        <div class="popup-container">
            <div class="popup-text">Hapus penawaran?</div>
            <div class="popup-alert">
                <button onclick="deleteOffer()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    @error('message')
        <x-alertError :message="$message"></x-alertError>
    @enderror

    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif
@endsection

@section('script')
    <script src="/js/partner/petani/offers.js"></script>
@endsection