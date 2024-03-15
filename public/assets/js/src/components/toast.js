import { generateUniqueId } from "../helpers/stringUtils.js";

/**
 * html toats
 * @param {string} id
 * @param {string} type
 * @param {string} message
 */

const toats = (id, type, message) => {
    return `<div class="toats-position toast-animation toats-width toast show align-items-center text-bg-${type} border-0 m-3" 
                role="alert" 
                aria-live="assertive" 
                aria-atomic="true" 
                id="${id}" 
                style="transition: 2s"
            >
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            </div>`
}

/**
 * create toats
 * @param {string} container
 * @param {string} id
 * @param {string} type
 * @param {string} message
 *  
 */
export const createToast = (type, message) => 
{
    const id = generateUniqueId();
    const toastContainer = document.querySelector('body');
    toastContainer.insertAdjacentHTML("beforebegin", toats(id, type, message));
    removeToast(id);
} 

/**
 * hide toast by id
 * @param {string} elementToatsId
 * 
 */
export const removeToast = (elementToatsId = 'feedbackToast') => {
    const toats = document.getElementById(elementToatsId);
    if(!toats) return;
    setTimeout(() => toats.classList.add('opacity-0'), 2000);
    setTimeout(() => toats.parentNode.removeChild(toats), 4000);
}