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