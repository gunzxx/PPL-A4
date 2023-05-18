$(document).ready(()=>{
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