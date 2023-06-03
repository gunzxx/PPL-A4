var lanjut = false;
var agreementId;
var agreementDetailId;

$(".delete-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');

    Swal.fire({
        text: "Apakah yakin melakukan penghapusan data?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: false,
        confirmButtonColor: 'var(--)',
        cancelButtonColor: 'var(--b3)',
        customClass: {
            popup:'swal-wide',
        },
    }).then((result)=>{
        if(result.isConfirmed){
            deleteAgreement();
        }
    })
})

$(".reject-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');
    
    Swal.fire({
        text: "Tolak persetujuan dengan pengelola?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: true,
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup: 'swal-wide',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $('.spinner-container').css('display', 'flex');
            rejectAgreement();
        }
    })
})

$(".confirm-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');
    
    Swal.fire({
        text: "Terima persetujuan dengan pengelola?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: true,
        confirmButtonColor: 'var(--g2)',
        customClass: {
            popup: 'swal-wide',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            $('.spinner-container').css('display', 'flex');
            confirmAgreement();
        }
    })
})


function deleteAgreement() {
    $.ajax({
        url: "/api/petani/agreements/delete",
        method: "POST",
        data: {
            agreementId: agreementId,
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
            // console.log(e);
            alert(e.responseJSON.message)
            window.location.reload();
        },
    })
}

function confirmAgreement() {
    $.ajax({
        url: "/api/petani/agreements/confirm",
        method: "POST",
        data: {
            agreementDetailId: agreementDetailId,
        },
        success: (e) => {
            Swal.fire({
                text : e.message,
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
        },
    })
}

function rejectAgreement() {
    $.ajax({
        url: "/api/petani/agreements/reject",
        method: "POST",
        data: {
            agreementId: agreementId,
            agreementDetailId: agreementDetailId,
        },
        success: (e) => {
            Swal.fire({
                text : e.message,
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
        },
    })
}
