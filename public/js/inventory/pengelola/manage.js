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