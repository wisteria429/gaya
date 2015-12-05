<?php


class BeaconIndexController extends BaseController {

    function __construct($app) {
        parent::__construct($app);
    }

    function get() {
        $json = <<<JSON
{
  "beacons":[
    {
      "id":1,
      "one":{
        "title":"笑い",
        "file_name":"aaa"
      },
      "two":{
        "title":"拍手",
        "file_name":"bbb"
      },
      "long":{
        "title":"拍手2",
        "file_name":"ccc"
      }
    },
    {
      "id":2,
      "one":{
        "title":"笑い",
        "file_name":"aaa"
      },
      "two":{
        "title":"笑い2",
        "file_name":"ddd"
      },
      "long":{
        "title":"拍手2",
        "file_name":"ccc"
      }
    }
  ]
}
JSON;
        echo $json;
    }

    function post() {
        $id = $this->app->request->post('id');
        if (empty($id)) {
            $this->app->response->setStatus(400);
        }
    }
}
