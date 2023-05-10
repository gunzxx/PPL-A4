var lanjut = false;
var agreementId;
$('.delete-agreement').click(function (e) {
    agreementId = $(this).attr('data-agreement-id');
    $('.popup-backdrop.delete-agreement-popup').show();
})
$('.cancel-agreement').click(function (e) {
    agreementId = $(this).attr('data-agreement-id');
    $('.popup-backdrop.cancel-agreement-popup').show();
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
            alert("error");
            if (confirm("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
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
            // console.log(e);
            alert(e.message)
            window.location.reload();
        },
        error: (e) => {
            // console.log(e);
            alert("error");
            if (confirm("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
        }
    })
}