const idnumber = $('#id_number');

idnumber.on('keydown', function () {
    const inputValue = this.value;

    if (/^\d+$/.test(inputValue)) {
        this.style.border = "2px solid var(--w4)"
        error.style.display = 'none'
    } else {
        this.style.border = "2px solid var(--r4)"
        error.style.marginTop = '5px'
        error.style.fontSize = '10px'
        error.style.display = 'block'
        error.innerHTML = "Nomor identitas harus angka"
        idnumber.parent().append(error)
    }
});
