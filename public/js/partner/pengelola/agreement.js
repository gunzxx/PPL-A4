$(".delete-agreement").click(function(){
    const agreementId = $(this).attr('data-agreement-id');
    const agreementDetailId = $(this).attr('data-agrement-detail-id');

    if(confirm("Batalkan persetujuan?")){
        $.ajax({
            url:"/api/pengelola/agreements/delete",
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
            }
        })
    }
})