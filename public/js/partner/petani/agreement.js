var lanjut = false;
var agreementId;
var agreementDetailId;

$(".cancel-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');
    $('.popup-backdrop.cancel-agreement-popup').show();
})

$(".reject-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');
    $('.popup-backdrop.reject-agreement-popup').show();
})

$(".confirm-agreement").click(function(){
    agreementId = $(this).attr('data-agreement-id');
    agreementDetailId = $(this).attr('data-agrement-detail-id');
    $('.popup-backdrop.confirm-agreement-popup').show();
})


function cancelAgreement() {
    $.ajax({
        url: "/api/petani/agreements/cancel",
        method: "POST",
        data: {
            agreementId: agreementId,
        },
        success: (e) => {
            console.log(e);
            alert(e.message)
            window.location.reload();
        },
        error: (e) => {
            console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
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
            console.log(e);
            alert(e.message);
            window.location.reload();
        },
        error: (e) => {
            console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
        },
    })
}

function rejectAgreement() {
    $.ajax({
        url: "/api/petani/agreements/reject",
        method: "POST",
        data: {
            agreementId: agreementId,
        },
        success: (e) => {
            console.log(e);
            alert(e.message)
            window.location.reload();
        },
        error: (e) => {
            console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
        },
    })
}
