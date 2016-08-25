import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import {Article} from "./article";
import {Comment} from "./comment";

@Injectable()
export class ArticlesService {
    constructor(private http:Http) {
    }

    getArticles(page:Number) {
        return this.http.get('/articles/' + page + '.json')
            .map((res:Response) => res.json());
    }

    getArticle(id:Number) {
        return this.http.get('/article/' + id + '.json')
            .map((res:Response) => res.json());
    }

    getArticleComments(id:Number, page:Number) {
        return this.http.get('/article/comments/' + id + '/' + page + '.json')
            .map((res:Response) => res.json());
    }

    saveArticle(article:Article) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        if (article.art_id > 0) {
            return this.http.put('/articles/' + article.art_id + '.json', JSON.stringify(article), {headers: headers})
                .map((res:Response) => res.json());
        } else {
            return this.http.post('/articles.json', JSON.stringify(article), {headers: headers})
                .map((res:Response) => res.json());
        }
    }

    saveComment(comment:Comment) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        return this.http.post('/comments.json', JSON.stringify(comment), {headers: headers})
            .map((res:Response) => res.json());

    }

    deleteArticle(id:Number) {
        return this.http.delete('/articles/' + id + '.json')
            .map((res:Response) => res.json());
    }

    deleteComment(id:Number) {
        return this.http.delete('/comments/' + id + '.json')
            .map((res:Response) => res.json());
    }
}