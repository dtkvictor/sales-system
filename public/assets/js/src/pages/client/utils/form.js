import {  toPhoneNumber, toCPF, toNumber } from "../../../helpers/stringUtils.js";

export default () => {
    const clientForm = document.getElementById('clientForm');
    const phoneNumber = document.getElementById('phone_number');
    const cpf = document.getElementById('cpf');

    if(cpf) {
        cpf.value = toCPF(cpf.value);
        cpf.addEventListener('keyup', event => {
            if(event.key == 'Backspace') return;
            event.target.value = toCPF(event.target.value);
        })
    }

    if(phoneNumber) {
        phoneNumber.value = toPhoneNumber(phoneNumber.value);
        phoneNumber.addEventListener('keyup', event => {
            if(event.key == 'Backspace') return;
            event.target.value = toPhoneNumber(event.target.value);
        })
    }

    if(clientForm) {
        clientForm.addEventListener('submit', event => {
            event.preventDefault();

            cpf.value = toNumber(cpf.value);
            phoneNumber.value = toNumber(phoneNumber.value);
            
            event.target.submit();
        });
    }
}