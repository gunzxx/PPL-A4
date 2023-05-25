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
</head>
<body>
    <div class="container">
        <h1 class="my-3">SoySync Payment Gateway</h1>

        <div class="card" style="width: 18rem;">
            <img src="/favicon.ico" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kedelai hijau</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="qty" class="form-label">Mau pesan berapa?</label>
                        <input name="qty" type="number" class="form-control" id="qty" placeholder="Jumlah">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No HP</label>
                        <input name="phone" type="text" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea name="address" type="text" class="form-control" id="address"></textarea>
                    </div>
                    <button class="btn btn-primary">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>