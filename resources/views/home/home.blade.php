@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div style="text-align: center;">
            <h1>Beranda</h1>
            <div class="card-container">
                @foreach ($partners as $partner)
                    <div class="list-card">
                        <div class="card-header-row">
                            <div class="card-header-col">
                                <h1>{{ ucfirst($partner->name) }}</h1>
                                <p>{{ ucfirst($partner->pengelola->fullname) }}</p>
                            </div>
                            <div class="card-header-col end">
                                <h1>Rp {{ number_format(round($partner->price,-2),0,',','.') }}</h1>
                                <p>1 kg kedelai</p>
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
                            @if (auth()->user()->hasRole('petani'))
                                <a class="tawar" href="/petani/partners/offers/create/{{ $partner->id }}">Tawar</a>
                            @endif
                        </div>
                    </div>
                @endforeach
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