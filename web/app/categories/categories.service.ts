import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import {Category} from "./category";


@Injectable()
export class CategoriesService {
    constructor(private http:Http) {
    }

    getCategories(page:Number) {
        return this.http.get('/categories/' + page + '.json')
            .map((res:Response) => res.json());
    }

    getCategory(catId:Number) {
        return this.http.get('/category/' + catId + '.json')
            .map((res:Response) => res.json());
    }

    saveCategory(category:Category) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        if (category.cat_id > 0) {
            return this.http.put('/categories/' + category.cat_id + '.json', JSON.stringify(category), {headers: headers})
                .map((res:Response) => res.json());
        } else {
            return this.http.post('/categories.json', JSON.stringify(category), {headers: headers})
                .map((res:Response) => res.json());
        }
    }

    deleteCategory(catId:Number) {
        return this.http.delete('/categories/' + catId + '.json')
            .map((res:Response) => res.json());
    }
}