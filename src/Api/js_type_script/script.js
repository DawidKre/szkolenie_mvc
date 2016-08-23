/*document.addEventListener("DOMContentLoaded", function(event) {

 // var element = document.querySelector('#element');
 // element.innerHTML = 'dawdssssda';

 // var buttons = document.querySelectorAll('.btn');
 // for (var i = 0, len = buttons.length; i < len; i++) {
 //     buttons[i].addEventListener.('click',function(){
 //         this.style = 'color:red;';
 //     });
 // }

 var buttons = document.querySelectorAll('.btn');

 document.querySelector('#element').innerHTML = 'Mysza';

 var color = function(obj, delay) {

 window.setTimeout(function(){
 obj.style = 'color:green;font-weight:bold;font-size:22px;';
 }, delay);

 };

 document.querySelector('#element').addEventListener('mouseout',function(){

 //console.log(123);

 var buttons = document.querySelectorAll('.btn');

 var delay = 300;

 for (var i = 0, len = buttons.length; i < len; i++) {
 color(buttons[i], delay*i);
 }

 });

 });*/

$(document).ready(function () {
    var table = $('.table');
    var newAction = $('.newAction');
    $.get('/articles/1/40.json', function (response) {
        function showTable() {

            $.each(response.articles, function (key, value) {

                var tr = $('<tr></tr>');
                var ul = $('<ul></ul>');
                var artId = $('<td>' + value.art_id + '</td>');
                var artTitle = $('<td>' + value.art_title + '</td>');
                var artBody = $('<td>' + value.art_body + '</td>');
                var catName = $('<td>' + value.cat_name + '</td>');
                var galName = $('<td>' + value.gal_name + '</td>');
                var usrName = $('<td>' + value.usr_name + '</td>');
                var deleteBtn = $('<div class="btn btn-danger btn-sm deleteAction" id="delete" art_id="' + value.art_id + '">Usuń</div>');
                var editBtn = $('<div class="btn btn-info btn-sm editAction" id="" art_id="' + value.art_id + '">Edytuj</div>');

                table.append(tr);
                tr.append(artId);
                tr.append(artTitle);
                tr.append(artBody);
                tr.append(catName);
                tr.append(galName);
                tr.append(usrName);
                tr.append(deleteBtn);
                tr.append(editBtn);
            });
        }

        showTable();

        table.find('.deleteAction').click(function () {
            var id = ($(this).attr('art_id'));
            var tr = $(this).closest('tr');
            var table = $(this).closest('table');
            $.ajax({
                url: '/articles/' + id + '.json',
                type: 'DELETE',
                success: function () {
                    tr.remove();
                },
                error: function () {
                    alert("Error ");
                }
            });
        });
        table.find('.editAction').click(function () {
            var id = ($(this).attr('art_id'));
            var tr = $('<tr></tr>');
            var form = $('<form></form>');
            $.ajax({
                url: '/article/' + id + '.json',
                type: 'GET',
                success: function (data) {
                    var form = $('.hid_form');
                    var input = form.find('input');
                    var btn = form.find('.saveAction');
                    form.css({
                        display: ''
                    });

                    $(input[0]).val(data.article.art_id);
                    $(input[1]).val(data.article.art_title);
                    $(input[2]).val(data.article.art_body);
                    $(input[3]).val(data.article.art_cat_name);
                    $(input[4]).val(data.article.art_gal_name);
                    $(input[5]).val(data.article.art_usr_name);
                    $(btn).attr('art_id', data.article.art_id);

                },
                error: function () {
                    alert("Error ");
                }
            });
        });
        table.find('.saveAction').click(function () {
            var tr = $(this).closest('tr');
            var id = ($(this).attr('art_id'));
            var table = $(this).closest('table');
            var form = $('.hid_form');
            var data = form.find('form');
            var input = form.find('input');


            $.ajax({
                url: '/articles/' + id + '.json',
                type: 'PUT',
                data: data.serialize(),
                dataType: "json",
                success: function () {
                    // alert('Udało się');
                    form.css({
                        display: 'none'
                    });
                    table.closest('tbody').remove();
                    showTable();

                },
                error: function () {
                    alert("Error ");
                }
            });
        });
        newAction.click(function () {
            var form = $('.hid_new_form');
            var input = form.find('input');

            console.log(this);
            form.toggle({
                display: ''
            });
        });

        table.find('.newAction').click(function () {
            var tr = $(this).closest('tr');
            var form = $('.hid_new_form');
            //var data = form.find('#newAction');
            var input = form.find('input');
            console.log(input);

            var art_id = input[0].value;
            var art_title = input[1].value;
            var art_body = input[2].value;
            var cat_name = input[3].value;
            var gal_name = input[4].value;
            var usr_name = input[5].value;

            var data = {
                art_title: art_title,
                art_slug: art_title,
                art_status: 1,
                art_date: 10,
                art_body: art_body,
                art_cat_id: 2,
                galleries_gal_id: 1,
                art_usr_id: 1
            };
            console.log(data);
            $.ajax({
                url: '/articles.json',
                type: 'POST',
                data: data,
                dataType: "json",
                success: function () {
                    alert('Udało się');
                    form.css({
                        display: 'none'
                    });
                    table.closest('tbody').remove();
                    showTable();

                },
                error: function () {
                    alert("Error ");
                }
            });
        });
    }, 'json');


});


/*strVar = 'czesc';

 intVar = 123;

 floVar = 1.2;

 arrVar = [1,2,3,4];

 arrVar2 = [['text'],['sdf'],['sfdg'],['texwerwert']];

 jsonVar = {
 'name' : 'Krzysiek',
 'age' : 100,
 'desc' : 'bla bla bla'
 };

 arrJsonVar = [jsonVar,jsonVar,jsonVar,jsonVar];

 arrJsonVar2 = [
 {'name' : 'Jurek', 'age' : 100, 'desc' : 'asd'},
 {'name' : 'Jurek', 'age' : 100, 'desc' : 'asd'},
 {'name' : 'Jurek', 'age' : 100, 'desc' : 'asd'},
 {'name' : 'Jurek', 'age' : 100, 'desc' : 'asd'}
 ];*/

/*
 console.log(strVar);
 console.log(intVar);
 console.log(floVar);
 console.log(arrVar);
 console.log(arrVar2);
 console.log(jsonVar);
 console.log(arrJsonVar);
 console.log(arrJsonVar2);*/

/*arrVar2.forEach (function(value, key) {
 console.log(value[0]);
 });*/

/*
 for (i = 0, len = arrVar2.length; i < len; i++) {
 console.log(arrVar2[i][0]);
 }*/

/*
 var someString = new String("czesc");
 console.log(someString.toString());

 if (someString.length > arrJsonVar.length) {
 console.log('Wieksze');
 } else {
 console.log('Mniejsze');
 }*/

/*
 for (i in arrVar2) {
 console.log(arrVar2[i][0]);
 }


 Array.prototype.numerNaBagiety = 997;

 var a = [1, 2, 3, 4, 5];

 console.info('for');
 for (var i = 0; i < a.length; i++) {
 console.log(a[i]);
 }

 console.info('for in');

 for (var x in a){
 console.log(a[x]);
 }*/

/*
 function test() {
 var someInt = 12345;
 }

 test();

 console.log(someInt)*/

/*
 var User = function() {
 this.userName = 'Stefciu';

 var inst = this;

 return {
 getUserName : function() {
 return inst.userName;
 },


 setUserName : function(userName) {
 inst.userName = userName;
 }
 }

 };

 var someObj = new User();

 someObj.userName = 'dddddddddd';

 console.log( someObj.getUserName() );

 someObj.setUserName('Alex');

 console.log( someObj.getUserName() );*/


/*
 var User = {
 name : '',
 desc : '',

 setName : function(name) {
 this.name = name;
 }
 };

 User.setName('sdfsdf');

 User.name = 'aaaaaaaaaa';

 console.log(User.name);*/


