import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Article} from './article';
import {Comment} from './comment';
import {ArticlesService} from './articles.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/articles/article-show.component.html',
    providers: [ArticlesService]
})

export class ArticleShowComponent implements OnInit, OnDestroy {

    article:Article;
    comments:Array<any>;
    comment:Comment;
    articleComments:Array<any>;
    statusList:Array<Object>;
    sub:any;
    public currentPage:number = 1;
    public totalItems = 0;
    public maxSize:number = 5;
    private id;
    
    constructor(private router:Router,
                private route:ActivatedRoute,
                private articlesService:ArticlesService) {

        this.id = this.route.params.subscribe(params => {
            let id = +params['id'];

            this.comment = {
                cmt_id: 0,
                cmt_body: '',
                cmt_status: 1,
                cmt_usr_id: 1,
                cmt_art_id: id
            };
        });
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
                this.articlesService.getArticleComments(id, this.currentPage)
                    .subscribe(
                        comments => {
                            this.articleComments = comments.comments;
                            this.totalItems = comments.count;
                            console.log(this.articleComments);
                        },
                        error => {
                            console.log('onErrorsss: %s', error)
                            this.router.navigate(['/backoffice/login']);
                        }
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

    saveComment() {
        this.articlesService.saveComment(this.comment)
            .subscribe(
                result => this.ngOnInit(),
                error => alert('onError: %s' + error)
            );

    }

    deleteComment(comment) {
        if (confirm('Czy na pewno chcesz usunąć komentarz')) {
            this.articlesService.deleteComment(comment.cmt_id)
                .subscribe(
                    result => this.ngOnInit(),
                    error => alert('onError: %s' + error)
                );
        }
    }

    backToArticles() {
        this.router.navigate(['/backoffice/articles'])
    }

    public pageChanged():void {
        this.ngOnInit();
    };

}