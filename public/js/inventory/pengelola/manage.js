$('.delete-inv').click(function(e){
    let lanjut = confirm("Hapus data?")
    if(lanjut == true){
        const id = this.getAttribute('data-inv-id');
    
        $.ajax({
            url: '/api/pengelola/inventory/delete',
            method:'post',
            dataType:'json',
            data:{
                id:id,
            },
            success:(e)=>{
                console.log(e);
                alert(e.message)
                window.location.href ='/pengelola/inventory/update'
            },
            error:(e)=>{
                console.log(e);
                alert("error");
            }
        })
    }
})