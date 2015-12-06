<?php

class BeaconIdController extends BaseController {
    private $id;
    function __construct($app, $id) {
        parent::__construct($app);
        $this->id = $id;
    }

    function get() {
        $beaconM = new BeaconModel();
        $soundM = new SoundModel();

        //beaconの一覧を取得
        $beacons = $beaconM->getBeacons(array($this->id));
        
        $sound_ids = array();

        $beacon = $beacons[0];
        //音データを取得するためにはいれつを作成
        $sound_ids[] = $beacon['one_sound'];
        $sound_ids[] = $beacon['two_sound'];
        $sound_ids[] = $beacon['long_sound'];

        $sound_ids = array_values(array_unique($sound_ids));
        //sound_idsを元に音データを取得
        $sounds = SoundUtil::createSoundDict($soundM->getSounds($sound_ids));

        $response = BeaconUtil::getBeaconRow(
                            $beacon['id'], 
                            $sounds[$beacon['one_sound']],
                            $sounds[$beacon['two_sound']],
                            $sounds[$beacon['long_sound']]
        );

        echo json_encode($response);



/*
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
*/
    }

    function post() {
        $this->app->response->setStatus(405);
    }

}
