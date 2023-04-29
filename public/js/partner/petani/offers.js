// var lanjut = false;
// var detail_id;
// var offer_id;

// $('.batal-tawar').click(function(e){
//     detail_id = $(this).attr('data-detail-id');
//     offer_id = $(this).attr('data-offer-id');
//     $('.popup-backdrop.batal-tawar-popup').show();
// })
// $('.hapus-tawar').click(function(e){
//     detail_id = $(this).attr('data-detail-id');
//     offer_id = $(this).attr('data-offer-id');
//     $('.popup-backdrop.hapus-tawar-popup').show();
// })


// function deleteOffer() {
//     console.log(offer_id);
//     console.log(detail_id);
//     console.log("OKE");
//     $.ajax({
//         url: '/api/petani/offers/delete',
//         method: "post",
//         dataType: "json",
//         data: {
//             detail_id: detail_id,
//             offer_id: offer_id,
//         },
//         success: (e) => {
//             console.log(e);
//             alert(e.message);
//             window.location.reload();
//         },
//         error: (e) => {
//             console.log(e);
//             alert("error");
//             if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
//                 window.location.reload();
//             }
//         },
//     })
// }

// function cancelOffer() {
//     console.log(offer_id);
//     console.log(detail_id);
//     console.log("OKE");
//     $.ajax({
//         url: "/api/petani/offers/cancel",
//         method: "post",
//         dataType: "json",
//         data: {
//             detail_id: detail_id,
//             offer_id: offer_id,
//         },
//         success: (e) => {
//             alert(e.message);
//             console.log("OKE");
//             window.location.reload();
//         },
//         error: (e) => {
//             console.log(e);
//             alert("error");
//             if (alert("Terjadi kesalahan, memuat ulang halaman.")) {
//                 window.location.reload();
//             }
//         },
//     })
// }
