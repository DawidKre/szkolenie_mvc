import app = require('./app/app');
import {Category} from "./app/category";

export class Routes {

    public routes = {};

    constructor() {
        this.route('#articles', function () {
            var application = new app.App();
            console.log('articles');
        });
        this.route('#page2', function () {
            var category = new Category();
            console.log('category');
        });
    }

    public route(path, controller) {
        this.routes[path] = {controller: controller};
    }

    public returnRoutes() {
        return this.routes;
    }
    
}



