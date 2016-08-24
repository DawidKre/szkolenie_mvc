import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Gallery} from './gallery';
import {GalleriesService} from './galleries.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/galleries/gallery-edit.component.html',
    providers: [GalleriesService]
})

export class GalleryEditComponent implements OnInit, OnDestroy {

    gallery:Gallery;
    statusList:Array<Object>;
    sub:any;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private galleriesService:GalleriesService) {

        this.gallery = {
            gal_id: 0,
            gal_name: ''
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
                this.galleriesService.getGallery(id)
                    .subscribe(
                        gallery => {
                            this.gallery = gallery.gallery;
                        },
                        error => console.log('onError: %s', error)
                    );
            }
        });
    }

    ngOnDestroy() {
        this.sub.unsubscribe();
    }

    saveGallery() {
        this.galleriesService.saveGallery(this.gallery)
            .subscribe(
                () => {
                    this.router.navigate(['/backoffice/galleries'])
                },
                error => console.log('onError: %s', error)
            );
    }

    backToGalleries() {
        this.router.navigate(['/backoffice/galleries'])
    }
}