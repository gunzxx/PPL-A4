$("form.login-required-form").submit(function(e){
    var gagal = false;
    $("form.login-required-form input").each((key, element) => {
        if (element.value == "") {
            gagal = true;
        }
    });
    if (gagal == true) {
        e.preventDefault();
        alert("Email/password tidak valid!");
    }
})