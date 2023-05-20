var id;
$('.delete').click(function(e){
    id = $(this).attr('data-id');
    Swal.fire({
        text:"Apakah yakin melakukan penghapusan data kerja sama?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup:'swal-wide',
        },
    })
    .then((result)=>{
        if(result.isConfirmed){
            deletePartner()
            $('.spinner-container').css('display','flex');
        }
    })
    // $('.popup-backdrop.delete-partner').show();
})

// Delete partner
function deletePartner(){
    $.ajax({
        url: '/api/pengelola/partners/delete',
        type: "POST",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            // console.log(e);
            
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
        },
        error: (e) => {
            alert("Terjadi kesalahan, memuat ulang halaman.");
            window.location.reload();
        },
    })
}

// Stop partner
$('.stop').click(function(e){
    id = $(this).attr('data-id');
    Swal.fire({
        text:"Apakah anda yakin untuk berhenti kerja sama?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: false,
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup:'swal-wide',
        },
    })
    .then((result)=>{
        if(result.isConfirmed){
            $('.spinner-container').css('display','flex');
            stopPartner();
            return false;
        }
    });
    // $('.popup-backdrop.stop-partner').show();
})
function stopPartner(){
    $.ajax({
        url: '/api/pengelola/partners/stop',
        type: "post",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            window.location.reload();
            GNotify.alertSuccess(e.message);
            
            // Swal.fire({
            //     text : e.message,
            //     icon : 'success',
            //     confirmButtonColor: 'var(--g2)',
            //     customClass: {
            //         popup:'swal-wide',
            //     },
            // }).then(()=>{
            //     window.location.reload();
            // })
        },
        error: (e) => {
            // console.log(e);
            alert("Terjadi kesalahan, memuat ulang halaman.");
            window.location.reload();
        },
    })
}