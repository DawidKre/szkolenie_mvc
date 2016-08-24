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
var router_1 = require('@angular/router');
var galleries_service_1 = require('./galleries.service');
var GalleriesComponent = (function () {
    function GalleriesComponent(galleriesService, router) {
        this.galleriesService = galleriesService;
        this.router = router;
        this.getGalleries();
    }
    GalleriesComponent.prototype.getGalleries = function () {
        var _this = this;
        this.galleriesService.getGalleries(1)
            .subscribe(function (galleries) {
            _this.galleries = galleries.galleries;
        }, function (error) { return console.log('onError: %s', error); });
    };
    GalleriesComponent.prototype.getGallery = function (id) {
        var _this = this;
        this.galleriesService.getGallery(id)
            .subscribe(function (gallery) {
            _this.gallery = gallery;
        }, function (error) { return console.log('onError: %s', error); });
    };
    GalleriesComponent.prototype.editGallery = function (gallery) {
        if (gallery) {
            this.router.navigate(['/backoffice/gallery/' + gallery.gal_id]);
        }
        else {
            this.router.navigate(['/backoffice/gallery/0']);
        }
    };
    GalleriesComponent.prototype.deleteGallery = function (gallery) {
        var _this = this;
        this.galleriesService.deleteGallery(gallery.gal_id)
            .subscribe(function (result) { return _this.getGalleries(); }, function (error) { return alert('onError: %s' + error); });
    };
    GalleriesComponent = __decorate([
        core_1.Component({
            templateUrl: 'app/galleries/galleries.component.html',
            providers: [galleries_service_1.GalleriesService]
        }), 
        __metadata('design:paramtypes', [galleries_service_1.GalleriesService, router_1.Router])
    ], GalleriesComponent);
    return GalleriesComponent;
}());
exports.GalleriesComponent = GalleriesComponent;
//# sourceMappingURL=galleries.component.js.map