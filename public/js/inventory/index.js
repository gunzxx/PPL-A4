$(document).ready(function(){
    let current_inv_img = document.querySelector("#preview-inv-img img").src;
    
    $("#inv-img").change(async function(event){
        const [file] = await event.target.files
        
        if(file){
            document.querySelector("#preview-inv-img img").src = URL.createObjectURL(file);
        }
        else{
            document.querySelector("#preview-inv-img img").src = current_inv_img;
        }
    })
})