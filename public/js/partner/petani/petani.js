$('.tawar').click(function (){
    const petani_id = $("#petani_id").text();
    // console.log(petani_id);
    const id = $(this).attr('data-id');

    if(confirm("Tawar kedelai?")){
        $.ajax({
            url: '/api/petani/offers',
            method: "post",
            dataType: "json",
            data: {
                id: id,
                petani_id: petani_id,
            },
            success: (e) => {
                console.log(e);
                alert(e.message);
                window.location.href = "/petani/partners";
            },
            error: (e) => {
                console.log(e);
            },
        })
    }
})