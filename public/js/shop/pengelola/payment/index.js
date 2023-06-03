$(".cancel-btn").click(function(){
    const payment_id = $(this).attr("data-payment-id");

    Swal.fire({
        text: "Batalkan pesanan?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: false,
        confirmButtonColor: 'var(--r2)',
        cancelButtonColor: 'var(--b3)',
        customClass: {
            popup:'swal-wide',
        },
    }).then((result)=>{
        if(result.isConfirmed){
            $('.spinner-container').css('display','flex');
            $.post('/api/pengelola/payment/cancel',{
                payment_id:payment_id,
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
                    $(this).parent().parent().parent().remove();
                    
                    if($('.list-card').length == 0){
                        $(".box-container").html('<div><p align="center">Tidak ada data.</p></div>')
                    }

                    $('.spinner-container').css('display','none');
                    window.location.href = "/pengelola/shop/cart"
                })
            })
        }
    })
})