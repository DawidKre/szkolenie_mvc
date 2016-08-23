/// <reference path="./app/libts/jquery.d.ts"/>
import {Router} from "./router";

var Routing = new Router();
Routing.router();

window.addEventListener('hashchange', function () {
    Routing.router();
});