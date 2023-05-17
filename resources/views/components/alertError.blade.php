{{-- <div class="alert-container alert-container-error">
    <div class="alert-icon">
        <i class="bi bi-exclamation-triangle-fill"></i>
    </div>
    <div class="alert-body">
        <p>{{ $message }}</p>
    </div>
    <div class="alert-x-container">
        <button type="button" class="alert-x">&#10005;</button>
    </div>
    <div class="alert-loader"></div>
</div> --}}
<input type="hidden" id="alert-message" value="{{ $message }}">
<script>
    $(document).ready(()=>{
        GNotify.alertError($("#alert-message").val());
        $("#alert-message").remove();
    })
</script>