define(["require", "exports", './models/articles'], function (require, exports, articles) {
    "use strict";
    var App = (function () {
        function App() {
            var _this = this;
            var art = new articles.Articles();
            this.Article = art;
            art.getList(function (result) {
                $('#router-outlet').text('article');
                _this.articlesList = result.articles;
                _this.drawView();
                _this.setFilter();
                _this.deleteAction();
                _this.editAction();
                _this.newAction();
            });
        }

        App.prototype.drawView = function (filtered) {
            var dataSource = (filtered) ? filtered : this.articlesList;
            var listContainer = $('#list');
            listContainer.empty();
            listContainer.append('<input type="button"  class="btn new" id="new" art_id = 26 value="Nowy"><table' +
                ' class="table' +
                ' table-hover"' +
                ' border="1"><tr><th>ID</th><th>Tytuł</th><th>Opis</th><th>Autor</th><th' +
                ' colspan="2">Akcje</th></tr></table>');
            var html = '';
            $.each(dataSource, function (key, value) {
                html += '<tr>' +
                    '<td>' + value.art_id + '</td>' +
                    '<td>' + value.art_title + '</td>' +
                    '<td>' + value.art_body + '</td>' +
                    '<td>' + value.usr_name + '</td>' +
                    '<td><div class="btn btn-danger btn-sm deleteAction" id="delete" art_id="' + value.art_id + '">Usuń</div></td>' +
                    '<td><div class="btn btn-info btn-sm edit" id="edit" art_id="' + value.art_id + '">Edytuj</div></td>' +
                    '</tr>';
            });
            $(html).insertAfter(listContainer.find('tr'));
        };
        App.prototype.setFilter = function () {
            var instance = this;
            $('#filter').keydown(function () {
                var _this = this;
                window.setTimeout(function () {
                    var filtered = instance.articlesList.filter(function (element) {
                        var regExp = new RegExp($(_this).val().toLowerCase());
                        return regExp.test(element.art_title.toLowerCase());
                    });
                    instance.drawView(filtered);
                }, 200);
            });
        };
        App.prototype.deleteAction = function () {
            var table = $('.table');
            var inst = this;
            table.find('.deleteAction').click(function () {
                var id = ($(this).attr('art_id'));
                var tr = $(this).closest('tr');
                inst.Article.deleteData(id, function () {
                    tr.remove();
                });
            });
        };
        App.prototype.editAction = function () {
            var table = $('.table');
            var inst = this;
            table.find('.edit').click(function () {
                var id = ($(this).attr('art_id'));
                var form = $('.hid_form');
                form.css({
                    display: 'block'
                });
                inst.Article.getArticle(id, function (result) {
                    var input = form.find('input');
                    inst.drawForm(result.article);
                });
            });
        };
        /*    private saveAction() {
         var table = $('#edit');
         var inst = this;

         table.find('#button_edit').click(function () {
         var id = ($(this).attr('art_id'));
         var table = $(this).closest('table');
         var form = $('.hid_form');
         var data = form.find('form');
         alert("das");
         inst.Article.updateArticle(id, data, function () {
         form.css({
         display: 'none'
         });
         table.closest('tbody').remove();

         })
         });

         }*/
        App.prototype.drawForm = function (data) {
            var html = '<form id="edit">';
            for (var a in data) {
                html += '<label style="width: 180px;">' + a + '</label><input type="text" name="' + a + '" value="' + data[a] + '"><br>';
            }
            html += '<input type="button" id="button_edit" value="send" art_id = "' + data.art_id + '">';
            html += '</form>';
            var form = $('#hid_form');
            form.empty();
            form.append(html);
            var table = $('#edit');
            var inst = this;
            form.find('#button_edit').click(function () {
                var id = ($(this).attr('art_id'));
                var table = $(this).closest('table');
                var form = $('.hid_form');
                var data = form.find('form');
                inst.Article.updateArticle(id, data.serialize(), function () {
                    form.css({
                        display: 'none'
                    });
                    table.closest('tbody').remove();
                });
            });
        };
        App.prototype.drawemptyForm = function (data) {
            var html = '<form id="new">';
            for (var a in data) {
                html += '<label style="width: 180px;">' + a + '</label><input type="text" name="' + a + '"><br>';
            }
            html += '<input type="button" class="button_new" id="button_new"  value="Nowy">';
            html += '</form>';
            var form = $('#hid_form');
            form.empty();
            form.append(html);
            var table = $('#new');
            var inst = this;
            form.find('#button_new').click(function () {
                var table = $(this).closest('table');
                var form = $('.hid_form');
                var data = form.find('form');
                inst.Article.newArticle(data.serialize(), function () {
                    form.css({
                        display: 'none'
                    });
                    table.closest('tbody').remove();
                });
            });
        };
        App.prototype.newAction = function () {
            var table = $('.new');
            var inst = this;
            table.click(function () {
                var id = ($(this).attr('art_id'));
                var form = $('.hid_form');
                form.css({
                    display: 'block'
                });
                inst.Article.getArticle(id, function (result) {
                    var input = form.find('input');
                    inst.drawemptyForm(result.article);
                });
            });
        };
        return App;
    }());
    exports.App = App;
});
//# sourceMappingURL=app.js.map