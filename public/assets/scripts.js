function checkboxHelper(checkbox)
{
    checkbox.value = checkbox.checked;
}

function fileHelper(inputId, e)
{
    if(e.target.files && e.target.files[0] && e.target.files[0].size < 5242880) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const base64String = event.target.result;
                document.getElementById(inputId).value = base64String;
                resizeAndPreview(inputId, base64String, 256, 384);
            };
            reader.readAsDataURL(file);
        }
    }
    else
    {
        alert("Impossible de d'envoyer l'image.")
    }
}

function resizeAndPreview(input, base64, maxWidth, maxHeight, cb) {
    const img = new Image();
    img.src = base64;
    img.onload = () => {
        let width = img.width;
        let height = img.height;

        const imgAspectRatio = width / height;
        const maxAspectRatio = maxWidth / maxHeight;

        let newWidth, newHeight;

        if (imgAspectRatio > maxAspectRatio) {
            newWidth = maxWidth;
            newHeight = maxWidth / imgAspectRatio;
        } else {
            newHeight = maxHeight;
            newWidth = maxHeight * imgAspectRatio;
        }

        const canvas = document.createElement('canvas');
        canvas.width = maxWidth;
        canvas.height = maxHeight;

        const ctx = canvas.getContext('2d');

        ctx.fillStyle = 'black';
        ctx.fillRect(0, 0, maxWidth, maxHeight);

        const offsetX = (maxWidth - newWidth) / 2;
        const offsetY = (maxHeight - newHeight) / 2;

        ctx.drawImage(img, offsetX, offsetY, newWidth, newHeight);



        const resizedBase64 = canvas.toDataURL();
        document.getElementById("preview-" + input).src=resizedBase64
        document.getElementById(input).value = resizedBase64
        cb(resizedBase64)
    }
}

function toggleSidenav()
{
    document.getElementById('sidenav').classList.toggle('active')
    document.getElementById('menu-backdrop').classList.toggle('active')

}

function toggleCart()
{
    document.getElementById('cart-nav').classList.toggle('active')
    document.getElementById('cart-backdrop').classList.toggle('active')

}