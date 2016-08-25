import {Component, OnInit, OnDestroy} from '@angular/core';
import {Router, ActivatedRoute} from '@angular/router';
import {Gallery} from './gallery';
import {Photo} from './photo';
import {GalleriesService} from './galleries.service';


@Component({
    selector: 'my-app',
    templateUrl: 'app/galleries/gallery-photo.component.html',
    providers: [GalleriesService]
})

export class GalleryPhotoComponent implements OnInit, OnDestroy {
    ngOnInit():void {
    }

    ngOnDestroy():void {
    }

    gallery:Gallery;
    statusList:Array<Object>;
    photo:Photo;
    sub:any;
    filesToUpload:Array<File>;

    constructor(private router:Router,
                private route:ActivatedRoute,
                private galleriesService:GalleriesService) {

        this.gallery = {
            gal_id: 0,
            gal_name: ''
        };
        this.filesToUpload = [];
    }


}