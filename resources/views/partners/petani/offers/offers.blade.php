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
                    <p align="center">Tidak ada penawaran yang dibuat.</p>
                    <p align="center">Silahkan pilih kerja sama terlebih dahulu.</p>
                </div>
                <a class="btn create-btn" href="/petani/home">Pilih</a>
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
                        {{-- <a class="btn" href="/petani/partners/detail/{{ $partner->id }}" type="button">Lihat<i class="bi bi-eye"></i></a> --}}
                        <button class="btn delete batal-tawar" data-id="{{ $partner->id }}" type="button">Batal tawar</button>
                    </div>
                </div>
                @endforeach
                <a class="btn create-btn" href="/petani/offers/create">Tambah</a>
                <a href="/petani/offers/create" class="create-button"></a>
            @endif
        </div>
    </main>
@endsection

@section('script')
    <span id="petani_id" style="display: none;">{{ auth()->user()->id }}</span>
    <script src="/js/partner/petani/offers.js"></script>
@endsection