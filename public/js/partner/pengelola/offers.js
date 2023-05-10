var lanjut = false;
var detail_id, offer_id, partner_id;

$(".confirm").click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    partner_id = $(this).attr('data-partner-id');
    $('.popup-backdrop.confirm-offer').show();
})
$('.reject').click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    $('.popup-backdrop.reject-offer').show();
})
$('.cancel').click(function(){
    detail_id = $(this).attr('data-detail-id');
    offer_id = $(this).attr('data-offer-id');
    $('.popup-backdrop.cancel-offer').show();
})


function confirmOffer(){
    // console.log(offer_id);
    // console.log(detail_id);
    // console.log("OKE");
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
            alert(e.message);
            // console.log(e);
            // console.log("OKE");
            window.location.reload();
            partner_id=null;
        },
        error: (e) => {
            // console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")){
                window.location.reload();
            }
        },
    })
}

function cancelOffer(){
    // console.log(offer_id);
    // console.log(detail_id);
    // console.log("OKE");
    $.ajax({
        url: "/api/pengelola/offers/cancel",
        method: "post",
        dataType: "json",
        data: {
            detail_id: detail_id,
            offer_id: offer_id,
        },
        success: (e) => {
            alert(e.message);
            // console.log("OKE");
            window.location.reload();
        },
        error: (e) => {
            // console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
        },
    })
}

function rejectOffer(){
    // console.log(offer_id);
    // console.log(detail_id);
    // console.log("OKE");
    $.ajax({
        url: "/api/pengelola/offers/reject",
        method: "post",
        dataType: "json",
        data: {
            detail_id: detail_id,
            offer_id: offer_id,
        },
        success: (e) => {
            alert(e.message);
            // console.log("OKE");
            window.location.reload();
        },
        error: (e) => {
            // console.log(e);
            alert("error");
            if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
                window.location.reload();
            }
        },
    })
}