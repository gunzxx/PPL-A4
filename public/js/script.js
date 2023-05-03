$(".closeAlert").on('click',function(){
    $(".alert-container").css('display','none')
})

// create error
var error = document.createElement('p');
error.classList.add('error');
error.style.color = "#e76666";
error.style.marginTop = '5px'
error.style.fontSize = '12px';
error.style.display = 'block';
error.textContent = "Error";

$(".numeric").on('keydown', function () {
    const inputValue = this.value;

    if (/^\d+$/.test(inputValue)) {
        this.style.border = "2px solid var(--w4)"
        error.style.display = 'none';
    } else {
        this.style.border = "2px solid var(--r4)"
        error.style.display = 'block';
        error.textContent = "Harus angka";
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

// var formUpdate = false;
// $("form.form-update").submit(async function(e){
//     let gagal = false;
//     e.preventDefault();
//     await $("form.form-update input").each((key, element) => {
//         console.log(key);
//         console.log(element.value);
//         if (element.value == "") {
//             gagal = true;
//         }
//     });
//     if (gagal == true) {
//         formUpdate = false;
//         alert("Data tidak valid!");
//     }
//     else{
//         formUpdate = true;
//         $(".popup-backdrop.cek-update").show();
//     }
// })
// $(".popup-yes-update").click(function(){
//     if(formUpdate == true){
//         $("form.form-update").unbind('submit');
//         $("form.form-update").submit();
//     }
// })



// $("form.required-form").submit(function(e){
//     let gagal = false;
//     $("form.required-form input").each((key,element)=>{
//         if(element.value.trim() == ""){
//             gagal = true;
//         }
//     });
//     $("form.required-form textarea").each((key,element)=>{
//         if(element.value.trim() == ""){
//             gagal = true;
//         }
//     });
//     if(gagal==true){
//         // e.preventDefault();
//         alert("Data tidak valid!");
//     }
// })


// Popup
$(".popup-yes").click(function(e){
    $(".spinner-container").css('display','flex');
})
$(".popup-no").click(function(){
    this.parentNode.parentNode.parentNode.style.display = "none";
})



// Alert
$(".alert-x").click(function () {
    $('.alert-container').hide(300);
})
$(".alert-container").ready(function (e) {
    setTimeout(function () {
        $(".alert-container").hide(300);
    }, 2500)
})

// Alert OK
$(".alert-ok").click(function () {
    $('.alert-ok-container').hide(300);
})