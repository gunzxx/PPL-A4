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
            @if (count($details)<1)
                <div>
                    <p align="center">Tidak ada kerja sama yang dibuat.</p>
                    <p align="center">Silahkan cari kerja sama terlebih dahulu.</p>
                </div>
                <a class="btn create-btn" href="/petani/home">Cari</a>
            @else
                @foreach ($details as $detail)
                <div class="list-card">
                    <div class="card-header-row">
                        <div class="card-header-col">
                            <h1>{{ ucfirst($detail->partner->name) }}</h1>
                            <p>{{ ucfirst($detail->partner->pengelola->fullname) }}</p>
                        </div>
                        <div class="card-header-col end">
                            <h1>Rp {{ number_format(round($detail->partner->price,-2),0,',','.') }}</h1>
                            <p>1 kg kedelai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ Str::limit(strip_tags($detail->partner->description),500) }}</p>
                    </div>
                    <div class="card-footer">
                        <h3>{{ $detail->partner->pengelola->address }}</h3>
                        <p>{{ date("d F Y", strtotime($detail->partner->updated_at)) }}</p>
                    </div>
                    {{-- <div class="card-action">
                        <button class="btn delete tawar" data-id="{{ $detail->partner->id }}" type="button">Tawar<i class="bi bi-chevron-right"></i></button>
                    </div> --}}
                </div>
                @endforeach
            @endif
        </div>
    </main>
@endsection

@section('script')
    <span id="petani_id" style="display: none;">{{ auth()->user()->id }}</span>
    <script src="/js/partner/petani/petani.js"></script>
@endsection