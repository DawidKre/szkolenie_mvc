import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import {Article} from "./article";

@Injectable()
export class ArticlesService {
    constructor(private http:Http) {
    }

    getArticles(page:Number) {
        return this.http.get('/articles/' + page + '/40.json')
            .map((res:Response) => res.json());
    }

    getArticle(id:Number) {
        return this.http.get('/article/' + id + '.json')
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

    deleteArticle(id:Number) {
        return this.http.delete('/articles/' + id + '.json')
            .map((res:Response) => res.json());
    }
}