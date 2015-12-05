<?php

class BeaconIdController extends BaseController {
    private $id;
    function __construct($app, $id) {
        parent::__construct($app);
        $this->id = $id;
    }

    function get() {
        $json = <<<JSON
{
    "id":2,
    "one":{
        "id":3,
        "title":"笑い",
        "file_name":"aaa"
    },
    "two":{
        "id":4,
        "title":"笑い2",
        "file_name":"ddd"
    },
    "long":{
        "id":1
        "title":"拍手2",
        "file_name":"ccc"
    }
}
JSON;
        echo $json;
    }

    function post() {
        $this->app->response->setStatus(405);
    }

}
