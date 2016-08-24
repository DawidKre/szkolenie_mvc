import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Category} from './category';
import {CategoriesService} from './categories.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/categories/category-edit.component.html',
    providers: [CategoriesService]
})

export class CategoryEditComponent implements OnInit, OnDestroy {

    category:Category;
    statusList:Array<Object>;
    sub:any;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private categoriesService:CategoriesService) {

        this.category = {
            cat_id: 0,
            cat_name: '',
            cat_slug: '',
            cat_status: 0
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
                this.categoriesService.getCategory(id)
                    .subscribe(
                        category => {
                            this.category = category.category;
                        },
                        error => console.log('onError: %s', error)
                    );
            }
        });
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

    saveCategory() {
        this.categoriesService.saveCategory(this.category)
            .subscribe(
                () => {
                    this.router.navigate(['/backoffice/categories'])
                },
                error => console.log('onError: %s', error)
            );
    }

    backToCategories() {
        this.router.navigate(['/backoffice/categories'])
    }
}