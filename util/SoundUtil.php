<?php

class SoundUtil {
    public static function getSoundRow($id, $title, $file_name) {
        $r = array();
        $r['id'] = $id;
        $r['title'] = $title;
        $r['file_name'] = $file_name;

        return $r;
    }
}
