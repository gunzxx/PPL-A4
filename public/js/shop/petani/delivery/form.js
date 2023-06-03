$(document).ready(()=>{
    // let current_inv_img = document.querySelector("#preview-img img").src;
    let current_inv_img = document.querySelector("#preview-img img").src

    $("#input-preview-img").change(async function (event) {
        const [file] = await event.target.files;

        if (file) {
            document.querySelector("#preview-img img").src = URL.createObjectURL(file)
        }
        else {
            document.querySelector("#preview-img img").src = current_inv_img
        }
    })

    let fullscreen = false;
    $("#preview-img img").click(function(){

        if(fullscreen ==false){
            fullscreen=true;
            this.style.cursor = 'zoom-out';
            if (this.requestFullscreen) {
                this.requestFullscreen();
            } else if (this.webkitRequestFullscreen) {
                this.webkitRequestFullscreen();
            } else if (this.msRequestFullscreen) {
                this.msRequestFullscreen();
            }
        }
        else if(fullscreen ==true){
            fullscreen=false;
            this.style.cursor = 'zoom-in';
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    })

    $("#proof-form-container").submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: "Apakah sudah sesuai?",
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            allowOutsideClick: false,
            confirmButtonColor: 'var(--g2)',
            cancelButtonColor: 'var(--b3)',
            customClass: {
                popup:'swal-wide',
            },
        }).then((result)=>{
            if(result.isConfirmed){
                $(this).unbind('submit');
                $(this).submit();
            }
        })
    })
})