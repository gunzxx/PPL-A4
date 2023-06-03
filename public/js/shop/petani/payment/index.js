$(".accept-btn").click(function(){
    const payment_id = $(this).attr("data-payment-id");

    Swal.fire({
        text: "Konfirmasi bukti pembayaran?",
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
            $.post('/api/petani/payment/accept',{
                payment_id:payment_id,
            }).done((e)=>{
                Swal.fire({
                    text : e.message,
                    icon : 'success',
                    confirmButtonColor: 'var(--g2)',
                    customClass: {
                        popup:'swal-wide',
                    },
                }).then(()=>{
                    window.location.reload();
                });
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