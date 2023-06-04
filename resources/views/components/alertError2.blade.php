<input type="hidden" id="alert-message" value="{{ $message }}">
<script>
    const alertMessage = document.getElementById("alert-message").value;
    Swal.fire({
        text : alertMessage,
        icon : 'error',
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup:'swal-wide',
        },
    })
</script>