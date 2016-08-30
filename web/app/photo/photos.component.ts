import {Component} from '@angular/core';


@Component({
    templateUrl: 'app/photo/photos.component.html',
    directives: []
})

export class PhotosComponent {

    filesToUpload: Array<File>;

    constructor() {
        this.filesToUpload = [];
    }

    /*    upload() {
     this.makeFileRequest("http://mvc.pl/photos.json", [], this.filesToUpload).then((result) => {
     console.log(result);
     }, (error) => {
     console.error(error);
     });
     }

     fileChangeEvent(fileInput: any){
     this.filesToUpload = <Array<File>> fileInput.target.files;
     }

     makeFileRequest(url: string, params: Array<string>, files: Array<File>) {
     return new Promise((resolve, reject) => {
     var formData: any = new FormData();
     var xhr = new XMLHttpRequest();
     for(var i = 0; i < files.length; i++) {
     formData = files[i];
     console.log(files);
     }
     xhr.onreadystatechange = function () {
     if (xhr.readyState == 4) {
     if (xhr.status == 200) {
     resolve(JSON.parse(xhr.response));
     } else {
     reject(xhr.response);
     }
     }
     }

     xhr.open("POST", url, true);
     xhr.send(formData);
     });
     }*/
    saveFile(file: File): Promise {
        return new Promise((resolve, reject) => {
            let xhr: XMLHttpRequest = new XMLHttpRequest();
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        resolve(xhr.response);
                    } else {
                        reject(xhr.response);
                    }
                }
            };

            xhr.open('POST', 'http://mvc.pl/photos.json', true);

            let formData = new FormData();
            formData.append("file", file, file.name);
            console.log(formData);
            xhr.send(formData);
        });
    }

    changeListener(e) {
        var files = e.target.files || e.dataTransfer.files;

        for (var i = 0, file; file = files[i]; i++) {
            this.saveFile(file)
                .then(
                    r => console.log(r),
                    e => console.error('error: ', e)
                )
        }
    }

}