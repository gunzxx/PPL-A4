@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <x-searchPartner :value="(isset($search)?$search:'')"></x-searchPartner>

        <div class="partner-container">
            @if (count($partners)<1)
                <div class="">
                    <p align="center">Tidak ada kerja sama yang dibuat.</p>
                    <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
                </div>
            @else
                @foreach ($partners as $partner)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col card-header-identity">
                            <h1>{{ ucfirst($partner->name) }}</h1>
                            <p>{{ ucfirst(auth()->user()->fullname) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <h1>Rp {{ number_format(round($partner->price,-2),0,',','.') }}</h1>
                            <p>{{ $partner->stok }} kg kedelai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>Jenis kedelai : {{ strip_tags($partner->bean_type) }}</p>
                        <p title="klik untuk menampilkan lebih lengkap" class="card-description">Deskripsi : {{ $partner->description }}</p>
                        <small class="show-more">Baca selengkapnya</small>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $partner->pengelola->address }}</h3>
                        <p>{{ date("d F Y", strtotime($partner->updated_at)) }}</p>
                    </div>
                    <div class="card-action">
                        @if ($partner->is_active == 0)
                            <button class="btn delete" data-id="{{ $partner->id }}" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                        @else
                            @if ($partner->offerDetail()->where(['status'=>'accept'])->get('status')->count() < 1)
                                <a class="btn" href="/pengelola/partners/partners/edit/{{ $partner->id }}" type="button">Update<i class="bi bi-pencil-square"></i></a>
                            @endif
                            <button class="btn stop" data-id="{{ $partner->id }}" type="button">Berhenti<i class="bi bi-x-lg"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $partners->links() }}
            @endif
        </div>
        
        @if (auth()->user()->hasRole('pengelola'))
            <div class="fixed partner-btn-container">
                <a class="btn partner-btn partner-btn-history" href="/pengelola/partners/partners/history"><i class="bi bi-clock-history"></i></a>
                <a class="btn partner-btn partner-btn-create" href="/pengelola/partners/partners/create">Tambah</a>
            </div>
        @endif
    </main>

    <div class="popup-backdrop stop-partner">
        <div class="popup-container">
            <div class="popup-text">Apakah anda yakin untuk berhenti kerja sama?</div>
            <div class="popup-alert">
                <button onclick="stopPartner()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>
    
    <div class="popup-backdrop delete-partner">
        <div class="popup-container">
            <div class="popup-text">Apakah yakin melakukan penghapusan data kerja sama?</div>
            <div class="popup-alert">
                <button onclick="deletePartner()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    @error("message")
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
    <script src="/js/partner/index.js"></script>
@endsection