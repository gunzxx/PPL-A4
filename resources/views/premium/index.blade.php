@extends('template.main')

@section('head')
    <link rel="stylesheet" href="/css/premium/style.css">
@endsection

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div class="card-order">
            <img src="/img/premium/premium-img.jpg" alt="smile :)" width="150">
            @if ($premium->status == 'unpaid')
                <p>Pendaftaran sedang dilakukan. Silahkan selesaikan pembayaran.</p>
                <button id="pay-button" class="create-btn">Bayar</button>
            @elseif(auth()->user()->premium == true)
                <p>Selamat akun anda sudah <strong class="badge-premium">Premium</strong>.</p>
                <p class="premium-check"><i class="bi bi-check-circle-fill"></i></p>
            @endif
        </div>
    </main>
    
    @if(isset($success))
        <x-alertSuccess :message="$success"></x-alertSuccess>
    @endif
@endsection

@section('script')
    @if ($premium->status == 'unpaid')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script type="text/javascript">
            $(document).ready(()=>{
                var payButton = document.getElementById('pay-button');

                payButton.addEventListener('click', function () {
                    $('.spinner-container').css('display','flex');

                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result){
                            $('.spinner-container').css('display','none');
                            window.location.reload();
                            Swal.fire({
                                text : "Pembayaran berhasil",
                                icon : 'success',
                                confirmButtonColor: 'var(--g2)',
                                customClass: {
                                    popup:'swal-wide',
                                },
                            })
                        },
                        onPending: function(result){
                            $('.spinner-container').css('display','none');
                            Swal.fire({
                                text : "Pembayaran ditunda",
                                confirmButtonColor: 'var(--r2)',
                                customClass: {
                                    popup:'swal-wide',
                                },
                            })
                        },
                        onError: function(result){
                            $('.spinner-container').css('display','none');
                            Swal.fire({
                                text : "Pembayaran gagal!",
                                confirmButtonColor: 'var(--r2)',
                                customClass: {
                                    popup:'swal-wide',
                                },
                            })
                        },
                        onClose: function(){
                            $('.spinner-container').css('display','none');
                            Swal.fire({
                                text : "Pembayaran dibatalkan!",
                                confirmButtonColor: 'var(--r2)',
                                customClass: {
                                    popup:'swal-wide',
                                },
                            })
                        },
                    })
                });
            })
        </script>
    @endif
@endsection