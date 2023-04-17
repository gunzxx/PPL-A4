$(".confirm").click(function(){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    if(confirm("Konfirmasi penawaran?")){
        $.ajax({
            url:"/api/pengelola/offers/confirm",
            method:"post",
            dataType:"json",
            data:{
                detail_id:detail_id,
                offer_id:offer_id,
            },
            success:(e)=>{
                alert(e.message);
                console.log("OKE");
                window.location.href = "/pengelola/partners/offers"
            },
            error:(e)=>{
                console.log(e);
                alert("error");
            },
        })
    }
})

$(".cancel").click(function(){
    const detail_id = $(this).attr('data-detail-id');
    const offer_id = $(this).attr('data-offer-id');

    if(confirm("Tolak penawaran?")){
        $.ajax({
            url:"/api/pengelola/offers/cancel",
            method:"post",
            dataType:"json",
            data:{
                detail_id:detail_id,
                offer_id:offer_id,
            },
            success:(e)=>{
                alert(e.message);
                console.log("OKE");
                window.location.href = "/pengelola/partners/offers"
            },
            error:(e)=>{
                console.log(e);
                alert("error");
            },
        })
    }
})
