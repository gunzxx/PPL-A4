$("#form-inventory").validate({
    rules:{
        bean_type:{
            required:true,
        },
        stok:{
            required:true,
            number:true,
        },
        inv_img: {
            required: true,
            accept: 'image/*',
        }
    },
})