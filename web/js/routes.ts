//var Routing = new router.Router();
var routes = {};

function route(path, controller) {
    routes[path] = {controller: controller};
}

route('#articles', function () {
    var application = new app.App();
    console.log('articles');
});
route('#page2', function () {
    console.log('page2');
});

function returnRoutes() {
    return this.routes;
}
