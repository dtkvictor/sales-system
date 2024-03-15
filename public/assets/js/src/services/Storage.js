export default class Storage 
{
    cache = [];
    events = {};

    constructor(storage) {
        const objects = localStorage.getItem(storage);

        if(objects) {
            this.cache = JSON.parse(objects);
        };

        this.addEventListener(['add', 'update', 'remove', 'clear'], () => {
            const json = JSON.stringify((this.get()));
            localStorage.setItem(storage, json);
        });        
    }

    get() {
        return this.cache;
    }

    find(id) {
        return this.cache.find(object => object.id == id);
    }

    findBykey(key, value) {
        return this.cache.find(object => object[key] == value);
    }

    first() {
        return this.cache[0];
    }

    add(object) {
        this.cache.push(object);
        this.executeEventIfExists('add', object);
    }

    update(object) {
        const objectIndex = this.cache.findIndex(oldObject => oldObject.id == object.id);
        
        if(objectIndex < 0) return;
        this.cache[objectIndex] = object;
        this.executeEventIfExists('update', object);
    }

    remove(id) {
        this.cache = this.cache.filter(object => object.id != id);
        this.executeEventIfExists('remove', id);
    }

    clear() {
        this.cache = [];
        this.executeEventIfExists('clear');
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
        if(this.events['globals']) {
            this.events['globals'].forEach(callback => {
                callback(inject);
            });
        }
        if(this.events[alias]) {
            this.events[alias].forEach(callback => {
                callback(inject);
            })
        }
    }
}