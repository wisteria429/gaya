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
        if ($this->tap != self::ONE_TAP 
            && $this->tap != self::TWO_TAP 
            && $this->tap != self::LONG_TAP ) {
            //タップの種類が想定以外のものの場合は400を返す
            $this->app->response->setStatus(400);
            return;
        }

        $beaconM = new BeaconModel();
        $soundM = new SoundModel();

        //beaconの一覧を取得
        $beacons = $beaconM->getBeacons(array($this->id));
        

        $beacon = $beacons[0];

        $sound_id;
        if ($this->tap === self::ONE_TAP) {
            $sound_id = $beacon['one_sound'];
        } else if ($this->tap === self::TWO_TAP) {
            $sound_id = $beacon['two_sound'];
        } else if ($this->tap === self::LONG_TAP) {
            $sound_id = $beacon['long_sound'];
        }

        $sounds = $soundM->getSounds(array($sound_id));
        $sound = $sounds[0];
        $sound = SoundUtil::getSoundRow($sound['id'], $sound['title'], $sound['file_name']);

        echo json_encode($sound);
        


/*
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

*/
    }

    function post() {
        $sound_id = $this->app->request->post('sound_id');
        if ($this->tap != self::ONE_TAP 
            && $this->tap != self::TWO_TAP 
            && $this->tap != self::LONG_TAP) {
            //タップの種類が想定以外のものの場合は400を返す
            $this->app->response->setStatus(400);
            return;
        }

        if (empty($sound_id)) {
            $this->app->response->setStatus(400);
        } 

        $model = new BeaconModel();
        $model->updateBeacon($this->id, $this->tap . "_sound", $sound_id);

        echo '{"status": 0}';
    }

}
