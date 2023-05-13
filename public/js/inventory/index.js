$("#inv-img").change(function(){
    // console.log($("#inv-img").prop('files'));
    const [file] = document.getElementById("inv-img").files
    if(file){
        document.querySelector("#preview-inv-img img").src = URL.createObjectURL(file);
    }
})