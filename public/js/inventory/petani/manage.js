var id;
$('.delete-inv').click(function(e){
    id = this.getAttribute('data-inv-id');
    $(".popup-backdrop.delete-inventory").show()
})

function deleteInventory(){
    $.ajax({
        url: '/api/petani/inventory/delete',
        method: 'post',
        dataType: 'json',
        data: {
            id: id,
        },
        success: (e) => {
            console.log(e);
            alert(e.message)
            window.location.reload();
        },
        error: (e) => {
            console.log(e);
            alert("error");
            window.location.reload();
        }
    })
}

$("#form-inventory").validate({
    rules:{
        bean_type:{
            required:true,
        },
        stok:{
            required:true,
            number:true,
        },
    },
})