define(["require", "exports"], function (require, exports) {
    "use strict";
    var Articles = (function () {
        function Articles() {
            this.articlesList = this.data();
        }

        Articles.prototype.data = function () {
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
        };
        Articles.prototype.getData = function () {
            return this.articlesList;
        };
        Articles.prototype.getList = function (successFunction) {
            var request = $.ajax({
                type: "GET",
                url: '/articles/1/40.json',
                data: {},
                dataType: "json"
            });
            request.done(successFunction);
        };
        Articles.prototype.deleteArticle = function (id) {
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
        };
        Articles.prototype.deleteData = function (id, successFunction) {
            var request = $.ajax({
                type: "DELETE",
                url: '/articles/' + id + '.json',
                dataType: "json"
            });
            request.done(successFunction);
        };
        Articles.prototype.getArticle = function (id, successFunction) {
            var request = $.ajax({
                type: "GET",
                url: '/article/' + id + '.json',
                dataType: "json"
            });
            request.done(successFunction);
        };
        Articles.prototype.updateArticle = function (id, data, successFunction) {
            var request = $.ajax({
                type: "PUT",
                url: '/articles/' + id + '.json',
                dataType: "json",
                data: data
            });
            request.done(successFunction);
        };
        Articles.prototype.newArticle = function (data, successFunction) {
            var request = $.ajax({
                type: "POST",
                url: '/articles.json',
                dataType: "json",
                data: data
            });
            request.done(successFunction);
        };
        return Articles;
    }());
    exports.Articles = Articles;
});
//# sourceMappingURL=articles.js.map