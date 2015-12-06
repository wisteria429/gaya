<?php

class BeaconUtil {
    /**
     * jsonで返す音データの配列を作成する
     */
    public static function getBeaconRow($id, $one, $two, $long) {
        $r = array();
        $r['id'] = (int)$id;
        $r['one'] = $one;
        $r['two'] = $two;
        $r['long'] = $long;

        return $r;
    }

}
