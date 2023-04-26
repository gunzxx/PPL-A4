$(".cancel-agreement").click(function(){
    const agreementId = $(this).attr('data-agreement-id');
    const agreementDetailId = $(this).attr('data-agrement-detail-id');
    console.log([agreementDetailId,agreementId]);

    if(confirm("Tolak penawaran?")){
        $.ajax({
            url:"/api/petani/agreements/delete",
            method:"POST",
            data:{
                agreementId : agreementId,
            },
            success:(e)=>{
                console.log(e);
                alert(e.message)
                window.location.reload();
            },
            error:(e)=>{
                console.log(e);
                alert("error");
                if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                    window.location.reload();
                }
            },
        })
    }
})

$(".confirm-agreement").click(function(){
    const agreementId = $(this).attr('data-agreement-id');
    const agreementDetailId = $(this).attr('data-agrement-detail-id');
    console.log([agreementDetailId,agreementId]);

    if(confirm("Terima penawaran?")){
        $.ajax({
            url:"/api/petani/agreements/confirm",
            method:"POST",
            data:{
                agreementDetailId : agreementDetailId,
            },
            success:(e)=>{
                console.log(e);
                alert(e.message)
                window.location.reload();
            },
            error:(e)=>{
                console.log(e);
                alert("error");
                if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                    window.location.reload();
                }
            },
        })
    }
})