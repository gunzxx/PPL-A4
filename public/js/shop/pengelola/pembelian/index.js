let item_id;
$(document).ready(function(){
    $(".cart-btn").click(function(){
        item_id = $(this).attr('data-item-id');
        Swal.fire({
            text: "Tambah barang ke keranjang?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            allowOutsideClick: false,
            confirmButtonColor: 'var(--g2)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if(result.isConfirmed){
                $('.spinner-container').css('display','flex');
                setTimeout(()=>{
                    $('.spinner-container').css('display','none');
                },1000)
                $.post('/api/pengelola/cart/add',{
                    item_id:item_id,
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
                    })
                }).fail((e)=>{
                    $('.spinner-container').css('display','none');
                    Swal.fire({
                        text : e.responseJSON.message,
                        confirmButtonColor: 'var(--r2)',
                        customClass: {
                            popup:'swal-wide',
                        },
                    })
                })
            }
        })
    })
})