define(["require", "exports", './app/app', "./app/category"], function (require, exports, app, category_1) {
    "use strict";
    var Routes = (function () {
        function Routes() {
            this.routes = {};
            this.route('#articles', function () {
                var application = new app.App();
                console.log('articles');
            });
            this.route('#page2', function () {
                var category = new category_1.Category();
                console.log('category');
            });
        }

        Routes.prototype.route = function (path, controller) {
            this.routes[path] = {controller: controller};
        };
        Routes.prototype.returnRoutes = function () {
            return this.routes;
        };
        return Routes;
    }());
    exports.Routes = Routes;
});
//# sourceMappingURL=routes.js.map