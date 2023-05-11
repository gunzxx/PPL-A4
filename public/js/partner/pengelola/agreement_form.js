$(document).ready(function () {
    $("#agreement-required-form").validate({
        rules: {
            bean_type: {
                required: true,
            },
            stok: {
                required: true,
                number:true,
            },
            price: {
                required: true,
                number:true,
            },
        },
    })

    $("#offer_detail_id").change(function(){
        const offerDetail_id = $(this).val();
        $(".spinner-container").css('display','flex');

        $.ajax({
            url:'/api/offerDetail/'+offerDetail_id,
            method:'post',
            dataType : 'json',
            success:(e)=>{
                // console.log(e);
                $("#bean_type").val(e.bean_type);
                $(".spinner-container").css('display','none');
            },
            error:(e)=>{
                $(".spinner-container").css('display','none');
                console.log(e.responseJSON);
                // if()
                alert(e.responseJSON.message);
                window.location.reload()
            },
        })
    })
})