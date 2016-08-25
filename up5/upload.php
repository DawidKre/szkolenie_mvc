<?php

file_put_contents(
    '/var/www/mvc2/up5/uploads/' . getallheaders()['FILENAME'],
    file_get_contents('php://input')
);