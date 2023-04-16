$(".batal-tawar").click(function(){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    if (confirm("Hapus penawaran?")) {
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
    }
})