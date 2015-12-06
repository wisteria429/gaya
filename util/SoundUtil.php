<?php

class SoundUtil {
    /**
     * jsonで返す音データの配列を作成する
     */
    public static function getSoundRow($id, $title, $file_name) {
        $r = array();
        $r['id'] = (int)$id;
        $r['title'] = $title;
        $r['file_name'] = $file_name;

        return $r;
    }

    public static function createSoundDict($sounds) {
        $res = array();
        foreach ($sounds as $sound) {
            $res[$sound['id']] = SoundUtil::getSoundRow($sound['id'], $sound['title'], $sound['file_name']);
        }

        return $res;
    }
}
