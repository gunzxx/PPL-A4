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
                    <div class="card-information">
                        <div class="card-price">
                            <p>{{ $detail->offer->stok }}kg/bulan</p>
                            <p>Rp {{ number_format($detail->offer->price,0,',','.') }}/kg</p>
                            <p>{{ $detail->offer->inventory->bean_type }}</p>
                        </div>
                        <div class="keterangan-partner">
                            <div class="keterangan-list">
                                <p>Nama penawaran : </p>
                                <p>&nbsp;{{ " {$detail->offer->name}" }}</p>
                            </div>
                            <div class="keterangan-list">
                                <p>Untuk kerja sama :</p>
                                <p>&nbsp;{{ " {$detail->partner->name}" }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->offer->petani->address }}</h3>
                    </div>
                    <div class="card-action">
                        @if ($detail->is_approved == 0 && $detail->is_rejected == 0)
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn confirm" type="button">Accept<i class="bi bi-check-lg"></i></button>
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn reject" type="button">Reject<i class="bi bi-x-lg"></i></button>
                        @elseif($detail->is_approved == 1)
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle-fill"></i></span>
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn cancel" type="button">Batalkan<i class="bi bi-x-lg"></i></button>
                        @elseif($detail->is_rejected == 1)
                            <span class="status is_reject">Ditolak </span>
                            <button data-detail-id="{{ $detail->id }}" data-offer-id="{{ $detail->offer->id }}" class="btn cancel" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $details->links() }}
            @endif
        </div>
    </main>

    <div class="popup-backdrop cancel-offer">
        <div class="popup-container">
            <div class="popup-text">Batalkan penawaran dengan petani?</div>
            <div class="popup-alert">
                <button onclick="cancelOffer()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button onclick="this.parentNode.parentNode.parentNode.style.display = 'none'" value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    <div class="popup-backdrop reject-offer">
        <div class="popup-container">
            <div class="popup-text">Tolak penawaran dengan petani?</div>
            <div class="popup-alert">
                <button onclick="rejectOffer()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button onclick="this.parentNode.parentNode.parentNode.style.display = 'none'" value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    <div class="popup-backdrop confirm-offer">
        <div class="popup-container">
            <div class="popup-text">Terima penawaran dengan petani?</div>
            <div class="popup-alert">
                <button onclick="confirmOffer()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button onclick="this.parentNode.parentNode.parentNode.style.display = 'none'" value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/partner/pengelola/offers.js"></script>
@endsection