$(document).ready(function () {
    $("#offer-required-form").validate({
        rules: {
            description: {
                required: true,
            },
            stok: {
                required: true,
                number: true,
            },
            price: {
                required: true,
                number: true,
            },
        },
    })
})