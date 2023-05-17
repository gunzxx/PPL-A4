let item_id;
let amount;
$(document).ready(function(){
    const pengelola_id = $("#pengelola_id").html();
    
    $(".cart-btn").click(function(){
        item_id = $(this).attr('data-item-id');
        amount = $(this).siblings('.amount').val();
        
        $('.spinner-container').css('display', 'flex');
        $.post('/api/pengelola/cart/add', {
            item_id: item_id,
            amount: amount,
            pengelola_id: pengelola_id,
        }).done((e) => {
            GNotify.alertSuccess(e.message);
            $('.spinner-container').css('display', 'none');
        }).fail((e) => {
            Swal.fire({
                text: e.responseJSON.message,
                allowOutsideClick: false,
                confirmButtonColor: 'var(--r2)',
                customClass: {
                    popup: 'swal-wide',
                },
            }).then(() => {
                window.location.reload()
            })
        })
    })
})