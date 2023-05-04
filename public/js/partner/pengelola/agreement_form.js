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
})