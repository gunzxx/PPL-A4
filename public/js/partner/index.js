$('.delete').click(function(e){
    const id = $(this).attr('data-id');

    $('.popup-backdrop.delete-partner').show();
    
    $(".popup-confirm").click(function(){
        if($(this).text()=="Yes"){
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
                    window.location.reload();
                },
                error:(e)=>{
                    alert("gagal");
                    console.log(e);
                    if(confirm("Terjadi kesalahan, ingin memuat ulang halaman?")){
                        window.location.reload();
                    }
                },
            })
        }else{
            $('.popup-backdrop.delete-partner').hide();
        }
    })
})

$('.stop').click(function(e){
    const id = $(this).attr('data-id');

    $('.popup-backdrop.stop-partner').show();
    
    $(".popup-confirm").click(function(){
        if($(this).text()=="Yes"){
            $.ajax({
                url:'/api/pengelola/partners/stop',
                method:"post",
                dataType:"json",
                data:{
                    id:id,
                },
                success:(e)=>{
                    console.log(e);
                    alert(e.message);
                    window.location.reload();
                },
                error:(e)=>{
                    alert("gagal");
                    console.log(e);
                    if(confirm("Terjadi kesalahan, ingin memuat ulang halaman?")){
                        window.location.reload();
                    }
                },
            })
        }else{
            $('.popup-backdrop.stop-partner').hide();
        }
    })
})