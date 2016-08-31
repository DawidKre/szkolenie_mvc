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
var angular2_jwt_1 = require('angular2-jwt/angular2-jwt');
var ArticlesService = (function () {
    function ArticlesService(http) {
        this.http = http;
    }
    ArticlesService.prototype.getArticles = function (page) {
        return this.http.get('/articles/' + page + '.json')
            .map(function (res) { return res.json(); });
    };
    ArticlesService.prototype.getArticle = function (id) {
        return this.http.get('/article/' + id + '.json')
            .map(function (res) { return res.json(); });
    };
    ArticlesService.prototype.getArticleComments = function (id, page) {
        return this.http.get('/article/comments/' + id + '/' + page + '.json')
            .map(function (res) { return res.json(); });
    };
    ArticlesService.prototype.saveArticle = function (article) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        if (article.art_id > 0) {
            return this.http.put('/articles/' + article.art_id + '.json', JSON.stringify(article), { headers: headers })
                .map(function (res) { return res.json(); });
        }
        else {
            return this.http.post('/articles.json', JSON.stringify(article), { headers: headers })
                .map(function (res) { return res.json(); });
        }
    };
    ArticlesService.prototype.saveComment = function (comment) {
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/json');
        return this.http.post('/comments.json', JSON.stringify(comment), { headers: headers })
            .map(function (res) { return res.json(); });
    };
    ArticlesService.prototype.deleteArticle = function (id) {
        return this.http.delete('/articles/' + id + '.json')
            .map(function (res) { return res.json(); });
    };
    ArticlesService.prototype.deleteComment = function (id) {
        return this.http.delete('/comments/' + id + '.json')
            .map(function (res) { return res.json(); });
    };
    ArticlesService = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [angular2_jwt_1.AuthHttp])
    ], ArticlesService);
    return ArticlesService;
}());
exports.ArticlesService = ArticlesService;
//# sourceMappingURL=articles.service.js.map