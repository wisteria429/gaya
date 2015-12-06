<?php

class SoundIndexController extends BaseController {

    function __construct($app) {
        parent::__construct($app);
    }

    function get() {
        $model = new SoundModel();
        $results = $model->getSounds();

        $response = array('sounds' => array());
        foreach ($results as $row) {
            $response['sounds'][] = SoundUtil::getSoundRow($row['id'], $row['title'], $row['file_name']);
        }
        echo json_encode($response);
        
/* モック用
        $json = <<<JSON
{
  "sounds":[
    {
      "id":1,
      "title":"拍手",
      "file_name":"bbb"
    },
    {
      "id":2,
      "title":"拍手2",
      "file_name":"ccc"
    },
    {
      "id":3,
      "title":"笑い",
      "file_name":"aaa"
    },
    {
      "id":4,
      "title":"笑い2",
      "file_name":"ddd"
    }
  ]
}
JSON;
        echo $json;
*/
    }

    function post() {
        $this->app->response->setStatus(405);
    }

}
