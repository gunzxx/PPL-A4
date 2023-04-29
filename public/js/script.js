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


$(".profile-image-container").click(function(e){
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

var formUpdate = false;
var gagal = false;
$("form.form-update").submit(async function(e){
    e.preventDefault();
    $("form.form-update input").each((key, element) => {
        if (element.value == "") {
            gagal = true;
        }
        else{
            gagal = false;
        }
    });
    if (gagal == true) {
        alert("Data tidak valid!");
    }
    else{
        $(".popup-backdrop.cek-update").show();
    }
})

$(".popup-yes-update").click(function(){
    $("form.form-update").stopPropagation();
})


$("form.required-form").submit(function(e){
    e.preventDefault();
    $("form.required-form input").each((key,element)=>{
        if(element.value == ""){
            gagal = true;
        }
    });
    if(gagal==true){
        e.preventDefault();
        alert("Data tidak valid!");
    }
})

$(".popup-yes").click(function(e){
    // e.preventDefault();
    $(".spinner-container").css('display','flex');
})
$(".popup-no").click(function(){
    this.parentNode.parentNode.parentNode.style.display = "none";
})