$(document).ready(function(){
    $('.delete-inv').click(function(e){
        const id = this.getAttribute('data-inv-id');
        console.log(id);

        Swal.fire({
            text: "Apakah yakin melakukan penghapusan data",
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
                $.post('/api/petani/inventory/delete',{
                    id:id,
                }).done((e)=>{
                    GNotify.alertSuccess(e.message);
                    
                    $(this).parent().parent().hide(300);
                    setTimeout(() => {
                        $(this).parent().parent().remove();
                    }, 500)
                })
            }
        })
    })
})