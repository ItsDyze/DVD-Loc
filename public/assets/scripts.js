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

function createCookie(name,value,days) {
    let expires;
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 *1000));
        expires = "; expires=" + date.toLocaleString();
    } else {
        let expires = "";
    }
    document.cookie = name + "=" +  JSON.stringify(value) + expires + "; path=/";
}

function readCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(nameEQ) == 0) {
            return JSON.parse(c.substring(nameEQ.length,c.length));
        }
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

function removeFromCart(pId)
{
    let cart = readCookie("cart");

    if(cart && cart.articles)
    {
        let existingArticle = cart.articles.find(x => x.id === pId);

        cart.articles = cart.articles.filter(x => x.id !== pId);
    }

    createCookie("cart", cart, 30);
    location.reload();
}