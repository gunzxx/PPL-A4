var lanjut = false;
var agreementId;
$('.delete-agreement').click(function (e) {
    agreementId = $(this).attr('data-agreement-id');
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
            deleteAgreement()
        }
    })
    // $('.popup-backdrop.delete-agreement-popup').show();
})
$('.cancel-agreement').click(function (e) {
    agreementId = $(this).attr('data-agreement-id');
    Swal.fire({
        text: "Apakah yakin melakukan pembatalan data?",
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
            cancelAgreement()
        }
    })
    // $('.popup-backdrop.cancel-agreement-popup').show();
})


function cancelAgreement() {
    $.ajax({
        url: "/api/pengelola/agreements/cancel",
        method: "POST",
        data: {
            agreementId: agreementId,
        },
        success: (e) => {
            // console.log(e);
            alert(e.message)
            window.location.reload();
        },
        error: (e) => {
            // console.log(e);
            alert(e.responseJSON.message)
            window.location.reload();
        }
    })
}

function deleteAgreement() {
    $.ajax({
        url: "/api/pengelola/agreements/delete",
        method: "POST",
        data: {
            agreementId: agreementId,
        },
        success: (e) => {
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
            // console.log(e);
            alert(e.responseJSON.message)
            window.location.reload();
        }
    })
}