const form = document.getElementById('form-logout');
const csrf = document.querySelector('input[name=_token]');

form.addEventListener('submit', event => {
    event.preventDefault();
    app.ajax.post(app.routes.getPath('api.logout'), {
        body: JSON.stringify({
            [csrf.name]: csrf.value
        })
    })
    .then(() => app.auth.removeAccessToken())
    .finally(() => event.target.submit())
});