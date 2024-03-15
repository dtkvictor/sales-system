import { toCPF, toNumber } from "../../../helpers/stringUtils.js";
import { createToast } from "../../../components/toast.js";

export default (callback) => {
    const formSearchClient = document.getElementById('searchClient');
    const inputSearchClient = formSearchClient.querySelector('input[type=search]');
    const buttonSearchClient = formSearchClient.querySelector('button[type=submit]');

    formSearchClient.addEventListener('submit', event => {
        event.preventDefault();
        if(!inputSearchClient.value) return;

        buttonSearchClient.disabled = true;
        const value = toNumber(inputSearchClient.value);

        app.ajax.get(app.routes.getPath('api.client.search', { cpf: value }))
                .then(response => response.json())
                .then(data => { 
                    callback(data.data);
                })
                .catch(error => {
                    if(error.status < 400 || error.status > 499) {
                        console.error(error.message);
                    }else {
                        createToast('danger','Error: ' + error.message);
                    }
                })
                .finally(() => {
                    inputSearchClient.value = '';
                    buttonSearchClient.disabled = false;
                })
    });

    inputSearchClient.addEventListener('keyup', event => {
        if(event.key === 'Backspace') return;
        event.target.value = toCPF(event.target.value);
    })
}