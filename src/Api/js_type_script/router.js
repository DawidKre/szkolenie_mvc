define(["require", "exports", "./routes"], function (require, exports, routes_1) {
    "use strict";
    var Router = (function () {
        function Router() {
            this.routes = {};
            this.Routes = new routes_1.Routes;
            this.routes = this.Routes.returnRoutes();
            console.info(this.routes);
        }

        Router.prototype.router = function () {
            var url = window.location.hash;
            console.log(123);
            if (this.routes.hasOwnProperty(url)) {
                var route = this.routes[url];
                route.controller();
            }
        };
        return Router;
    }());
    exports.Router = Router;
});
//# sourceMappingURL=router.js.map