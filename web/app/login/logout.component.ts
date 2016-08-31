import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {NgModel} from "@angular/common";
import {LoginService} from "./login.service";


@Component({
    templateUrl: 'app/login/login.component.html',
    providers: [NgModel, LoginService]
})


export class LogoutComponent {

    constructor(private loginService: LoginService,
                private router: Router) {
        this.logout();
    }

    logout() {
        localStorage.clear();
        this.router.navigate(['/backoffice/articles']);
    }

}