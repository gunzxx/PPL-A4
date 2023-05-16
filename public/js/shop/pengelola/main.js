$(document).ready(()=>{
    $(".amount").keydown(function(e){
        // var regex = new RegExp("[0-9\b]");
        var regex = new RegExp("[a-zA-Z0-9._]+|[\b]+$");
        if (regex.test(e.key)) {
            // console.log("true");
            return true;
        } else {
            e.preventDefault()
            console.log("false");
            return false;
        }
    })


    let amount = 0;
    $(".amount-plus").click(function(){
        amount += 1;
        $(this).siblings('.amount').text(amount);
    })

    $(".amount-min").click(function(){
        amount -= 1;
        if(amount<0){
            amount = 0;
        }
        $(this).siblings('.amount').text(amount);
    })
})