import {Component, OnInit} from '@angular/core';

@Component({
    templateUrl: 'app/photo/photos.component.html',

})

export class PhotosComponent implements OnInit {
    data: any;
    filesToUpload: Array<File>;

    constructor() {
        this.filesToUpload = [];
    }


    upload() {
        console.log('upload button clicked');

        this.makeFileRequest("http://mvc.pl/photos.json", [], this.filesToUpload).then((result) => {
            console.log(result);
        }, (error) => {
            console.error(error);
        });
    }

    fileChangeEvent(fileInput: any) {
        this.filesToUpload = <Array<File>> fileInput.target.files;
    }

    makeFileRequest(url: string, params: Array<string>, files: Array<File>) {
        return new Promise((resolve, reject) => {
            var formData: any = new FormData();
            var xhr = new XMLHttpRequest();
            for (var i = 0; i < files.length; i++) {

                formData.append("file[]", files[i], files[i].name);
            }
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        resolve(JSON.parse(xhr.response));
                    } else {
                        reject(xhr.response);
                    }
                }
            };

            xhr.open("POST", url, true);
            xhr.send(formData);


        });
    }

    id(id) {
        return document.getElementById(id);
    }

    Output(msg) {
        var m = this.id("messages");
        m.innerHTML = msg + m.innerHTML;
    }

    FileDragHover(e) {
        e.stopPropagation();
        e.preventDefault();
        e.target.className = (e.type == "dragover" ? "hover" : "");
    }

    FileSelectHandler(e) {

        this.FileDragHover(e);

        // fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // process all File objects
        for (var i = 0, f; f = files[i]; i++) {
            this.ParseFile(f);
            this.upload();
        }

    }

    ParseFile(file) {

        this.Output(
            "<p>File information: <strong>" + file.name +
            "</strong> type: <strong>" + file.type +
            "</strong> size: <strong>" + file.size +
            "</strong> bytes</p>"
        );

        // display an image
        if (file.type.indexOf("image") == 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                this.Output(
                    "<p><strong>" + file.name + ":</strong><br />" +
                    '<img src="' + +'" width="200" /></p>'
                );
            }
            reader.readAsDataURL(file);
        }

        // display text
        if (file.type.indexOf("text") == 0) {
            var reader = new FileReader();
            reader.onload = function (e) {
                this.Output(
                    "<p><strong>" + file.name + ":</strong></p><pre>" + +
                        "</pre>"
                );
            }
            reader.readAsText(file);
        }
    }
    ngOnInit() {

    }
}    