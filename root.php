<?php
require_once 'vendor/autoload.php';
require_once 'controller/BaseController.php';
require_once 'controller/BeaconIndexController.php';
require_once 'controller/BeaconIdController.php';
require_once 'controller/BeaconTapController.php';
require_once 'controller/SoundIndexController.php';
require_once 'model/BaseDbModel.php';
require_once 'model/SoundModel.php';
require_once 'model/BeaconModel.php';
require_once 'util/SoundUtil.php';



$app = new \Slim\Slim();
//レスポンスはすべてJSONなのでここで指定
$app->response->headers->set('Content-Type', 'application/json; charset=utf-8');

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


$app->get('/sound' ,function() use($app) {
    $c = new SoundIndexController($app);
    $c->exec();
});

$app->run();
