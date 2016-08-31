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
import {PhotosComponent} from "./photo/photos.component";
import {LoginComponent} from "./login/login.component";
import {AuthGuard} from './common/auth.guard';
import {LogoutComponent} from "./login/logout.component";

const appRoutes:Routes = [
    {
        path: 'backoffice/categories',
        component: CategoriesComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/category/:id',
        component: CategoryEditComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/users',
        component: UsersComponent
    },
    {
        path: 'backoffice/user/:id',
        component: UserEditComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/galleries',
        component: GalleriesComponent
    },
    {
        path: 'backoffice/gallery/:id',
        component: GalleryEditComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/gallery-photo',
        component: GalleryPhotoComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/articles',
        component: ArticlesComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/article/:id',
        component: ArticleEditComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/article/show/:id',
        component: ArticleShowComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/photos',
        component: PhotosComponent,
        canActivate: [AuthGuard]
    },
    {
        path: 'backoffice/login',
        component: LoginComponent
    },
    {
        path: 'backoffice/logout',
        component: LogoutComponent
    }

];

export const routing = RouterModule.forRoot(appRoutes);