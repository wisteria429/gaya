<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/beacon', function() {
    echo 'beaconの登録処理';
});

$app->get('/beacon/:id', function($id) {
    echo 'beacon:'. $id ;
});

$app->get('/beacon/:id/:tap', function($id, $tap) {
    echo 'beacon:'. $id . '<br> tap:' . $tap;
});


$app->get('/sound' ,function() {
    echo '音一覧';
});

$app->run();
