<form action="/tes-media" method="post" enctype="multipart/form-data">
    @csrf
    <input name="image" required accept="image/jpg, image/png, image/jpeg" type="file">
    @error('image')
        {{ $message }}
    @enderror
    <button type="submit">Kirim</button>
</form>
