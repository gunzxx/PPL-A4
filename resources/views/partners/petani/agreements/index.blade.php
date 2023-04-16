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
            @if (count($partners)<1)
                <div>
                    <p align="center">Tidak ada persetujuan yang dibuat.</p>
                    <p align="center">Silahkan buat penawaran terlebih dahulu.</p>
                </div>
            @else
                @foreach ($partners as $partner)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col">
                            <h1>{{ ucfirst($partner->name) }}</h1>
                            <p>{{ ucfirst($partner->user->fullname) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <h1>Rp {{ number_format(round($partner->harga,-2),0,',','.') }}</h1>
                            <p>1 kg kedelai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ Str::limit(strip_tags($partner->description),500) }}</p>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $partner->alamat }}</h3>
                        <p>{{ date("d F Y", strtotime($partner->updated_at)) }}</p>
                    </div>
                    <div class="card-action">
                        @if ($partner->is_approved == 1)
                            <span class="label approved" data-id="{{ $partner->id }}" type="button">Sudah di setujui</span>
                        @else
                            <span class="label not-approved" data-id="{{ $partner->id }}" type="button">Belum disetujui</span>
                        @endif
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </main>
@endsection

@section('script')
    {{-- <span id="petani_id" style="display: none;">{{ auth()->user()->id }}</span>
    <script src="/js/partner/petani/offers.js"></script> --}}
@endsection