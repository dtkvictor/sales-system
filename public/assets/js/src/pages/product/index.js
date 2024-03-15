import ShoppingCart from '../../services/ShoppingCart.js';

const shoppingCart = new ShoppingCart();
const cartHandlerContainers = document.querySelectorAll('div[data-cart-handler-content]');

cartHandlerContainers.forEach(element => {
    const json = element.dataset.cartHandlerContent;
    if(!json) return;

    const product = JSON.parse(json);
    const btnAddProduct = element.querySelector('button[data-action=add]');
    const btnRemoveProduct = element.querySelector('button[data-action=remove]');
    const spanShowAmountProduct = element.querySelector('span[data-action=show-amount]');
          spanShowAmountProduct.setAttribute('product-ref', product.id);

    btnAddProduct.addEventListener('click', () => shoppingCart.addItem(product));
    btnRemoveProduct.addEventListener('click', () => shoppingCart.removeItem(product));
    spanShowAmountProduct.textContent = (shoppingCart.findItem(product.id))?.amount ?? 0;

    shoppingCart.addEventListener(['addItem', 'removeItem'], (product) => {
        if(spanShowAmountProduct.getAttribute('product-ref') == product.id) {
            spanShowAmountProduct.textContent = product.amount;
        }
    })

});

