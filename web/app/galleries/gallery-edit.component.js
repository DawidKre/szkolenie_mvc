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
var GalleryEditComponent = (function () {
    function GalleryEditComponent(router, route, galleriesService) {
        this.router = router;
        this.route = route;
        this.galleriesService = galleriesService;
        this.gallery = {
            gal_id: 0,
            gal_name: ''
        };
        this.statusList = [
            { label: 'Ukryty', value: 0 },
            { label: 'Widoczny', value: 1 }
        ];
    }
    GalleryEditComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.sub = this.route.params.subscribe(function (params) {
            var id = +params['id'];
            if (id) {
                _this.galleriesService.getGallery(id)
                    .subscribe(function (gallery) {
                    _this.gallery = gallery.gallery;
                }, function (error) { return console.log('onError: %s', error); });
            }
        });
    };
    GalleryEditComponent.prototype.ngOnDestroy = function () {
        this.sub.unsubscribe();
    };
    GalleryEditComponent.prototype.saveGallery = function () {
        var _this = this;
        this.galleriesService.saveGallery(this.gallery)
            .subscribe(function () {
            _this.router.navigate(['/backoffice/galleries']);
        }, function (error) { return console.log('onError: %s', error); });
    };
    GalleryEditComponent.prototype.backToGalleries = function () {
        this.router.navigate(['/backoffice/galleries']);
    };
    GalleryEditComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            templateUrl: 'app/galleries/gallery-edit.component.html',
            providers: [galleries_service_1.GalleriesService]
        }), 
        __metadata('design:paramtypes', [router_1.Router, router_1.ActivatedRoute, galleries_service_1.GalleriesService])
    ], GalleryEditComponent);
    return GalleryEditComponent;
}());
exports.GalleryEditComponent = GalleryEditComponent;
//# sourceMappingURL=gallery-edit.component.js.map