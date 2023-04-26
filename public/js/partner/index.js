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
                    window.location.href = "/pengelola/partners";
                },
                error:(e)=>{
                    alert("gagal");
                    console.log(e);
                },
            })
        }else{
            $('.popup-backdrop').hide();
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
                    window.location.href = "/pengelola/partners";
                },
                error:(e)=>{
                    alert("gagal");
                    console.log(e);
                },
            })
        }else{
            $('.popup-backdrop').hide();
        }
    })
})