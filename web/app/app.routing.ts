import {Routes, RouterModule} from '@angular/router';
import {CategoriesComponent}  from './categories/categories.component';
import {CategoryEditComponent} from "./categories/category-edit.component";
import {CategoriesComponent}  from './categories/categories.component';
import {CategoryEditComponent} from "./categories/category-edit.component";
import {UserEditComponent} from "./users/user-edit.component";
import {UsersComponent} from "./users/users.component";

const appRoutes:Routes = [
    {
        path: 'backoffice/categories',
        component: CategoriesComponent
    },
    {
        path: 'backoffice/category/:id',
        component: CategoryEditComponent
    },
    {
        path: 'backoffice/users',
        component: UsersComponent
    },
    {
        path: 'backoffice/user/:id',
        component: UserEditComponent
    }
];

export const routing = RouterModule.forRoot(appRoutes);