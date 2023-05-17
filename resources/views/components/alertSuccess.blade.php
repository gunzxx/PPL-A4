<input type="hidden" id="alert-message" value="{{ $message }}">
<script>
    $(document).ready(()=>{
        GNotify.alertSuccess($("#alert-message").val())
    })
</script>