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
    
    function getJWTToken(){
        return getCookie("soysync_jwt_token");
    }
})