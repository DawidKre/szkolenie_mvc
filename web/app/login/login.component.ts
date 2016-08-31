import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {NgModel} from "@angular/common";
import {LoginService} from "./login.service";


@Component({
    templateUrl: 'app/login/login.component.html',
    providers: [NgModel, LoginService]
})


export class LoginComponent {

    loginForm;

    constructor(private loginService: LoginService,
                private router: Router) {

        this.loginForm = {
            usr_name: '',
            usr_password: ''
        };
    }


    login() {

        this.loginService.auth(this.loginForm)
            .subscribe(
                res => {
                    if (res.status == 0) {
                        localStorage.setItem('id_token', res.token);
                        this.router.navigate(['/backoffice/articles']);
                    }
                },
                error => console.error(error)
            );

        event.preventDefault();
    }

}