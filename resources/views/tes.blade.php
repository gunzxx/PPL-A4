@extends('template.main')

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
@section('content')
    <div class="flex">
        <button id="klik">Klik bang</button>
    </div>
    <script>
        $("#klik").click(
            function(){
                Swal.fire('Dek iyeh bang?');
            }
        )
    </script>
@endsection