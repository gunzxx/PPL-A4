@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <x-searchPartner :value="(isset($search)?$search:'')"></x-searchPartner>

        <div class="partner-container">
            @if (count($agreement_details)>0)
                @foreach ($agreement_details as $agreement_detail)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col img">
                            <div class="card-header-img-container bg-transparent-img">
                                <img src="{{ $agreement_detail->petani->getFirstMediaUrl("profile") != "" ? $agreement_detail->petani->getFirstMediaUrl("profile") : "/img/profile/default.png" }}">
                            </div>
                            <div class="card-header-identity">
                                <h1>{{ ucfirst($agreement_detail->petani->fullname) }}</h1>
                                <p>No Telp.&nbsp;{{ ucfirst($agreement_detail->pengelola->number_phone) }}</p>
                            </div>
                        </div>
                        <div class="card-header-col end">
                            <p class="tanggal">{{ date("d F Y",strtotime($agreement_detail->agreement->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="detail-container">
                            <div class="detail-list">
                                <p>Jenis kedelai : </p>
                                <p class="green">{{ $agreement_detail->agreement->bean_type }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Stok : </p>
                                <p class="green">{{ $agreement_detail->agreement->stok }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Harga : </p>
                                <p class="green">Rp. {{ number_format($agreement_detail->agreement->price,2,',','.') }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Tanggal penawaran : </p>
                                <p class="green">{{ date("d F Y", strtotime($agreement_detail->offerDetail->offer->created_at)) }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Status : </p>
                                <p class="@if($agreement_detail->status == "accept") is_confirm @elseif($agreement_detail->status == "waiting") is_not_confirm @elseif($agreement_detail->status == "reject") is_reject @endif">
                                    @if($agreement_detail->status == "waiting")Belum disetujui
                                    @elseif($agreement_detail->status == "accept")Disetujui <i class='bi bi-check-circle'></i>
                                    @elseif($agreement_detail->status == "reject")Ditolak <i class='bi bi-x-octagon-fill'></i>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        @if ($agreement_detail->status == "waiting")
                            <a class="btn" href="/pengelola/partners/agreements/edit/{{ $agreement_detail->id }}">Update <i class="bi bi-pencil-square"></i></a>
                            <button class="btn delete delete-agreement" data-agreement-id="{{ $agreement_detail->agreement->id }}" data-agrement-detail-id="{{ $agreement_detail->id }}" type="button">Hapus <i class="bi bi-trash-fill"></i></button>
                            @elseif($agreement_detail->status == "accept")
                            {{-- <span class="status is_confirm">Diterima <i class="bi bi-check-circle"></i></span> --}}
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel delete-agreement" type="button">Hapus<i class="bi bi-trash-fill"></i></button>
                            @elseif($agreement_detail->status == "reject")
                            <button class="btn delete delete-agreement" data-agreement-id="{{ $agreement_detail->agreement->id }}" data-agrement-detail-id="{{ $agreement_detail->id }}" type="button">Hapus <i class="bi bi-trash-fill"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $agreement_details->links() }}
            @else
            <div class="">
                <p align="center">Tidak ada persetujuan yang dibuat.</p>
                <p align="center">Silahkan buat persetujuan terlebih dahulu.</p>
            </div>
            @endif
        </div>
        
        @if (auth()->user()->hasRole('pengelola'))
            <a class="btn fixed create-btn" href="/pengelola/partners/agreements/create">Tambah</a>
        @endif
    </main>


    @error("message")
        <x-alertError :message="$message"></x-alertError>
    @enderror
    @if(session()->has('message'))
        <x-alertError :message="session()->get('message')"></x-alertErr>
    @endif

    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif
@endsection

@section('script')
    <script src="/js/partner/pengelola/agreement.js"></script>
@endsection
