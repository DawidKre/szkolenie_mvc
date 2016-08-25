import {Routes, RouterModule} from '@angular/router';
import {CategoriesComponent}  from './categories/categories.component';
import {CategoryEditComponent} from "./categories/category-edit.component";
import {UserEditComponent} from "./users/user-edit.component";
import {UsersComponent} from "./users/users.component";
import {GalleriesComponent} from "./galleries/galleries.component";
import {GalleryEditComponent} from "./galleries/gallery-edit.component";
import {ArticlesComponent} from "./articles/articles.component";
import {ArticleEditComponent} from "./articles/article-edit.component";
import {ArticleShowComponent} from "./articles/article-show.component";
import {GalleryPhotoComponent} from "./galleries/gallery-photo.component";

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
    },
    {
        path: 'backoffice/galleries',
        component: GalleriesComponent
    },
    {
        path: 'backoffice/gallery/:id',
        component: GalleryEditComponent
    },
    {
        path: 'backoffice/gallery-photo',
        component: GalleryPhotoComponent
    },
    {
        path: 'backoffice/articles',
        component: ArticlesComponent
    },
    {
        path: 'backoffice/article/:id',
        component: ArticleEditComponent
    },
    {
        path: 'backoffice/article/show/:id',
        component: ArticleShowComponent
    }
];

export const routing = RouterModule.forRoot(appRoutes);