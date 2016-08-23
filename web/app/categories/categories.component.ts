import {Component} from '@angular/core';
import {Router} from '@angular/router';

import {Category} from './category';
import {CategoriesService} from './categories.service';

@Component({
    templateUrl: 'app/categories/categories.component.html'
})
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

    getCategory(id) {
        this.categoriesService.getCategory(id)
            .subscribe(
                category => {
                    this.category = category;
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


}