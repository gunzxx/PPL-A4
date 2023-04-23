@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>


        <div class="search-partner">
            <input type="text" placeholder="Cari kerja sama">
            <span class="search-btn"><i class="bi bi-search pointer"></i></span>
        </div>

        <div class="partner-container">
            @if (count($agreement_details)>0)
                @foreach ($agreement_details as $agreement_detail)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col img">
                            <img src="/img/profile/2.png" alt="">
                        </div>
                        <div class="card-header-col">
                            <h1>{{ $agreement_detail->pengelola->fullname }}</h1>
                            <p>No. Telp.{{ $agreement_detail->pengelola->number_phone }}</p>
                        </div>
                        <div class="card-header-col end">
                            <p>{{ date("d F Y",strtotime($agreement_detail->agreement->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="detail-container">
                            <div class="detail-list">
                                <p>Jenis : </p>
                                <p class="green">{{ $agreement_detail->agreement->bean_type }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Stok : </p>
                                <p class="green">{{ $agreement_detail->agreement->stok }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Harga : </p>
                                <p class="green">{{ $agreement_detail->agreement->price }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Penawaran : </p>
                                <p class="green">{{ $agreement_detail->offerDetail->offer->name }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Status : </p>
                                <p class="@if($agreement_detail->is_approved == 1) is_confirm @elseif($agreement_detail->is_rejected == 1) is_reject @else is_not_confirm @endif">{{ $agreement_detail->is_approved == 0 ? "Belum disetujui" : "Disetujui" }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        @if ($agreement_detail->is_approved == 0 && $agreement_detail->is_rejected == 0)
                            <a class="btn" href="/pengelola/partners/agreements/edit/{{ $agreement_detail->id }}">Update <i class="bi bi-pencil-square"></i></a>
                            <button class="btn delete delete-agreement" data-agreement-id="{{ $agreement_detail->agreement->id }}" data-agrement-detail-id="{{ $agreement_detail->id }}" type="button">Batalkan <i class="bi bi-x-lg"></i></button>
                        @elseif($agreement_detail->is_approved == 1)
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle"></i></span>
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel delete-agreement" type="button">Batalkan<i class="bi bi-x-lg"></i></button>
                        @elseif($agreement_detail->is_rejected == 1)
                            <span class="status is_reject">Ditolak</span>
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
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror

    @if(session()->has('success'))
        <input type="hidden" id="error-msg" value="{{ session()->get('success') }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @endif
@endsection

@section('script')
    <script src="/js/partner/pengelola/agreement.js"></script>
@endsection

<?php

// array_has($array, key)

?>