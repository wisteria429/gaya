<?php


class BeaconIndexController extends BaseController {

    function __construct($app) {
        parent::__construct($app);
    }

    function get() {
        
        $beaconM = new BeaconModel();
        $soundM = new SoundModel();

        //beaconの一覧を取得
        $beacons = $beaconM->getBeacons();
        
        $sound_ids = array();
        //音データを取得するためにはいれつを作成
        foreach ($beacons as $beacon) {
            $sound_ids[] = $beacon['one_sound'];
            $sound_ids[] = $beacon['two_sound'];
            $sound_ids[] = $beacon['long_sound'];
        }

        $sound_ids = array_values(array_unique($sound_ids));
        //sound_idsを元に音データを取得
        $sounds = SoundUtil::createSoundDict($soundM->getSounds($sound_ids));

        $response = array();
        foreach($beacons as $beacon) {
            $response['beacons'][] = BeaconUtil::getBeaconRow(
                                $beacon['id'], 
                                $sounds[$beacon['one_sound']],
                                $sounds[$beacon['two_sound']],
                                $sounds[$beacon['long_sound']]
            );
        }

        echo json_encode($response);


        
/*
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
*/
    }

    function post() {
        $id = $this->app->request->post('id');
        
        if (empty($id)) {
            //必須なパラメータがなければ400を返して抜ける
            $this->app->response->setStatus(400);
            return ;
        }

        $model = new BeaconModel();
        $model->insertBeacon($id, 1, 2, 3);
        echo '{"status": 0}';
    }
}
