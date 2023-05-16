let item_id;
let amount;
$(document).ready(function(){
    const pengelola_id = $("#pengelola_id").html();
    
    $(".cart-btn").click(function(){
        item_id = $(this).attr('data-item-id');
        amount = $(this).siblings('.amount').val();
        
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
                $.post('/api/pengelola/cart/add',{
                    item_id:item_id,
                    amount:amount,
                    pengelola_id : pengelola_id,
                }).done((e)=>{
                    console.log(e.data);
                    Swal.fire({
                        text : e.message,
                        icon : 'success',
                        confirmButtonColor: 'var(--g2)',
                        customClass: {
                            popup:'swal-wide',
                        },
                    }).then(()=>{
                        $('.spinner-container').css('display', 'none');
                    })
                }).fail((e)=>{
                    Swal.fire({
                        text : e.responseJSON.message,
                        allowOutsideClick: false,
                        confirmButtonColor: 'var(--r2)',
                        customClass: {
                            popup:'swal-wide',
                        },
                    }).then(()=>{
                        window.location.reload()
                    })
                })
            }
        })
    })
})