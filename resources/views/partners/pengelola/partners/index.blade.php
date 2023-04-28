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
            @if (count($partners)<1)
                <div class="">
                    <p align="center">Tidak ada kerja sama yang dibuat.</p>
                    <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
                </div>
            @else
                @foreach ($partners as $partner)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col">
                            <h1>{{ ucfirst($partner->name) }}</h1>
                            <p>{{ ucfirst(auth()->user()->fullname) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <h1>Rp {{ number_format(round($partner->price,-2),0,',','.') }}</h1>
                            <p>{{ $partner->stok }} kg kedelai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ Str::limit(strip_tags($partner->description),500) }}</p>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $partner->pengelola->address }}</h3>
                        <p>{{ date("d F Y", strtotime($partner->updated_at)) }}</p>
                    </div>
                    <div class="card-action">
                        @if ($partner->is_active == 0)
                            <button class="btn delete" data-id="{{ $partner->id }}" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                        @else
                            <a class="btn" href="/pengelola/partners/partners/edit/{{ $partner->id }}" type="button">Update<i class="bi bi-pencil-square"></i></a>
                            <button class="btn stop" data-id="{{ $partner->id }}" type="button">Berhenti<i class="bi bi-x-lg"></i></button>
                        @endif
                    </div>
                </div>
                @endforeach
                {{ $partners->links() }}
            @endif
        </div>
        
        @if (auth()->user()->hasRole('pengelola'))
            <a class="btn fixed create-btn" href="/pengelola/partners/partners/create">Tambah</a>
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