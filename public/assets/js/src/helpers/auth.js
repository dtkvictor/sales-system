const key = "ACCESS_TOKEN";

export default {
    getAccessToken() {
        return localStorage.getItem(key);
    },
    setAccessToken(token) {
        localStorage.setItem(key, token);
    },
    removeAccessToken() {
        localStorage.removeItem(key);
    }
}