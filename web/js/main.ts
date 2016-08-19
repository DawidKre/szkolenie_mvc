/// <reference path="./app/libts/jquery.d.ts"/>
import app = require('./app/app');
import router = require('./router');

//var application = new app.App();

var Routing = new router.Router();
/*
 this.oldHash = window.location.hash;
 var that = this;

 var detect = function(){
 if(that.oldHash!=window.location.hash){
 console.log(window.location.hash);
 that.oldHash = window.location.hash;

 if (that.oldHash == "#a"){
 var application = new app.App();
 }
 else if (that.oldHash == "#b"){
 console.log('hash = b');
 alert('das');
 }
 } 
 };
 this.Check = setInterval(function(){ detect() }, 100);

 */

// A hash to store our routes:
/*
 var routes = {};

 // The route registering function:
 function route (path, controller) {
 routes[path] = {controller: controller};
 }

 route('#articles', function () {
 var application = new app.App();
 console.log('articles');
 });
 route('#page2', function () {
 var hash = window.location.hash;
 });


 var el = null;

 function router () {
 el = document.getElementById('list');

 var url = window.location.hash;
 var route = routes[url];

 if (el && route.controller) {
 el.innerHTML = new route.controller();
 }
 }
 */
/*
 Routing.route('#articles', function () {
 var application = new app.App();
 console.log('articles');
 });
 Routing.route('#page2', function () {
 var hash = window.location.hash;
 });*/

window.addEventListener('hashchange', Routing.router);
window.addEventListener('load', Routing.router);

