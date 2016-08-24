import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Article} from './article';
import {ArticlesService} from './articles.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/articles/article-edit.component.html',
    providers: [ArticlesService]
})

export class ArticleEditComponent implements OnInit, OnDestroy {

    article:Article;
    statusList:Array<Object>;
    sub:any;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private articlesService:ArticlesService) {

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
            {label: 'Ukryty', value: 0},
            {label: 'Widoczny', value: 1}
        ];
    }

    ngOnInit() {
        this.sub = this.route.params.subscribe(params => {
            let id = +params['id'];

            if (id) {
                this.articlesService.getArticle(id)
                    .subscribe(
                        article => {
                            this.article = article.article;
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