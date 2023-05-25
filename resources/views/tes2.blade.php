<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tes payment gateway</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bs-icon/icon.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/npm/swal2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-3">SoySync Payment Gateway</h1>

        <div class="card" style="width: 18rem;">
            <img src="/favicon.ico" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Detail pesanan</h5>
                <table>
                    <tr>
                        <td>Pesanan dibuat pada : </td>
                        <td>{{ $premium->created_at }}</td>
                    </tr>
                </table>

                <button id="pay-button" class="btn btn-primary">Bayar sekarang</button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("payment success!"); console.log(result);
            },
            onPending: function(result){
                alert("wating your payment!"); console.log(result);
            },
            onError: function(result){
                alert("payment failed!"); console.log(result);
            },
            onClose: function(){
                alert('you closed the popup without finishing the payment');
            }
            })
        });
    </script>
</body>
</html>