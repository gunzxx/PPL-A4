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
                <p align="center">Tidak ada kerja sama yang dibuat.</p>
                <p align="center">Silahkan buat kerja sama terlebih dahulu.</p>
            @else
                @foreach ($partners as $partner)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col">
                            <h1>{{ ucfirst($partner->name) }}</h1>
                            <p>{{ ucfirst(auth()->user()->fullname) }}</p>
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
                        <a class="btn" href="/partners/edit/{{ $partner->id }}" type="button">Edit<i class="bi bi-pencil-square"></i></a>
                        <button class="btn delete" data-id="{{ $partner->id }}" type="button">Hapus<i class="bi bi-trash3-fill"></i></button>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        
        <a href="/partners/create" class="partner-add"><i class="bi bi-plus-lg"></i></a>
    </main>
@endsection

@section('script')
    <script src="js/partner/index.js"></script>
@endsection