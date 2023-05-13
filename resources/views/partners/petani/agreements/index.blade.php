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
                                <img src="{{ $agreement_detail->pengelola->getFirstMediaUrl("profile") != "" ? $agreement_detail->pengelola->getFirstMediaUrl("profile") : "/img/profile/default.png" }}">
                            </div>
                            <div class="card-header-identity">
                                <h1>{{ ucfirst($agreement_detail->pengelola->fullname) }}</h1>
                                <p>No Telp.&nbsp;{{ ucfirst($agreement_detail->pengelola->number_phone) }}</p>
                            </div>
                        </div>
                        <div class="card-header-col end">
                            <p class="tanggal">{{ date("d F Y",strtotime($agreement_detail->agreement->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="card-body">
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
                                <p>Nama petani : </p>
                                <p class="green">{{ $agreement_detail->petani->fullname }}</p>
                            </div>
                            <div class="detail-list">
                                <p>Status : </p>
                                <p class="@if($agreement_detail->status == "accept") is_confirm @elseif($agreement_detail->status == "waiting") is_not_confirm @endif">
                                    @if($agreement_detail->status == "waiting")Belum disetujui @elseif($agreement_detail->status == "accept")Disetujui <i class='bi bi-check-circle'></i>@endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        @if ($agreement_detail->status == "waiting")
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn confirm confirm-agreement" type="button">Terima<i class="bi bi-check-lg"></i></button>
                            <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel reject-agreement" type="button">Tolak<i class="bi bi-x-lg"></i></button>
                        @elseif($agreement_detail->status == "accept")
                            <span class="status is_confirm">Diterima <i class="bi bi-check-circle-fill"></i></span>
                            {{-- <button data-agrement-detail-id="{{ $agreement_detail->id }}" data-agreement-id="{{ $agreement_detail->agreement->id }}" class="btn cancel cancel-agreement" type="button">Hapus <i class="bi bi-x-lg"></i></button> --}}
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
            <div class="popup-text">Apakah yakin melakukan penghapusan data?</div>
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