import app = require('./app/app');
import {Routes} from "./routes";

export class Router {

    public Routes;
    public routes = {};

    constructor() {
        this.Routes = new Routes;
        this.routes = this.Routes.returnRoutes();
        console.info(this.routes);
    }

    public router() {
        var url = window.location.hash;
        console.log(123);
        if (this.routes.hasOwnProperty(url)) {
            var route = this.routes[url];
            route.controller();
        }
    }

}


