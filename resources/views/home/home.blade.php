@extends('template.main')

@section('head')
    <script src="/js/npm/chart.js"></script>
@endsection

@section('content')
    <x-nav-all></x-nav-all>
    <div class="jumbotron-container">
        <img class="jumbotron-img" src="/img/home/jumbotron.png" title="SoySync">
        <div class="jumbotron-text">
            <h1>Prediksi Harga Kedelai?</h1>
            <p>SoySync Mempunyai fitur untuk mendapatkan data harga kedelai terbaru. Adanya forcasting akan membantu pengelola dan petani dalam melakukan perkiraan mengenai harga untuk melakukan proses transaksi.</p>
        </div>
    </div>

    <main>
        <div class="forecasting-container">
            <h1 class="mb-4">Forecasting Harga Kedelai</h1>
            <canvas class="forecasting-chart" id="myChart">Memuat data kedelai...</canvas>
        </div>

        <div class="partner-home-container">
            <h1 style="text-align: center;">Broadcasting kerja sama</h1>
        </div>
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
                        <p>Jenis kedelai : {{ strip_tags($partner->bean_type) }}</p>
                        <p>Deskripsi : {{ strip_tags($partner->description) }}</p>
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
    </main>

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif

    @if (session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif
@endsection

@section('script')
<script>
    // Initialize document
    const chart_document = document.getElementById("myChart").getContext("2d");
    
    // Create chart
    const myChart = new Chart(chart_document, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [
                {
                    label: "Data Penjualan",
                    data: [],
                    backgroundColor: "rgba(54, 162, 235, 1)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1
                },
            ],
        },
        options: {
            responsive: true,
        }
    });

    myChart.update();

    // Async get data from api and update chart
    (async()=>{
        let data_fetch;
        data_fetch = await fetch("/api/kedelai");
        data_fetch = await data_fetch.json();

        let data_kedelai = [];
        await data_fetch.forEach(element => {
            data_kedelai.push(parseInt(element['harga']));
        });
        console.log(await data_kedelai);

        myChart.data.datasets[0].data = data_kedelai;
        myChart.update();
    })()
</script>
@endsection