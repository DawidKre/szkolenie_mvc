export class Articles {
    private articlesList;

    constructor() {
        this.articlesList = this.data();
    }


    public data() {
        $.ajax({
            url: '/articles/1/40.json',
            type: 'GET',
            dataType: "json",
            success: function (data) {
                return data;
            },
            error: function () {
                alert("Error ");
            }
        });

    }

    public getData() {
        return this.articlesList;
    }

    public getList(successFunction:(data:any) => void):void {
        var request = $.ajax({
            type: "GET",
            url: '/articles/1/40.json',
            data: {},
            dataType: "json"
        });

        request.done(successFunction);
    }

    public deleteArticle(id) {
        $.ajax({
            url: '/articles/' + id + '.json',
            type: 'DELETE',
            success: function () {
                return true;
            },
            error: function () {
                alert("Error ");
                return false;
            }
        });
    }

    public deleteData(id, successFunction:(data:any) => void):void {
        var request = $.ajax({
            type: "DELETE",
            url: '/articles/' + id + '.json',
            dataType: "json"
        });

        request.done(successFunction);
    }

    public getArticle(id, successFunction:(data:any) => void):void {
        var request = $.ajax({
            type: "GET",
            url: '/article/' + id + '.json',
            dataType: "json"
        });

        request.done(successFunction);
    }

    public updateArticle(id, data, successFunction:(data:any) => void):void {
        var request = $.ajax({
            type: "PUT",
            url: '/articles/' + id + '.json',
            dataType: "json",
            data: data,
        });

        request.done(successFunction);
    }

    public newArticle(data, successFunction:(data:any) => void):void {
        var request = $.ajax({
            type: "POST",
            url: '/articles.json',
            dataType: "json",
            data: data,
        });

        request.done(successFunction);
    }


}