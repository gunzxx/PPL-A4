@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div>
            <h1 style="text-align: center;">Beranda</h1>
            <div class="card-container">
                @foreach ($partners as $partner)
                    <div class="list-card">
                        <div class="card-header-row">
                            <div class="card-header-col card-header-identity">
                                <h1>{{ ucfirst($partner->name) }}</h1>
                                <p>{{ ucfirst($partner->pengelola->fullname) }}</p>
                            </div>
                            <div class="card-header-col end">
                                <h1>Rp {{ number_format(round($partner->price,-2),0,',','.') }}</h1>
                                <p>{{ $partner->stok }} kg kedelai</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Jenis kedelai : {{ strip_tags($partner->bean_type),20 }}</p>
                            <p>Deskripsi : {{ strip_tags($partner->description),500 }}</p>
                        </div>
                        <div class="card-footer">
                            <h3>{{ $partner->pengelola->address }}</h3>
                            <p>{{ date("d F Y", strtotime($partner->updated_at)) }}</p>
                        </div>
                        @if (auth()->user()->hasRole('petani'))
                            <a href="/petani/partners/offers/create/{{ $partner->id }}" class="tawar">Bid</a>
                        @endif
                    </div>
                @endforeach
                {{ $partners->links() }}
            </div>
        </div>
    </main>

    @if(session()->has('duplicate'))
        <input type="hidden" id="error-msg" value="{{ session()->get('duplicate') }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @endif
@endsection