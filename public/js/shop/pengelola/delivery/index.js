$(".accept-btn").click(function(){
    const delivery_id = $(this).attr("data-delivery-id");

    Swal.fire({
        text: "Konfirmasi barang sudah diterima?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: false,
        confirmButtonColor: 'var(--g2)',
        cancelButtonColor: 'var(--b3)',
        customClass: {
            popup:'swal-wide',
        },
    }).then((result)=>{
        if(result.isConfirmed){
            $('.spinner-container').css('display','flex');
            $.post('/api/pengelola/delivery/accept',{
                delivery_id:delivery_id,
            }).done((e)=>{
                console.log(e);
                Swal.fire({
                    text : e.message,
                    icon : 'success',
                    confirmButtonColor: 'var(--g2)',
                    customClass: {
                        popup:'swal-wide',
                    },
                }).then(()=>{
                    $('.spinner-container').css('display','none');
                    window.location.reload();
                })
            }).fail((e)=>{
                Swal.fire({
                    text : e.responseJSON.message,
                    confirmButtonColor: 'var(--r2)',
                    customClass: {
                        popup:'swal-wide',
                    },
                }).then(()=>{
                    window.location.reload();
                })
            })
        }
    })
})