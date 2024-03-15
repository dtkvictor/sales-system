/**
 * Add the necessary parameters
 * @param { string } url
 * @param { object } params
 * @return { string }
 */
const addUrlParams = (routeName, url, params) => {
    const matches = [...url.matchAll(/:(\w+)/g)].map(match => match[1]);
    const correspondence = matches.every(key => params.hasOwnProperty(key));

    if(matches.length > 0 && !correspondence) {
        throw new Error(
            `The route ${routeName} required the params: ${matches}. Informated params: ${JSON.stringify(params)}`
        );
    }

    for(let param in params) {
        let value = params[param];
        url = url.replace(':'+param, value);
    }

    return url;
}

/**
 * Adicione string de consulta no URL
 * @param { string } url
 * @param { object } queries
 * @return { string }
 */
const addUrlQueryString = (url, queries) => {
    const regex = /^(http|https):\/\/\w+/;
    url = regex.test(url) ? url : window.location.origin + url;
    url = new URL(url);

    for(let query in queries) {
        let value = queries[query];
        url.searchParams.append(query, value);
    }
    return url.toString();
}

export default {
    routes: [
        { name: 'teste', path: '/teste/:id', callback: () => false }
    ],
    /**
     * Checks if the route is registered and returns its path
     * @param { string } routeName 
     * @param { object } params 
     * @param { object } queries
     * @return { string }
     */
    getPath(routeName, params = {}, queries = {}) {
        let url = this.routes.find(route => route.name == routeName);
        if(!url) throw new Error(`Route ${routeName} in not defined in routes`);

        url = url.path;
        url = addUrlParams(routeName, url, params);
        url = addUrlQueryString(url, queries);

        return url;
    },
    /**
     * Redirect to route
     * @param { string } route 
     * @param { object } params 
     * @param { object } queries
     */
    redirectTo(route, params = {}, queries = {}) {
        window.location.href = this.getPath(route, params, queries);
    },
    /**
     * Register a route
     * @param {string} name 
     * @param {string} path
     * @param {() => } callback
     */
    addRoute(name, path, callback = null) {
        this.routes.push({ name: name, path:path, callback: callback })
    },
    /**
     * Run action route
     */
    run() {
        const currentRoute = window.location.pathname;

        const route = this.routes.find(route => {
            if(!route?.callback) return false;

            const path = route.path.replace(/\:(\w+)/g, '(\\w+)');
            const regex = new RegExp(`^${path}$`, 'g');
            return regex.test(currentRoute);
        });

        if(route && route?.callback) {
            route.callback();

        }
    },
}
