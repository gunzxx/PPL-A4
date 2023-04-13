$('.delete-inv').click(function(e){
    let lanjut = confirm("Hapus data?")
    if(lanjut == true){
        const id = this.getAttribute('data-inv-id');
    
        $.ajax({
            url: '/api/inventory/delete',
            method:'post',
            dataType:'json',
            data:{
                id:id,
            },
            success:(e)=>{
                console.log(e);
                window.location.href ='/inventory/update'
            },
            error:(e)=>{
                console.log(e);
                console.log("error");
            }
        })
    }
})