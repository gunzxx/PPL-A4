@extends('template.main')

@section('head')
    <script src="/js/npm/chart.js"></script>
    <link rel="stylesheet" href="/css/uiv/loader4.css">
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
            <div class="label">
                <h1 style="text-align: center;">Forecasting Harga Kedelai</h1>
            </div>
            @if (auth()->user()->premium)
                <div class="canvas-container">
                    <div class="loader-premium-container">
                        <div class="loader-premium">
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                            <div class="circle"></div>
                        </div>
                        <p>Mengambil data...</p>
                    </div>
                    <canvas class="forecasting-chart" id="myChart">Memuat data kedelai...</canvas>
                </div>
                <div class="data-container">
                    <div class="tahun-container">
                        <label for="tahun">Pilih tahun : </label>
                        <select class="form-control" name="tahun" id="tahun">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021" selected>2021</option>
                        </select>
                    </div>
                    <div>
                        <p>Rata-rata harga kedelai pada tahun <span id="tahun-detail">-</span> : <span id="average-detail">-</span></p>
                    </div>
                </div>
            @else
                <div class="forecasting-no-premium">
                    <h1 align="center">Dapatkan informasi harga kedelai dengan menjadi <span class="badge-premium">premium</span></h1>
                    <button id="register-premium-btn" class="create-btn">Daftar sekarang</button>
                </div>
                <div class="modal-premium-container">
                    <div class="bg-modal-premium">
                    </div>
                    <div class="modal-premium">
                        <div class="modal-premium-description">
                            <h2 align="center">Keuntungan mendaftar premium</h2>
                            <p align="center">Dapatkan fitur forecasting harga kedelai dengan daftar menjadi pengguna Premium sekarang.</p>
                            <p align="center">Hanya dengan </p>
                            <p align="center"><strong style="font-size: 32px;">Rp. 300.000,-</strong></p>
                            <p align="center">anda dapat menikmati fitur premium <strong>selamanya</strong>.</p>
                        </div>
                        <div class="modal-premium-register">
                            <a href="/premium" class="premium-btn create-btn premium-btn-animate">Daftar sekarang</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="partner-home-container label mt-4">
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
                        <p title="klik untuk menampilkan lebih lengkap" class="card-description">Deskripsi : {{ strip_tags($partner->description) }}</p>
                        <small class="show-more">Baca selengkapnya</small>
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
    @if (auth()->user()->premium)
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
                            label: "Harga kedelai",
                            data: [],
                            backgroundColor: "rgba(54, 162, 235, 1)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            // borderWidth: 1
                        },
                    ],
                },
                options: {
                    responsive: true,
                }
            });
            myChart.update();

            // get data harga from api and update chart
            fetch("/api/kedelai?tahun=2021")
            .then((response)=>{
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Api error.');
            })
            .then((data_fetch)=>{
                document.querySelector(".loader-premium-container").style.display = "none";

                let data_harga = [];
                data_fetch.forEach(element => {
                    data_harga.push(parseInt(element['harga']));
                });
                
                myChart.data.datasets[0].data = data_harga;
                myChart.update();

                const total_harga = data_harga.reduce((a,b)=>a+b,0);
                const avg = (total_harga/data_fetch.length) || 0;

                $("#tahun-detail").text(2021);
                $("#average-detail").text(new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(avg));
            })
            .catch((error)=>{
                console.log(error);
            })

            // Change tahun ajax
            $("#tahun").change(function(){
                document.querySelector(".loader-premium-container").style.display = "flex";
                
                const tahun = $(this).val();
                const url = "/api/kedelai?tahun="+tahun;
                
                fetch(url)
                .then((response)=>{
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Api error.');
                })
                .then((data_fetch)=>{
                    document.querySelector(".loader-premium-container").style.display = "none";

                    let data_harga = [];
                    data_fetch.forEach(element => {
                        data_harga.push(parseInt(element['harga']));
                    });
    
                    myChart.data.datasets[0].data = data_harga;
                    myChart.update();
                    
                    const total_harga = data_harga.reduce((a,b)=>a+b,0);
                    const avg = (total_harga/data_fetch.length) || 0;

                    $("#tahun-detail").text(tahun);
                    $("#average-detail").text(new Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(avg));
                })
                .catch((error)=>{
                    console.log(error);
                })
            })
        </script>
    @else
        <script>
            $("#register-premium-btn").click(()=>{
                $(".modal-premium-container").css("display",'flex');
            })
            $(".bg-modal-premium").click(()=>{
                $(".modal-premium-container").css("display",'none');
            })
        </script>
    @endif
@endsection