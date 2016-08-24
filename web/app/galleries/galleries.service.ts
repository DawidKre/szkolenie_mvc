import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import {Gallery} from "./gallery";

@Injectable()
export class GalleriesService {
    constructor(private http:Http) {
    }

    getGalleries(page:Number) {
        return this.http.get('/galleries/' + page + '/40.json')
            .map((res:Response) => res.json());
    }

    getGallery(id:Number) {
        return this.http.get('/gallery/' + id + '.json')
            .map((res:Response) => res.json());
    }

    saveGallery(gallery:Gallery) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        if (gallery.gal_id > 0) {
            return this.http.put('/galleries/' + gallery.gal_id + '.json', JSON.stringify(gallery), {headers: headers})
                .map((res:Response) => res.json());
        } else {
            return this.http.post('/galleries.json', JSON.stringify(gallery), {headers: headers})
                .map((res:Response) => res.json());
        }
    }

    deleteGallery(id:Number) {
        return this.http.delete('/galleries/' + id + '.json')
            .map((res:Response) => res.json());
    }
}