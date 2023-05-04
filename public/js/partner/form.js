$(document).ready(function () {
    $("#partner-required-form").validate({
        rules: {
            name: {
                required: true,
            },
            description: {
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
            bean_type: {
                required: true,
            },
        },
    })
})