$(".confirm").click(function(){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    $('.popup-backdrop.confirm-offer').show();

    $(".popup-confirm").click(function () {
        if ($(this).text() == "Yes") {
            $.ajax({
                url: "/api/pengelola/offers/confirm",
                method: "post",
                dataType: "json",
                data: {
                    detail_id: detail_id,
                    offer_id: offer_id,
                },
                success: (e) => {
                    alert(e.message);
                    console.log("OKE");
                    window.location.reload();
                },
                error: (e) => {
                    console.log(e);
                    alert("error");
                    if(confirm("Terjadi kesalahan, ingin memuat ulang halaman?")){
                        window.location.reload();
                    }
                },
            })
        } else {
            $('.popup-backdrop.confirm-offer').hide();
        }
    })
})

$('.cancel').click(function(e){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    $('.popup-backdrop.reject-offer').show();
    
    $(".popup-confirm").click(function(){
        if($(this).text()=="Yes"){
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
                    console.log("OKE");
                    window.location.reload();
                },
                error: (e) => {
                    console.log(e);
                    alert("error");
                    if(confirm("Terjadi kesalahan, ingin memuat ulang halaman?")){
                        window.location.reload();
                    }
                },
            })
        }else{
            $('.popup-backdrop.reject-offer').hide();
        }
    })
})