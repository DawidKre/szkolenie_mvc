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
var articles_service_1 = require('./articles.service');
var ArticleEditComponent = (function () {
    function ArticleEditComponent(router, route, articlesService) {
        this.router = router;
        this.route = route;
        this.articlesService = articlesService;
        this.article = {
            art_id: 0,
            art_title: '',
            art_slug: '',
            art_status: 0,
            art_body: '',
            art_date: '',
            art_cat_id: 2,
            art_usr_id: 1,
            galleries_gal_id: 1
        };
        this.statusList = [
            { label: 'Ukryty', value: 0 },
            { label: 'Widoczny', value: 1 }
        ];
    }
    ArticleEditComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.sub = this.route.params.subscribe(function (params) {
            var id = +params['id'];
            if (id) {
                _this.articlesService.getArticle(id)
                    .subscribe(function (article) {
                    _this.article = article.article;
                }, function (error) { return console.log('onError: %s', error); });
            }
        });
    };
    ArticleEditComponent.prototype.ngOnDestroy = function () {
        this.sub.unsubscribe();
    };
    ArticleEditComponent.prototype.saveArticle = function () {
        var _this = this;
        this.articlesService.saveArticle(this.article)
            .subscribe(function () {
            _this.router.navigate(['/backoffice/articles']);
        }, function (error) { return console.log('onError: %s', error); });
    };
    ArticleEditComponent.prototype.backToArticles = function () {
        this.router.navigate(['/backoffice/articles']);
    };
    ArticleEditComponent = __decorate([
        core_1.Component({
            selector: 'my-app',
            templateUrl: 'app/articles/article-edit.component.html',
            providers: [articles_service_1.ArticlesService]
        }), 
        __metadata('design:paramtypes', [router_1.Router, router_1.ActivatedRoute, articles_service_1.ArticlesService])
    ], ArticleEditComponent);
    return ArticleEditComponent;
}());
exports.ArticleEditComponent = ArticleEditComponent;
//# sourceMappingURL=article-edit.component.js.map