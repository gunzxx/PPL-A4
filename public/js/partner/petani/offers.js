// $(".batal-tawar").click(function(){
//     const detail_id = $(this).attr('data-detail-id');
//     const offer_id = $(this).attr('data-offer-id');

//     if (confirm("Batalkan penawaran?")) {
//         $.ajax({
//             url: '/api/petani/offers/cancel',
//             method: "post",
//             dataType: "json",
//             data: {
//                 detail_id: detail_id,
//                 offer_id: offer_id,
//             },
//             success: (e) => {
//                 console.log(e);
//                 alert(e.message);
//                 window.location.href = "/petani/partners/offers";
//             },
//             error: (e) => {
//                 console.log(e);
//             },
//         })
//     }
// })

$('.batal-tawar').click(function(e){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    $('.popup-backdrop').show();
    
    $(".popup-confirm").click(function(){
        if($(this).text()=="Yes"){
            $.ajax({
                url: '/api/petani/offers/cancel',
                method: "post",
                dataType: "json",
                data: {
                    detail_id: detail_id,
                    offer_id: offer_id,
                },
                success: (e) => {
                    console.log(e);
                    alert(e.message);
                    window.location.href = "/petani/partners/offers";
                },
                error: (e) => {
                    console.log(e);
                },
            })
        }else{
            $('.popup-backdrop').hide();
        }
    })
})