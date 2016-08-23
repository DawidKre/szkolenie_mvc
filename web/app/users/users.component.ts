import {Component} from '@angular/core';
import {Router} from '@angular/router';

import {User} from './users';
import {UsersService} from './users.service';

@Component({
    templateUrl: 'app/users/users.component.html'
})
@Component({
    templateUrl: 'app/users/users.component.html',
    providers: [UsersService]
})

export class UsersComponent {

    users:Array<User>;
    category:Array<any>;

    constructor(private usersService:UsersService,
                private router:Router) {
        this.getUsers();

    }

    getUsers() {

        this.usersService.getUsers(1)
            .subscribe(
                users => {
                    this.users = users.users;
                },
                error => console.log('onError: %s', error)
            );
    }

    getUser(id) {
        this.usersService.getUser(id)
            .subscribe(
                category => {
                    this.category = category;
                },
                error => console.log('onError: %s', error)
            );
    }

    editUser(user) {
        if (user) {
            this.router.navigate(['/backoffice/user/' + user.usr_id]);
        } else {
            this.router.navigate(['/backoffice/user/0']);
        }
    }


}