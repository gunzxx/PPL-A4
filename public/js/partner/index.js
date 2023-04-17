$('.delete').click(function(e){
    const id = $(this).attr('data-id');
    
    if(confirm("Hapus data?")){
        $.ajax({
            url:'/api/pengelola/partners/delete',
            method:"post",
            dataType:"json",
            data:{
                id:id,
            },
            success:(e)=>{
                console.log(e);
                alert(e.message);
                window.location.href = "/pengelola/partners";
            },
            error:(e)=>{
                console.log(e);
            },
        })
    }
})