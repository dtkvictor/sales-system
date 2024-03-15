import { createToast } from "../../components/toast.js";
/** 
 * Add error to the respective input
 * @param object errors 
*/
const addErrorContent = (errors) => {
    for(let error in errors) {
        let value = errors[error][0];
        let errorContainer = document.getElementById(`error-${error}`);
        if(error) {
            errorContainer.textContent = value;
        }
    }
}
/** 
 * Remove input error
*/
const removeErrorContent = () => {
    const errorsContainers = document.querySelectorAll('small[id*=error-]');
    for(let errorContainer of errorsContainers) {
        errorContainer.textContent = "";
    }
}   

const form = document.getElementById('form-login');
const buttonSubmit = document.querySelector('button[type=submit]');

form.addEventListener('submit', event => {
    buttonSubmit.disabled = true;
    event.preventDefault();
    const data = {};
    
    (new FormData(event.target)).forEach((value, key) => {
        data[key] = value;
    });

    app.ajax.post(app.routes.getPath('api.login'), {
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        const token = data?.data.accessToken;
        app.auth.setAccessToken(token);
        event.target.submit();
    })
    .catch(error => {
        removeErrorContent();
        if(error.data.errors) {
            addErrorContent(error.data.errors);
        }
        if(error.status == 401 && error.message) {
            createToast('danger', error.message);
        }
    })
    .finally(() => buttonSubmit.disabled = false)
});