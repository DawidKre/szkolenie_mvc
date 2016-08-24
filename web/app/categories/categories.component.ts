import {Component} from '@angular/core';
import {Router} from '@angular/router';


import {Category} from './category';
import {CategoriesService} from './categories.service';
import {element} from "@angular/upgrade/src/angular_js";
import classElement = ts.ScriptElementKind.classElement;
import {el, el} from "@angular/platform-browser/esm/testing/browser_util";
import filter = require("core-js/fn/array/filter");


@Component({
    templateUrl: 'app/categories/categories.component.html',
    providers: [CategoriesService]
})


export class CategoriesComponent {

    categories:Array<Category>;
    category:Array<any>;

    constructor(private categoriesService:CategoriesService,
                private router:Router) {
        this.getCategories();

    }

    getCategories() {
        this.categoriesService.getCategories(1)
            .subscribe(
                categories => {
                    this.categories = categories.categories;
                    console.log(categories.categories);
                },
                error => console.log('onError: %s', error)
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


}