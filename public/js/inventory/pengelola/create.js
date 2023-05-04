$("#form-inventory").validate({
    rules:{
        bean_type:{
            required:true,
        },
        stok:{
            required:true,
            number:true,
        },
    },
    messages:{
        bean_type:{
            required:"Data tidak valid",
        },
        stok:{
            required:"Data tidak valid",
            number:"Data harus angka",
        },
    },
})