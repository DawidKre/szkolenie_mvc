import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {User} from './users';
import {UsersService} from './users.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/users/user-edit.component.html',
    providers: [UsersService]
})

export class UserEditComponent implements OnInit, OnDestroy {

    user:User;
    statusList:Array<Object>;
    sub:any;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private usersService:UsersService) {

        this.user = {
            usr_id: 0,
            usr_name: '',
            usr_password: '',
            usr_email: '',
            usr_status: 0,
            usr_role: 0,
            usr_date: '',
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
                this.usersService.getUser(id)
                    .subscribe(
                        user => {
                            this.user = user.user;
                        },
                        error => console.log('onError: %s', error)
                    );
            }
        });
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

    saveUser() {
        this.usersService.saveUser(this.user)
            .subscribe(
                () => {
                    this.router.navigate(['/backoffice/users'])
                },
                error => console.log('onError: %s', error)
            );
    }

    backTousers() {
        this.router.navigate(['/backoffice/users'])
    }
}