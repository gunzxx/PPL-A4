$(document).ready(function () {
    $("form#register-form").validate({
        rules:{
            role:"required",
            fullname:{
                required:true,
            },
            id_number:{
                required:true,
                digits:true,
            },
            number_phone:{
                required:true,
                digits:true,
                maxlength:11,
            },
            address:{
                required:true,
            },
            email:{
                required:true,
                email:true,
            },
            password:{
                required:true,
                minlength:3,
            },
            // submitHandler: function (form) {
            //     console.log('test');
            //     // form.preventDefault();
            //     $(".popup-backdrop.register-popup").show();
            // },
        },
    })
    
    $(".popup-yes-register").click(function(){
        $("form.register-form").unbind('submit');
        $("form.register-form").submit();
    })
});
