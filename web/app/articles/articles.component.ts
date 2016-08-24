import {Component} from '@angular/core';
import {Router} from '@angular/router';

import {Article} from './article';
import {ArticlesService} from './articles.service';

@Component({
    templateUrl: 'app/articles/articles.component.html',
    providers: [ArticlesService]
})

export class ArticlesComponent {

    articles:Array<Article>;
    article:Array<Article>;

    constructor(private articlesService:ArticlesService,
                private router:Router) {
        this.getArticles();

    }

    getArticles() {
        this.articlesService.getArticles(1)
            .subscribe(
                articles => {
                    this.articles = articles.articles;
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


}