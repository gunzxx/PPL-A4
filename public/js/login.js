$(document).ready(function(){
    $("#login-required-form").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 3,
            },
        },
    })
})
