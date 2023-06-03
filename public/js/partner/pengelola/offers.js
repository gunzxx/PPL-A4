var lanjut = false;
var detail_id, offer_id, partner_id;

$(".confirm").click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    partner_id = $(this).attr('data-partner-id');
    Swal.fire({
        text: "Terima penawaran dengan petani?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: true,
        confirmButtonColor: 'var(--g2)',
        customClass: {
            popup:'swal-wide',
        },
    }).then((result)=>{
        if(result.isConfirmed){
            $('.spinner-container').css('display','flex');
            confirmOffer();
        }
    })
    // $('.popup-backdrop.confirm-offer').show();
})
$('.reject').click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    Swal.fire({
        text: "Apakah anda yakin menolak penawaran petani?",
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Yes',
        allowOutsideClick: true,
        confirmButtonColor: 'var(--r2)',
        customClass: {
            popup:'swal-wide',
        },
    }).then((result)=>{
        if(result.isConfirmed){
            $('.spinner-container').css('display','flex');
            rejectOffer();
        }
    })
})

$('.delete').click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    
    Swal.fire({
        text: "Apakah yakin melakukan penghapusan data?",
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
            $('.spinner-container').css('display','flex');
            cancelOffer();
        }
    })
})


function confirmOffer(){
    $.ajax({
        url: "/api/pengelola/offers/confirm",
        method: "post",
        dataType: "json",
        data: {
            detail_id: detail_id,
            offer_id: offer_id,
            partner_id: partner_id,
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
            partner_id=null;
        },
        error: (e) => {
            // console.log(e);
            alert(e.responseJSON.message)
            window.location.reload();
        },
    })
}

function cancelOffer(){
    $.ajax({
        url: "/api/pengelola/offers/cancel",
        method: "post",
        dataType: "json",
        data: {
            detail_id: detail_id,
            offer_id: offer_id,
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
            Swal.fire({
                text : e.responseJSON.message,
                confirmButtonColor: 'var(--r2)',
                customClass: {
                    popup:'swal-wide',
                },
            }).then(()=>{
                window.location.reload();
            })
            window.location.reload();
        },
    })
}

function rejectOffer(){
    $.ajax({
        url: "/api/pengelola/offers/reject",
        method: "post",
        dataType: "json",
        data: {
            detail_id: detail_id,
            offer_id: offer_id,
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
            partner_id = null;
        },
        error: (e) => {
            // console.log(e);
            alert(e.responseJSON.message)
            window.location.reload();
        },
    })
}