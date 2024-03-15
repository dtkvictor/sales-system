import ShoppingCart from "../../services/ShoppingCart.js";
import searchClient from "./utils/searchClient.js";
import showCartInfo from "./utils/showCartInfo.js";
import { createToast } from "../../components/toast.js";

const formCheckoutShopping = document.getElementById('checkoutShopping');
const selectPaymentMethod = document.getElementById('payment_method');

const shoppingCart = new ShoppingCart();
const products = (shoppingCart.get()).map(product => ({ id: product.id, amount: product.amount }));
const totalValue = shoppingCart.getTotalValue();

const formData = {
    client: null,
    products: products,
    paymentMethod: null,
}

const addClientInfoToContainer = (data) => {
    const clientInfoToContainer = document.getElementById("clientInfoContainer");
    clientInfoToContainer.textContent = data.name;
}

showCartInfo(shoppingCart, () => {
    selectPaymentMethod.innerHTML = '';
});

searchClient((data) => {
    addClientInfoToContainer(data);
    formData.client = data.id;
});

if(totalValue > 0) {
    for(let parcel = 1; parcel <= 12; parcel++) {
        let option = document.createElement('option');
            option.value = `credit_card.${parcel}`;
            option.textContent = `${parcel}X $${(totalValue / parcel)}`;
        selectPaymentMethod.appendChild(option);
    }
    formData.paymentMethod = selectPaymentMethod.value;
}

selectPaymentMethod.addEventListener('change', event => {
    formData.paymentMethod = event.target.value;
})

formCheckoutShopping.addEventListener('submit', event => {
    event.preventDefault();
    if(shoppingCart.count() < 1) {
        return createToast('danger', 'Error: The cart is empyt.');
    }
    const inputClient = formCheckoutShopping.querySelector('input[name=client]');
    const inputProduct = formCheckoutShopping.querySelector('input[name=products]');
    const inputPaymentMethod = formCheckoutShopping.querySelector('input[name=payment_method]');

    inputClient.value = formData.client;
    inputProduct.value = JSON.stringify(formData.products);
    inputPaymentMethod.value = formData.paymentMethod;

    formCheckoutShopping.submit();
})