import {NgModule, provide}       from '@angular/core';
import {BrowserModule}  from '@angular/platform-browser';
import {FormsModule}    from '@angular/forms';
import {HttpModule, Http}     from '@angular/http';
import {AuthConfig, AuthHttp, JwtHelper} from 'angular2-jwt/angular2-jwt';

import {AppComponent}   from './app.component';
import {routing}        from './app.routing';
import {PaginationDirective} from "./directives/pagination.directive";
import {CategoriesComponent} from "./categories/categories.component";
import {CategoryEditComponent} from "./categories/category-edit.component";
import {AuthGuard} from "./common/auth.guard";



@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        routing
    ],
    declarations: [
        AppComponent,
        PaginationDirective,
        CategoriesComponent,
        CategoryEditComponent,

    ],
    providers: [
        AuthGuard, AuthHttp, JwtHelper,
        provide(AuthHttp, {
            useFactory: (http) => {
                return new AuthHttp(new AuthConfig({
                    headerName: 'token',
                    headerPrefix: '',
                    tokenName: 'id_token',
                    tokenGetter: (() => localStorage.getItem('id_token')),
                    globalHeaders: [{'Content-Type': 'application/json'}],
                    noJwtError: true,
                    noTokenScheme: true
                }), http);
            },
            deps: [Http]
        })
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}