@extends('template.main')
@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <x-searchPartner :value="(isset($search)?$search:'')"></x-searchPartner>

        <div class="partner-container">
            @if ($partnerHistories->count()<1)
                <div class="">
                    <p align="center">Tidak ada history.</p>
                    <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
                </div>
            @else
                <h1 style="text-align: center; font-size: 32px;font-weight: 600;">Riwayat Kerja Sama</h1>
                @foreach ($partnerHistories as $partnerHistory)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col card-header-identity">
                            <h1>{{ ucfirst($partnerHistory->name) }}</h1>
                            <p>{{ ucfirst(auth()->user()->fullname) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <h1>Rp {{ number_format(round($partnerHistory->price,-2),0,',','.') }}</h1>
                            <p>{{ $partnerHistory->stok }} kg kedelai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p title="klik untuk lebih lengkap" class="card-description">{{ Str::limit(strip_tags($partnerHistory->description),500) }}</p>
                        <small class="show-more">Baca selengkapnya</small>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $partnerHistory->pengelola->address }}</h3>
                        <p>{{ date("d F Y", strtotime($partnerHistory->created_at)) }}</p>
                    </div>
                    <div class="card-action">
                        <span class="stop-partner">berhenti bekerja sama pada {{ date('d / m / Y',strtotime($partnerHistory->stoped_at)) }}</span>
                    </div>
                </div>
                @endforeach
                {{ $partnerHistories->links() }}
            @endif
        </div>
    </main>

    @if(session()->has('success'))
        <input type="hidden" id="error-msg" value="{{ session()->get('success') }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @endif
@endsection

@section('script')
    <script src="/js/partner/index.js"></script>
@endsection