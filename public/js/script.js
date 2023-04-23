$(".closeAlert").on('click',function(){
    $(".alert-container").css('display','none')
})

// create error
const error = document.createElement('p');
error.classList.add('error');
error.style.color = "#e76666";
error.style.marginTop = '5px'
error.style.fontSize = '12px';
error.style.display = 'block';
error.innerHTML = "Error";

$(".numeric").on('keydown', function () {
    const inputValue = this.value;

    if (/^\d+$/.test(inputValue)) {
        this.style.border = "2px solid var(--w4)"
        error.style.display = 'none';
    } else {
        this.style.border = "2px solid var(--r4)"
        error.style.display = 'block';
        error.innerHTML = "Harus angka";
        this.parentElement.append(error)
    }
});


// Cancel button action
$('.cancel-action').click(function () {
    if (confirm("Batal simpan?")) {
        history.go(-1);
    }
    return false;
});


$(".profile-img").click(function(e){
    $(".profile-menu-container").show()
})
$(".backdrop-profile").click(function(e){
    $(".profile-menu-container").hide()
})
$(".logout").click(function(e){
    e.preventDefault();
    if(confirm("Yakin logout?")){
        window.location.href = "/logout";
    }
})


$(".form-update").submit(function(e){
    if(!confirm("Apakah data sesuai")){
        e.preventDefault();
    }
})


$("form").submit(function(e){
    e.preventDefault();
    var gagal = false;
     $("form.form-container input").each((key,element)=>{
        // console.log(element);
        if(element.value == ""){
            gagal = true;
        }
    });
    // console.log(element);
    // $("input").each(function(){
    //     const x = $("input").val();
    //     console.log(x);
    //     if (x == "") {
    //         gagal = true;
    //     }
    // })
    if(gagal==true){
        alert("Pop up jika kosong!");
    }else{
        // e.unbind();
    }
})