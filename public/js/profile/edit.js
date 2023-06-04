$(document).ready(()=>{
    const current_inv_img = document.querySelector("#preview-img img").src;

    $("#change-profile").change(function(event){
        const [file] = event.target.files;

        if (file) {
            document.querySelector("#preview-img img").src = URL.createObjectURL(file);
        }
        else {
            document.querySelector("#preview-img img").src = current_inv_img;
        }
    });

    $("#profile-form-edit").validate({
        rules: {
            fullname: {
                required: true,
                minlength: 3,
            },
            id_number: {
                required: true,
                minlength: 3,
                maxlength: 16,
                digits:true,
            },
            address: {
                required: true,
                minlength: 3,
            },
            number_phone: {
                required: true,
                minlength: 10,
                maxlength: 12,
                number:true,
            },
        },
    })
});