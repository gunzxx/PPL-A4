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
                                <p>Status : </p>
                                <p class="@if($agreement_detail->is_approved == 1) is_confirm @elseif($agreement_detail->is_rejected == 1) is_reject @else is_not_confirm @endif">{{ $agreement_detail->is_approved == 0 ? "Belum disetujui" : "Disetujui" }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        @if ($agreement_detail->is_approved == 0)
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn confirm confirm-agreement" type="button">Terima<i class="bi bi-check-lg"></i></button>
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel reject-agreement" type="button">Tolak<i class="bi bi-x-lg"></i></button>
                        @elseif($agreement_detail->is_approved == 1)
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle"></i></span>
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel cancel-agreement" type="button">Hapus <i class="bi bi-x-lg"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $agreement_details->links() }}
            @else
            <div class="">
                <p align="center">Tidak ada persetujuan.</p>
                <p align="center">Tunggu persetujuan dari pengelola.</p>
            </div>
            @endif
        </div>
    </main>

    <div class="popup-backdrop cancel-agreement-popup">
        <div class="popup-container">
            <div class="popup-text">Batalkan persetujuan dengan pengelola?</div>
            <div class="popup-alert">
                <button onclick="cancelAgreement()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    <div class="popup-backdrop reject-agreement-popup">
        <div class="popup-container">
            <div class="popup-text">Tolak persetujuan dengan pengelola?</div>
            <div class="popup-alert">
                <button onclick="rejectAgreement()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    <div class="popup-backdrop confirm-agreement-popup">
        <div class="popup-container">
            <div class="popup-text">Terima persetujuan dengan pengelola?</div>
            <div class="popup-alert">
                <button onclick="confirmAgreement()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    @error("message")
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror
@endsection

@section('script')
    <script src="/js/partner/petani/agreement.js"></script>
@endsection