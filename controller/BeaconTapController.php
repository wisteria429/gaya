<?php

class BeaconTapController extends BaseController {
    private $id;
    private $tap;

    const ONE_TAP = 'one';
    const TWO_TAP = 'two';
    const LONG_TAP = 'long';


    function __construct($app, $id, $tap) {
        parent::__construct($app);
        $this->id = $id;
        $this->tap = $tap;
    }

    function get() {
        $jsonOne = <<<JSON
{
    "id":3,
    "title":"笑い",
    "file_name":"aaa"
}
JSON;

        $jsonTwo = <<<JSON
{
    "id":4,
    "title":"笑い2",
    "file_name":"ddd"
}
JSON;
        $jsonLong = <<<JSON
{
    "id":1
    "title":"拍手2",
    "file_name":"ccc"
}
JSON;

        if ($this->tap === self::ONE_TAP) {
            echo $jsonOne;
        } else if ($this->tap === self::TWO_TAP) {
            echo $jsonTwo;
        } else if ($this->tap === self::LONG_TAP) {
            echo $jsonLong;
        } else {
            $this->app->response->setStatus(400);
        }

    }

    function post() {
        $sound_id = $this->app->request->post('sound_id');
        if (empty($sound_id)) {
            $this->app->response->setStatus(400);
        } 
    }

}
