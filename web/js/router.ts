import app = require('./app/app');
import list = require('routes');

export class Router {
    
    //public list = new list;
    public routes = {};
    public el = null;

    constructor() {
        this.routes = list.returnRoutes();
    }

    public route(path, controller) {
        this.routes[path] = {controller: controller};
    }

    public router() {

        var el = document.getElementById('list');

        var url = window.location.hash;
        var route = this.routes[url];

        if (el && route.controller) {
            el.innerHTML = new route.controller();
        }
    }

    /*    public returnRoutes(){
     this.route('#articles', function () {
     var application = new app.App();
     console.log('articles');
     });
     this.route('#page2', function () {
     console.log('page2');
     });

     }*/
}


/*route('#articles', function () {
 var application = new app.App();
 console.log('articles');
 });
 route('#page2', function () {
 var hash = window.location.hash;
 });*/

