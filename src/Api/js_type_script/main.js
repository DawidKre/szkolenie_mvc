define(["require", "exports", "./router"], function (require, exports, router_1) {
    "use strict";
    var Routing = new router_1.Router();
    Routing.router();
    window.addEventListener('hashchange', function () {
        Routing.router();
    });
});
//# sourceMappingURL=main.js.map