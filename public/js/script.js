$(document).ready(function(){
    jQuery.extend(jQuery.validator.messages, {
        remote: "Please fix this field.",
        required: "Data tidak valid.",
        digits: "Masukkan hanya angka saja.",
        number: "Masukkan angka yang benar.",
        email: "Email tidak valid.",
        maxlength: jQuery.validator.format("Panjang maksimal {0} karakter."),
        minlength: jQuery.validator.format("Panjang minimal {0} karakter."),
        rangelength: jQuery.validator.format("Panjang antara {0} dan {1} karakter."),
        range: jQuery.validator.format("Masukkan nilai antara {0} dan {1}."),
        max: jQuery.validator.format("Nilai maksimal {0}."),
        min: jQuery.validator.format("Nilai minimal {0}."),
        equalTo: "Nilai tidak sama.",
        accept: "Ekstensi file tidak valid.",
        url: "URL tidak valid.",
        date: "Masukkan tanggal yang benar.",
        dateISO: "Masukkan format tanggal (ISO) yang benar.",
        creditcard: "Masukkan no. kredit yang benar.",
    });

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
    
    $(document).keydown(function(e){
        if(e.key === "/"){
            e.preventDefault()
            $(".search-container input").focus()
        }
    })
    $(".search-container input").keydown(function(e){
        var regex = new RegExp("[a-zA-Z0-9]");
        if (regex.test(e.key)) {
            console.log("true");
            return true;
        } else {
            e.preventDefault()
            console.log("false");
            return false;
        }
    })



    $(".show-more").click(function(){
        let sibling = $(this).siblings(".card-description")[0]
        
        if ($(sibling).css("display") =="-webkit-box"){
            $(this).text("Baca lebih sedikit")
            $(sibling).css("display",'block');
            $(sibling).attr("title",'klik untuk menampilkan lebih sedikit')
        }
        else if ($(sibling).css("display") =="block"){
            $(this).text("Baca selengkapnya")
            $(sibling).css("display",'-webkit-box');
            $(sibling).attr("title",'klik untuk menampilkan lebih lengkap')
        }
    })
    $(".card-description").click(function(){
        let sibling = $(this).siblings(".show-more")[0]

        if ($(this).css("display") =="-webkit-box"){
            $(sibling).text("Baca lebih sedikit")
            $(this).css("display",'block');
            $(this).attr("title",'klik untuk menampilkan lebih sedikit')
        }
        else if ($(this).css("display") =="block"){
            $(sibling).text("Baca selengkapnya")
            $(this).css("display",'-webkit-box');
            $(this).attr("title",'klik untuk menampilkan lebih lengkap')
        }
    })
})

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


// Popup
$(".popup-yes").click(function(e){
    $(".spinner-container").css('display','flex');
})
$(".popup-no").click(function(){
    this.parentNode.parentNode.parentNode.style.display = "none";
})





// getCookie function
function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');

    for (var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i].trim();
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }

    return null;
}
// JWT
// function getJWT() {
//     return getCookie("soysync_jwt_token");
// }