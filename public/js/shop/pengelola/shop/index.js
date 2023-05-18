let item_id;
let amount;
$(document).ready(function(){
    
    $(".cart-btn").click(function(){
        const item_id = parseInt($(this).attr('data-item-id'));
        const amount = parseInt($(this).siblings('.amount').val());
        const stok = parseInt($(this).parent().siblings('.list-card-body').find(".stok").text());

        if(amount > stok){
            return Swal.fire({
                text : "Jumlah melebihi batas stok!",
                icon:'error',
                confirmButtonColor: 'var(--r2)',
                customClass: {
                    popup:'swal-wide',
                },
            })
        }
        if(amount <1){
            return Swal.fire({
                text : "Jumlah valid!",
                icon:'error',
                confirmButtonColor: 'var(--r2)',
                customClass: {
                    popup:'swal-wide',
                },
            })
        }
        
        $('.spinner-container').css('display', 'flex');
        $.post('/api/pengelola/cart/add', {
            item_id: item_id,
            amount: amount,
        }).done((e) => {
            if(e.message == "Jumlah melebihi batas stok!"){
                Swal.fire({
                    text : e.message,
                    confirmButtonColor: 'var(--r2)',
                    customClass: {
                        popup:'swal-wide',
                    },
                })
            }
            else{
                GNotify.alertSuccess(e.message);
            }
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