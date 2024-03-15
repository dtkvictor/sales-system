import ajax from './src/helpers/ajax.js';
import { toSlug } from "./src/helpers/stringUtils.js";
import { numberFormat } from "./src/helpers/numberUtils.js";
import stringUtils from './src/helpers/stringUtils.js';
import numberUtils from './src/helpers/numberUtils.js';
import auth from './src/helpers/auth.js';
import routes from './src/routes/main.js';

/**
 * Define the model values to delete a item
 * @param {string} route Deletion route
 * @param {string} message Display name
 */
export const setDataModalDelete = (route, message) => {
    const modalDeleteForm =  document.getElementById('modalDeleteForm');
    const modalDeleteMessage =  document.getElementById('modalDeleteMessage');

    if(modalDeleteForm && modalDeleteMessage) {
        modalDeleteForm.action = route;
        modalDeleteMessage.textContent = message;
    }
}

/**
 * Add item deletion event to buttons
 */
export const addDeleteEventToButtons = () => {
    const buttons = document.querySelectorAll('button[data-delete-route]');
    if(!buttons) return;

    buttons.forEach(button => {
        let route = button.getAttribute('data-delete-route');
        let message = button.getAttribute('data-delete-message');
        button.addEventListener('click', () => setDataModalDelete(route, message));
    })
};

export const loadDataInputImage = () => {
    const img = document.querySelector('img[data-image-load=img]');
    const input = document.querySelector('input[data-image-load=input]');
    if(!img || !input) return;

    input.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if(file) {
            const fileReader = new FileReader();
            fileReader.addEventListener('load', data => {
                img.src = data.target.result;
            })
            fileReader.readAsDataURL(file);
        }
    })
}

/**
 * Format navbar search form value to slug. 
 */
const formatNavbarSearchFormValue = () => {
    const navbarFormSearch = document.getElementById('navbarFormSearch');
    if(!navbarFormSearch) return;
    navbarFormSearch.addEventListener('submit', event => {
        event.preventDefault();
        const search = navbarFormSearch.querySelector('input');
        search.value = toSlug(search.value);
        navbarFormSearch.submit();
    })
}


/**
 * Set show shopping items
 */

const setShowShoppingItems = () => {
    const buttons = document.querySelectorAll('button[data-shopping-items]');
    if(!buttons) return;

    buttons.forEach(button => {
        const items = JSON.parse(button.getAttribute('data-shopping-items'));
        console.log(items);
        button.addEventListener('click', () => mountItemDisplayContainer(items));      
    });

}

/**
 * Render items the modal.
 * @param array<object> items
 */

const mountItemDisplayContainer = (items) => {
    const table = document.getElementById('tableTbodyShoppingItems');
    if(!table || !items) return;

    const content = items.map(item => `
        <tr>
            <th>${item.id}</th>
            <td>${item.product.name}</td>
            <td>${item.amount}</td>
            <td>${numberFormat(item.unit_price)}</td>
        </tr>
    `);
    table.innerHTML = content;
}

window.app = {};

app.ajax = ajax;
app.auth = auth;
app.routes = routes;

app.ajax.addHeader("Content-Type", "application/json")
        .addHeader("Accept", "application/json")
        .addHeader("Authorization", "Bearer " + app.auth.getAccessToken());

app.ajax.addMiddleware("Unauthenticated", response => {
    const regex = new RegExp(app.routes.getPath('login'));
    if(!regex.test(location.href) && response.status == 401) { 
        document.getElementById("form-logout").click();
        app.routes.redirectTo('login');
    }
});

app.stringUtils = stringUtils;
app.numberUtils = numberUtils;


app.routes.run();
addDeleteEventToButtons();
formatNavbarSearchFormValue();
loadDataInputImage();
setShowShoppingItems();