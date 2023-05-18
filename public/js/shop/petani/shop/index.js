let item_id;
$(document).ready(function(){
    $(".delete-btn").click(function(){
        item_id = $(this).attr('data-item-id');
        Swal.fire({
            text: "Apakah yakin melakukan penghapusan data?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            allowOutsideClick: false,
            confirmButtonColor: 'var(--r2)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if(result.isConfirmed){
                $('.spinner-container').css('display','flex');
                $.post('/api/petani/item/delete',{
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
                })
            }
        })
    })
})