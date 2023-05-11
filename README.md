<h1>Cara menggunakan projek SoySync ini</h1>
<div style="width:100%; display:flex; justify-content:center;">
    <img src="https://cdn-icons-png.flaticon.com/512/3988/3988187.png" title="SoyBean" width="150">
</div>

## Step 1 : clone projek dari github
- buat folder di komputer anda, <strong>bebas dimana aja</strong>
- klik kanan dimana aja, lalu klik git bash here (catatan: pastikan anda sudah menginstall git)
- copas kode berikut :  <pre>git clone https://github.com/gunzxx/PPL-A4.git .</pre>
- tunggu sampe selesai, udah lanjut step 2

## Step 2 : install laravel
- tetep di terminalnya, lalu ketik <pre>composer i</pre>
- tunggu sampai selesai
- Masukkan perintah : <pre>cp .env.example .env</pre>
- kalo ada error bisa hubungi <a href="https://wa.me/+62895370015252" target="_blank"> aku </a>

## Step 3 : Konfigurasi database
- buat database baru dengan nama <pre>gunzxxmy_ppl</pre> di <strong>phpmyadmin</strong>
- atau kalian bisa konfigurasi sendiri di file .env kalo mau
- lalu jalankan perintah : <pre>php artisan migrate:fresh --seed</pre> di <strong>terminal</strong>
## Step 4 : Cara menjalankan aplikasinya
- ketik <pre>php artisan serve</pre> di <strong>Terminal</strong>
- buka browser lalu masukin ip nya
- Enjoyy, kalo ada error tinggal hubungi <a href="https://wa.me/+62895370015252" target="_blank"> aku </a> aja

