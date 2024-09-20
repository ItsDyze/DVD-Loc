function addToCart(pId, pName)
{
    let cart = readCookie("cart");

    if(cart && cart.articles)
    {
        let existingArticle = cart.articles.find(x => x.id === pId);
        if(existingArticle !== undefined)
        {
            existingArticle.quantity++;
        }
        else
        {
            cart.articles.push({
                id: pId,
                name: pName,
                quantity: 1
            })
        }
    }
    else
    {
        cart = {
            articles: [{
                id: pId,
                name: pName,
                quantity: 1
            }]
        }
    }

    createCookie("cart", cart, 30);
}