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
                //resizeImage(base64String, 512, 768, img => document.getElementById(inputId).value = img);
                document.getElementById(inputId).value = base64String;
            };
            reader.readAsDataURL(file);
        }
    }
    else
    {
        alert("Impossible de d'envoyer l'image.")
    }
}

function resizeImage(base64, maxWidth, maxHeight, callback)
{
    const img = new Image();
    img.src = base64;
    img.onload = () => {
        let width = img.width;
        let height = img.height;

        if (width > height) {
            if (width > maxWidth) {
                height *= maxWidth / width;
                width = maxWidth;
            }
        } else {
            if (height > maxHeight) {
                width *= maxHeight / height;
                height = maxHeight;
            }
        }

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, width, height);

        const resizedBase64 = canvas.toDataURL();
        console.log(resizedBase64)
        callback(resizedBase64);
    };
}