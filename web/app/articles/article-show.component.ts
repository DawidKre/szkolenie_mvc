import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Article} from './article';
import {ArticlesService} from './articles.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/articles/article-show.component.html',
    providers: [ArticlesService]
})

export class ArticleShowComponent implements OnInit, OnDestroy {

    article:Article;
    comments:Array<any>;
    statusList:Array<Object>;
    sub:any;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private articlesService:ArticlesService) {
    }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            let id = +params['id'];

            if (id) {
                this.articlesService.getArticle(id)
                    .subscribe(
                        article => {
                            this.article = article.article;
                            this.comments = article.comments;
                            console.log(article);
                        },
                        error => console.log('onError: %s', error)
                    );
            }
        });
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

    saveArticle() {
        this.articlesService.saveArticle(this.article)
            .subscribe(
                () => {
                    this.router.navigate(['/backoffice/articles'])
                },
                error => console.log('onError: %s', error)
            );
    }

    backToArticles() {
        this.router.navigate(['/backoffice/articles'])
    }
}