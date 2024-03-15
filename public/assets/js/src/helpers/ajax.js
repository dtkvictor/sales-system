export default {
    middleware: [],
    headers: {},

    addMiddleware(alias, callback) {
        this.middleware.push({ alias: alias, callback: callback });
        return this;
    },
    removeMiddleware(alias) {
        this.middleware = this.middleware.filter(middle => middle.alias != alias)
    },
    addHeader(name, content) {
        this.headers[name] = content;
        return this;
    },
    async fetch(url, options = {}) {
        options.headers = {
            ...this.headers,
            ...options.headers,
        };
        options.redirect = "follow";

        const response = await fetch(url, options);
        this.middleware.forEach(middle => middle.callback(response.clone()));

        if(!response.ok) {
            const { ok, redirect, status, statusText, type, url } = response;
            const errorResponse = {
                ok, redirect, status, statusText, type, url, ...await response.json()
            }
            throw errorResponse;
        }
        return response;
    },
    get(url, options = {}) {
        return this.fetch(url, {...options, method: 'get'})
    },
    post(url, options = {}) {
        return this.fetch(url, {...options, method: 'post'})
    },
    patch(url, options = {}) {
        return this.fetch(url, {...options, method: 'patch'})
    },
    delete(url, options = {}) {
        return this.fetch(url, {...options, method: 'delete'})
    }
}