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
var common_1 = require("@angular/common");
var articles_service_1 = require('./articles.service');
var pagination_directive_1 = require("../directives/pagination.directive");
var truncate_pipe_1 = require('../pipes/truncate.pipe');
var ArticlesComponent = (function () {
    function ArticlesComponent(articlesService, router) {
        this.articlesService = articlesService;
        this.router = router;
        this.currentPage = 1;
        this.totalItems = 0;
        this.maxSize = 5;
        this.getArticles();
    }
    ArticlesComponent.prototype.getArticles = function () {
        var _this = this;
        this.articlesService.getArticles(this.currentPage)
            .subscribe(function (articles) {
            _this.articles = articles.articles;
            _this.totalItems = articles.count;
        }, function (error) {
            console.log('onError: %s', error);
            _this.router.navigate(['/backoffice/login']);
        });
    };
    ArticlesComponent.prototype.getArticle = function (id) {
        var _this = this;
        this.articlesService.getArticle(id)
            .subscribe(function (article) {
            _this.article = article;
        }, function (error) { return console.log('onError: %s', error); });
    };
    ArticlesComponent.prototype.editArticle = function (article) {
        if (article) {
            this.router.navigate(['/backoffice/article/' + article.art_id]);
        }
        else {
            this.router.navigate(['/backoffice/article/0']);
        }
    };
    ArticlesComponent.prototype.deleteArticle = function (article) {
        var _this = this;
        this.articlesService.deleteArticle(article.art_id)
            .subscribe(function (result) { return _this.getArticles(); }, function (error) { return alert('onError: %s' + error); });
    };
    ArticlesComponent.prototype.showArticle = function (article) {
        if (article) {
            this.router.navigate(['/backoffice/article/show/' + article.art_id]);
        }
        else {
            this.router.navigate(['/backoffice/articles']);
        }
    };
    ArticlesComponent.prototype.pageChanged = function () {
        this.getArticles();
    };
    ;
    ArticlesComponent = __decorate([
        core_1.Component({
            templateUrl: 'app/articles/articles.component.html',
            providers: [articles_service_1.ArticlesService, pagination_directive_1.PaginationDirective, common_1.NgModel],
            pipes: [truncate_pipe_1.TruncatePipe]
        }), 
        __metadata('design:paramtypes', [articles_service_1.ArticlesService, router_1.Router])
    ], ArticlesComponent);
    return ArticlesComponent;
}());
exports.ArticlesComponent = ArticlesComponent;
//# sourceMappingURL=articles.component.js.map