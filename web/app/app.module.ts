import {NgModule}       from '@angular/core';
import {BrowserModule}  from '@angular/platform-browser';
import {FormsModule}    from '@angular/forms';
import {HttpModule}     from '@angular/http';


import {AppComponent}   from './app.component';
import {routing}        from './app.routing';
import {PaginationDirective} from "./directives/pagination.directive";
import {CategoriesComponent} from "./categories/categories.component";
import {CategoryEditComponent} from "./categories/category-edit.component";



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
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}