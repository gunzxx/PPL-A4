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
        error.style.display = 'none'
    } else {
        this.style.border = "2px solid var(--r4)"
        error.style.display = 'block';
        error.innerHTML = "Harus angka"
        $(".numeric").parent().append(error)
    }
});