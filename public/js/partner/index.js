var id;
$('.delete').click(function(e){
    id = $(this).attr('data-id');

    $('.popup-backdrop.delete-partner').show();
})
function deletePartner(){
    $.ajax({
        url: '/api/pengelola/partners/delete',
        method: "post",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            console.log(e);
            alert(e.message);
            window.location.reload();
        },
        error: (e) => {
            alert("gagal");
            console.log(e);
            if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                window.location.reload();
            }
        },
    })
}

$('.stop').click(function(e){
    id = $(this).attr('data-id');

    $('.popup-backdrop.stop-partner').show();
})
function stopPartner(){
    $.ajax({
        url: '/api/pengelola/partners/stop',
        method: "post",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            console.log(e);
            alert(e.message);
            window.location.reload();
        },
        error: (e) => {
            alert("gagal");
            console.log(e);
            if (confirm("Terjadi kesalahan, ingin memuat ulang halaman?")) {
                window.location.reload();
            }
        },
    })
}