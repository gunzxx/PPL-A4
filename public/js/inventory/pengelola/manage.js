var id;
$('.delete-inv').click(function(e){
    id = this.getAttribute('data-inv-id');
    $(".popup-backdrop.delete-inventory").show()
})

function deleteInventory(){
    $.ajax({
        url: '/api/pengelola/inventory/delete',
        method: 'post',
        dataType: 'json',
        data: {
            id: id,
        },
        success: (e) => {
            console.log(e);
            alert(e.message)
            window.location.reload()
        },
        error: (e) => {
            console.log(e);
            alert("error");
            if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                window.location.reload();
            }
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
    messages:{
        bean_type:{
            required:"Data tidak valid",
        },
        stok:{
            required:"Data tidak valid",
            number:"Data harus angka",
        },
    },
})