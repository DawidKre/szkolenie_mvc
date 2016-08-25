import {Component} from '@angular/core';
import {Router} from '@angular/router';
import {NgModel} from "@angular/common";

import {Gallery} from './gallery';
import {GalleriesService} from './galleries.service';
import {PaginationDirective} from "../directives/pagination.directive";

@Component({
    templateUrl: 'app/galleries/galleries.component.html',
    providers: [GalleriesService, PaginationDirective, NgModel]
})

export class GalleriesComponent {

    galleries:Array<Gallery>;
    gallery:Array<Gallery>;
    public currentPage:number = 1;
    public totalItems = 0;
    public maxSize:number = 5;

    constructor(private galleriesService:GalleriesService,
                private router:Router) {
        this.getGalleries();

    }

    getGalleries() {
        this.galleriesService.getGalleries(this.currentPage)
            .subscribe(
                galleries => {
                    this.galleries = galleries.galleries;
                    this.totalItems = galleries.count;
                },
                error => console.log('onError: %s', error)
            );
    }

    getGallery(id) {
        this.galleriesService.getGallery(id)
            .subscribe(
                gallery => {
                    this.gallery = gallery;
                },
                error => console.log('onError: %s', error)
            );
    }

    editGallery(gallery) {
        if (gallery) {
            this.router.navigate(['/backoffice/gallery/' + gallery.gal_id]);
        } else {
            this.router.navigate(['/backoffice/gallery/0']);
        }
    }

    deleteGallery(gallery) {
        this.galleriesService.deleteGallery(gallery.gal_id)
            .subscribe(
                result => this.getGalleries(),
                error => alert('onError: %s' + error)
            );
    }

    public pageChanged():void {
        this.getGalleries();
    };


}