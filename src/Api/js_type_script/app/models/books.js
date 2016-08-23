define(["require", "exports"], function (require, exports) {
    "use strict";
    var Books = (function () {
        function Books() {
            this.booksList = [{
                id: 1,
                name: 'Limes Infer',
                description: 'opis',
                author: 'autor'
            }, {
                id: 2,
                name: 'Robota',
                description: 'opis',
                author: 'autor'
            }, {
                id: 3,
                name: 'Andromeda',
                description: 'opis',
                author: 'autor'
            }, {
                id: 4,
                name: 'Andridanek',
                description: 'opis',
                author: 'autor'
            }, {
                id: 5,
                name: 'Apostrofa',
                description: 'opis',
                author: 'autor'
            }];
        }

        /*    public getData() {
         return this.booksList;
         }*/
        Books.prototype.getData = function () {
            return this.booksList;
        };
        return Books;
    }());
    exports.Books = Books;
});
//# sourceMappingURL=books.js.map