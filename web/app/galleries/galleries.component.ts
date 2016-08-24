import {Component} from '@angular/core';
import {Router} from '@angular/router';

import {Gallery} from './gallery';
import {GalleriesService} from './galleries.service';

@Component({
    templateUrl: 'app/galleries/galleries.component.html',
    providers: [GalleriesService]
})

export class GalleriesComponent {

    galleries:Array<Gallery>;
    gallery:Array<Gallery>;

    constructor(private galleriesService:GalleriesService,
                private router:Router) {
        this.getGalleries();

    }

    getGalleries() {
        this.galleriesService.getGalleries(1)
            .subscribe(
                galleries => {
                    this.galleries = galleries.galleries;
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


}