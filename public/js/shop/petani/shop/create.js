$(document).ready(function () {
    let current_inv_img = document.querySelector("#preview-img img").src;
    
    $("#inv-img").change(async function (event) {
        const [file] = await event.target.files;
    
        if (file) {
            document.querySelector("#preview-img img").src = URL.createObjectURL(file);
        }
        else {
            document.querySelector("#preview-img img").src = current_inv_img;
        }
    })

    $("#form-shop").validate({
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
            no_rek: {
                required: true,
                number:true,
                minlength:12,
                maxlength:16,
            },
            agreement_detail_id: {
                required: true,
            },
        },
    })

    $("#agreement_detail_id").change(function(){
        const agreementDetailId = $(this).val();
        $(".spinner-container").css('display','flex');

        $.ajax({
            url:'/api/agreementDetail/'+agreementDetailId,
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