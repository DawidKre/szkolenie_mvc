import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {NgModel} from "@angular/common";

import {Category} from './category';
import {CategoriesService} from './categories.service';
import {PaginationDirective} from "../directives/pagination.directive";


@Component({
    templateUrl: 'app/categories/categories.component.html',
    providers: [CategoriesService, PaginationDirective, NgModel]
})


export class CategoriesComponent {

    categories:Array<Category>;
    category:Array<Category>;
    public currentPage:number = 1;
    public totalItems = 0;
    public maxSize:number = 5;

    constructor(private categoriesService:CategoriesService,
                private router:Router) {
        this.getCategories();

    }

    getCategories() {
        this.categoriesService.getCategories(this.currentPage)
            .subscribe(
                categories => {
                    this.categories = categories.categories;
                    this.totalItems = categories.count;
                },
                error => {
                    console.log('onErrors: %s', error)
                    this.router.navigate(['/backoffice/login']);
                }
            );
    }

    editCategory(category) {
        if (category) {
            this.router.navigate(['/backoffice/category/' + category.cat_id]);
        } else {
            this.router.navigate(['/backoffice/category/0']);
        }
    }

    deleteCategory(category) {
        this.categoriesService.deleteCategory(category.cat_id)
            .subscribe(
                result => this.getCategories(),
                error => alert('onError: %s' + error)
            );
    }

    public pageChanged():void {
        this.getCategories();
    };


}