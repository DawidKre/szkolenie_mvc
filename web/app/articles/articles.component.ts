import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {NgModel} from "@angular/common";

import {Article} from './article';
import {ArticlesService} from './articles.service';
import {PaginationDirective} from "../directives/pagination.directive";
import {TruncatePipe} from '../pipes/truncate.pipe';

@Component({
    templateUrl: 'app/articles/articles.component.html',
    providers: [ArticlesService, PaginationDirective, NgModel],
    pipes: [TruncatePipe]
})

export class ArticlesComponent {

    articles:Array<Article>;
    article:Array<Article>;
    public currentPage:number = 1;
    public totalItems = 0;
    public maxSize:number = 5;

    constructor(private articlesService:ArticlesService,
                private router:Router) {
        this.getArticles();

    }

    getArticles() {
        this.articlesService.getArticles(this.currentPage)
            .subscribe(
                articles => {
                    this.articles = articles.articles;
                    this.totalItems = articles.count;
                },
                error => console.log('onError: %s', error)
            );
    }

    getArticle(id) {
        this.articlesService.getArticle(id)
            .subscribe(
                article => {
                    this.article = article;
                },
                error => console.log('onError: %s', error)
            );
    }

    editArticle(article) {
        if (article) {
            this.router.navigate(['/backoffice/article/' + article.art_id]);
        } else {
            this.router.navigate(['/backoffice/article/0']);
        }
    }

    deleteArticle(article) {
        this.articlesService.deleteArticle(article.art_id)
            .subscribe(
                result => this.getArticles(),
                error => alert('onError: %s' + error)
            );
    }

    showArticle(article) {
        if (article) {
            this.router.navigate(['/backoffice/article/show/' + article.art_id]);
        } else {
            this.router.navigate(['/backoffice/articles']);
        }
    }

    public pageChanged():void {
        this.getArticles();
    };


}