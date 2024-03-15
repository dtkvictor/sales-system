import { createToast } from '../components/toast.js';
import Storage from './Storage.js';

export default class ShoppingCart {
    events = {};
    storage = null;

    constructor() {
        this.storage = new Storage('shopping_cart');
    }

    get() {
        return this.storage.get();
    }

    getTotalValue() {
        const items = this.get();
        return items.reduce((count, item) => count + (item.price * item.amount), 0);
    }

    clear() {
        return this.storage.clear();
    }

    count() {
        return this.get().length;
    }

    findItem(id) {
        return this.storage.find(id);
    }

    addItem(product) {
        const item = this.storage.find(product.id);

        if(item) {
            item.amount ++;
            if(item.amount > product.inventory) {
                item.amount --;
                return createToast('danger', 'We not have this quantity of products in storage.')
            }
            this.storage.update(item);
        }else {
            product.amount = 1;
            this.storage.add(product);
        }

        this.executeEventIfExists('addItem', item ?? product);
    }

    removeItem(product) {
        const item = this.storage.find(product.id);
        if(!item) return;
        
        item.amount --;
        if(item.amount < 1) {
            this.storage.remove(item.id)
        }else {
            this.storage.update(item)
        }
        this.executeEventIfExists('removeItem', item);
    }

    addEventListener(events, callback) {
        if(typeof(events) === 'string') {
            events = [events];
        }
        events.forEach(event=> {
            if(this.events[event]) {
                this.events[event].push(callback);
            }else {
                this.events[event] = [callback];
            }
        });
    }

    executeEventIfExists(alias, inject = null) {
        if(this.events[alias]) {
            this.events[alias].forEach(callback => {
                callback(inject);
            })
        }
    }
}