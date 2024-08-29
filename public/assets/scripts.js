function checkboxHelper(checkbox)
{
    checkbox.value = checkbox.checked;
}

function fileHelper(inputId, imgType, e)
{
    if(e.target.files && e.target.files[0] && e.target.files[0].size < 5242880) {
        const reader = new FileReader();
        reader.onload = evt => {
            resizeImage(evt.target.result, imgType, 512, 1024, (r) => document.getElementById(inputId).value = r)
        }
        reader.readAsText(e.target.files[0]);
    }
    else
    {
        alert("Impossible de d'envoyer l'image.")
    }
}

function resizeImage(imgBytes, imgType, maxWidth, maxHeight, cb)
{
    const blob = new Blob([byteArray]);

    const img = new Image();
    const url = URL.createObjectURL(blob);

    img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

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

        canvas.width = width;
        canvas.height = height;

        ctx.drawImage(img, 0, 0, width, height);

        canvas.toBlob((resizedBlob) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const resizedByteArray = new Uint8Array(event.target.result);
                cb(resizedByteArray);
            };
            reader.readAsArrayBuffer(resizedBlob);
        }, imgType);

        URL.revokeObjectURL(url);
    };
}