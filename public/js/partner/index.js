var id;
$('.delete').click(function(e){
    id = $(this).attr('data-id');
    $('.popup-backdrop.delete-partner').show();
})

// Delete partner
function deletePartner(){
    $.ajax({
        url: '/api/pengelola/partners/delete',
        type: "POST",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            // console.log(e);
            alert(e.message);
            window.location.reload();
        },
        error: (e) => {
            alert("gagal");
            // console.log(e);
            alert("Terjadi kesalahan, memuat ulang halaman.");
            window.location.reload();
        },
    })
}

// Stop partner
$('.stop').click(function(e){
    id = $(this).attr('data-id');
    $('.popup-backdrop.stop-partner').show();
})
function stopPartner(){
    $.ajax({
        url: '/api/pengelola/partners/stop',
        type: "post",
        dataType: "json",
        data: {
            id: id,
        },
        success: (e) => {
            // console.log(e);
            alert(e.message);
            window.location.reload();
        },
        error: (e) => {
            alert("gagal");
            // console.log(e);
            alert("Terjadi kesalahan, memuat ulang halaman.");
            window.location.reload();
        },
    })
}