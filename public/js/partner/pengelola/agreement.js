$(".delete-agreement").click(function(){
    const agreementId = $(this).attr('data-agreement-id');
    const agreementDetailId = $(this).attr('data-agrement-detail-id');

    if(confirm("Hapus persetujuan?")){
        $.ajax({
            url:"/api/pengelola/agreements/delete",
            method:"POST",
            data:{
                agreementId : agreementId,
            },
            success:(e)=>{
                console.log(e);
                alert(e.message)
                window.location.href = "/pengelola/partners/agreements";
            }
        })
    }
})