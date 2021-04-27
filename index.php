<?php
namespace app;

session_start();
require_once('./vendor/connect.php');
require_once('./mvc/Dispatcher.php');

require_once('./controllers/IndexController.php');
require_once('./controllers/AdminController.php');

use mvc\Dispatcher;

(new Dispatcher())
    ->routing('/home', function($params) {
        (new IndexController())->index($params);
    })
    ->routing('/sort', function($params) {
        (new IndexController())->sort($params);
    })
    ->routing('/login', function($params) {
        (new AdminController())->login($params);
    })
    ->routing('/admin', function($params) {
        (new AdminController())->articles($params);
    })
    ->routing('POST /send', function($params) {
        (new AdminController())->send($params);
    })
    ->routing('/logout', function($params) {
        (new AdminController())->logout($params);
    })
    ->routing('/destroy', function($params) {
        (new AdminController())->destroy($params);
    })
    ->routing('POST /update', function($params) {
        (new AdminController())->update($params);
    })
    ->routing('POST /store', function($params) {
        (new IndexController())->store($params);
    })
    ->dispatch();
