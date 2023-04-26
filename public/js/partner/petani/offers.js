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
                    window.location.reload();
                },
                error: (e) => {
                    console.log(e);
                    alert("error");
                    if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                        window.location.reload();
                    }
                },
            })
        }else{
            $('.popup-backdrop').hide();
        }
    })
})