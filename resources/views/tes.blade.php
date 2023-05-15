<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/bs-icon/icon.css">
<script src="/js/jquery.min.js"></script>
<script src="/js/npm/swal2.js"></script>
<style>
    .swal-button{
        padding: 5px 20px;
        /* padding: 0 !important; */
    }
    .swal-image{
        width: 10px !important;
        height: 10px !important;
    }
    .swal-icon{
        width: 50px !important;
        height: 50px !important;
    }
    .swal-wide{
        max-width: 400px;
    }
</style>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

{{-- Tes media --}}

{{-- <form action="/tes-media" method="post" enctype="multipart/form-data">
    <img height="100" src="{{ $user->getFirstMediaUrl('tes') }}" alt="">
    @csrf
    <input name="image" required accept="image/jpg, image/png, image/jpeg" type="file">
    @error('image')
        {{ $message }}
    @enderror
    <button type="submit">Kirim</button>
</form> --}}


{{-- Tes alert --}}
<div class="flex">
    <button id="klik">Klik bang</button>
</div>
<script>
    Swal.fire({
        icon:'success',
        text: 'tes?',
        customClass: {
            popup:'swal-wide',
            confirmButton:'swal-button',
        },
        confirmButtonColor: 'var(--g2)',
        text: "OK",
    }).then(function(){
        // alert("OK")
    });
    $(document).ready(function(){
        $("#klik").click(function(){
            Swal.fire({
                icon:'success',
                text: 'tes?',
                customClass: {
                    popup:'swal-wide',
                    confirmButton:'swal-button',
                },
                confirmButtonColor: 'var(--g2)',
                text: "OK",
            }).then(function(){
                // alert("OK")
            });
        })
    })
</script>