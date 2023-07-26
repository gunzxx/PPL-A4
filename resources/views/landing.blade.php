<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="dicoding:email" content="wwwnuriscs76@gmail.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SoySync</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/landing.css">
    <link rel="stylesheet" href="/css/bs-icon/icon.css">
    <link rel="shortcut icon" href="/img/icon.png" type="image/x-icon">
</head>
<body>
    <nav>
        <div class="nav-title-container">
            <a href="/"><h1 class="title">Soysync</h1></a>
        </div>
        <div class="nav-list">
            <a href="#home" class="nav-link">Home</a>
            <a href="#fitur" class="nav-link">Fitur</a>
            <a href="#about" class="nav-link">About</a>
            @if (auth()->check()!=true)
            <a class="login-button" href="/login">Login</a>
            @else
            <a class="login-button" href="/{{ auth()->user()->getRoleNames()[0] }}/home"><i class="bi bi-house-fill"></i></a>
            @endif
        </div>
    </nav>

    <div id="home" class="jumbotron">
        <div class="text-jumbotron-container">
            <div class="title-jumbotron">
                <p>Cari mitra kedelai</p>
                <p>untuk susu terbaikmu</p>
            </div>
            <div class="subtitle-jumbotron">
                <p>Memudahkan kerja sama  kedua mitra dengan keuntungan </p>
                <p>yang balance.</p>
            </div>
            @if (auth()->check()==true)
                <a href="/home" class="action-button px-3">Coba sekarang</a>                
            @else
                <a href="/register" class="action-button">Daftar sekarang</a>
            @endif
        </div>
        <img src="img/hero.png" title="SoySync" width="345" height="474">
    </div>

    <div id="fitur" class="fitur">
        <div class="title-fitur-container">
            <h1>Fitur SoySync</h1>
            <div class="subtitle-fitur">
                <p>Memberikan informasi Harga Pasar bahan baku kedelai</p>
                <p>Indonesia yang dapat dijadikan</p>
            </div>
        </div>
        <div class="content-fitur-container">
            <div class="row-fitur">
                <div class="col-fitur">
                    <div class="box-icon">
                        <img src="img/file.png" alt="">
                        <p>Forecasting</p>
                    </div>
                    <div class="box-content-description">
                        <p>Memberikan informasi Harga Pasar bahan baku kedelai Indonesia yang dapat dijadikan pemantauan harga jual beli kedelai.</p>
                    </div>
                </div>
                <div class="col-fitur">
                    <div class="box-icon">
                        <img src="img/openbox.png" alt="">
                        <p>Inventori</p>
                    </div>
                    <div class="box-content-description">
                        <p>Pemantauan stok inventori untuk bahan baku susu dan hasil kedelai antar keduanya yang saling terintegrasi.</p>
                    </div>
                </div>
            </div>
            <div class="row-fitur">
                <div class="col-fitur">
                    <div class="box-icon">
                        <img src="img/handshake.png" alt="">
                        <p>Kerja sama</p>
                    </div>
                    <div class="box-content-description">
                        <p>Layanan kerja sama yang memudahkan keterkaitan petani kedelai dan pengelola susu kedelai untuk mendapatkan keuntungan.</p>
                    </div>
                </div>
                <div class="col-fitur">
                    <div class="box-icon">
                        <img src="img/discount.png" alt="">
                        <p>Jual beli</p>
                    </div>
                    <div class="box-content-description">
                        <p>Jual beli kedelai yang sangat terjangkau dengan harga normal yang dapat memberikan keuntungan lebih dalam proses kerja sama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about" class="about">
        <div class="col-about">
            <div class="bg-about-img">
                <img src="img/about-img.png" title="SoySync">
            </div>
        </div>
        <div class="col-about col-about-2">
            <div class="title-about">
                <p>Hasilkan <b>kedelai</b></p>
                <p>untuk susu <b>kedelai</b></p>
            </div>
            <div class="subtitle-about">
                <p>Tempat terbaik untuk memasarkan hasil kedelai kamu kepada pihak pengelola yaitu susu kedelai.</p>
            </div>
            <div class="list-fitur-about">
                <ul>
                    <li>Keuntungan terbaik</li>
                    <li>Petani kedelai terbaik</li>
                    <li>Harga yang terjangkau</li>
                </ul>
            </div>
            <a class="action-button" href="/home">Coba sekarang</a>
        </div>
    </div>
</body>
</html>