import routes from "../config/routes.js";

const login = async () => await import("../pages/auth/login.js");
const logout = async () => await import("../pages/auth/logout.js");
const dashboard = async () => await import("../pages/dashbord/index.js");
const clientCreate = async () => await import("../pages/client/create.js");
const clientUpdate = async () => await import("../pages/client/update.js");
const product = async () => await import("../pages/product/index.js");
const shoppingCart = async () => await import("../pages/shopping/cart.js");

//web routes
routes.addRoute('login', '/auth/login', login);
routes.addRoute('logout', '/auth/logout', logout);

routes.addRoute('dashboard.index', '/dashboard', dashboard);

routes.addRoute('client.create', '/client/create', clientCreate);
routes.addRoute('client.update', '/client/:id/edit', clientUpdate);

routes.addRoute('product.index', '/product', product);

routes.addRoute('shopping.cart', '/shopping/cart', shoppingCart);

//api routes
routes.addRoute('api.login', '/api/auth/login');
routes.addRoute('api.logout', '/api/auth/logout');
routes.addRoute('api.product.search', '/api/product/search/:id');
routes.addRoute('api.client.search', '/api/client/search/:cpf');

export default routes;