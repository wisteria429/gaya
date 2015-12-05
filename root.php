<?php
require 'vendor/autoload.php';
require 'controller/BaseController.php';
require 'controller/BeaconIndexController.php';
require 'controller/BeaconIdController.php';
require 'controller/BeaconTapController.php';

$app = new \Slim\Slim();
//レスポンスはすべてJSONなのでここで指定
$app->response->headers->set('Content-Type', 'application/json');

// 各ルーティング処理
$app->map('/beacon', function() use ($app) {
    $c = new BeaconIndexController($app);
    $c->exec();
})->via('GET', 'POST');

$app->get('/beacon/:id', function($id) use ($app){
    $c = new BeaconIdController($app,$id);
    $c->exec();
});


$app->map('/beacon/:id/:tap', function($id, $tap) use($app) {
    $c = new BeaconTapController($app,$id, $tap);
    $c->exec();

})->via('GET', 'POST');


$app->map('/sound' ,function() use($app) {
    echo '音一覧';
});

$app->run();
