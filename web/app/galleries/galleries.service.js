"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
var GalleriesService = (function () {
    function GalleriesService(http) {
        this.http = http;
    }
    GalleriesService.prototype.getGalleries = function (page) {
        return this.http.get('/galleries/' + page + '.json')
            .map(function (res) { return res.json(); });
    };
    GalleriesService.prototype.getGallery = function (id) {
        return this.http.get('/gallery/' + id + '.json')
            .map(function (res) { return res.json(); });
    };
    GalleriesService.prototype.saveGallery = function (gallery) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        if (gallery.gal_id > 0) {
            return this.http.put('/galleries/' + gallery.gal_id + '.json', JSON.stringify(gallery), { headers: headers })
                .map(function (res) { return res.json(); });
        }
        else {
            return this.http.post('/galleries.json', JSON.stringify(gallery), { headers: headers })
                .map(function (res) { return res.json(); });
        }
    };
    GalleriesService.prototype.deleteGallery = function (id) {
        return this.http.delete('/galleries/' + id + '.json')
            .map(function (res) { return res.json(); });
    };
    GalleriesService = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [http_1.Http])
    ], GalleriesService);
    return GalleriesService;
}());
exports.GalleriesService = GalleriesService;
//# sourceMappingURL=galleries.service.js.map