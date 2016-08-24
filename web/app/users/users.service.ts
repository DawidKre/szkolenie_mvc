import {Injectable} from '@angular/core';
import {Http, Headers, Response} from '@angular/http';

import {User} from "./user";


@Injectable()
export class UsersService {
    constructor(private http:Http) {
    }

    getUsers(page:Number) {
        return this.http.get('/users/' + page + '/40.json')
            .map((res:Response) => res.json());
    }

    getUser(catId:Number) {
        return this.http.get('/user/' + catId + '.json')
            .map((res:Response) => res.json());
    }

    saveUser(user:User) {
        let headers = new Headers();
        headers.append('Content-Type', 'application/json');

        if (user.usr_id > 0) {
            return this.http.put('/users/' + user.usr_id + '.json', JSON.stringify(user), {headers: headers})
                .map((res:Response) => res.json());
        } else {
            return this.http.post('/users.json', JSON.stringify(user), {headers: headers})
                .map((res:Response) => res.json());
        }
    }

    deleteUser(id:Number) {
        return this.http.delete('/users/' + id + '.json')
            .map((res:Response) => res.json());
    }
}