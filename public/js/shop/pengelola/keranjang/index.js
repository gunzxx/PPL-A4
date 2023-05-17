let cart_id;
let amount;
$(document).ready(function(){
    // Update chart
    $(".update-btn").click(function(){
        cart_id = $(this).attr('data-cart-id');
        amount = $(this).parent().siblings('.list-card-body').find('.amount').val();
        
        $('.spinner-container').css('display', 'flex');
        setTimeout(() => {
            $('.spinner-container').css('display', 'none');
        }, 1000)
        $.post('/api/pengelola/cart/update', {
            cart_id: cart_id,
            amount: amount,
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


    // Delete cart
    $(".delete-btn").click(function(){
        cart_id = $(this).attr('data-cart-id');

        Swal.fire({
            text: "Hapus keranjang?",
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
                $('.spinner-container').css('display', 'flex');
                setTimeout(() => {
                    $('.spinner-container').css('display', 'none');
                }, 1000)
                $.post('/api/pengelola/cart/delete', {
                    cart_id: cart_id,
                }).done((e) => {
                    GNotify.alertSuccess(e.message);
                    $(this).parent().parent().parent().hide(300)
                    setTimeout(()=>{
                        $(this).parent().parent().parent().remove()
                    },500)
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
            }
        })
        
    })


    // Update total amount
    $(".amount").change(function(){
        let cost = $(this).parent().parent().siblings('.list-card-detail').find('.cost').text().replace(".","");
        let amount = $(this).val().replace(".","")
        if(amount < 0){
            amount = 0;
            $(this).val(0)
        }
        let total_cost = cost * amount;
        total_cost = new Intl.NumberFormat({ maximumSignificantDigits: 3 }).format(total_cost)

        $(this).parent().parent().parent().parent().siblings('.list-card-thigh').find('.total_cost').text(total_cost);
    })
})