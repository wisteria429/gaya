<?php

class SoundModel extends BaseDbModel {
    
    function __construct() {
        parent::__construct();
    }

    function getSounds($ids = null) {
        $sql = 'SELECT id, title, file_name FROM sounds';

        if (!is_null($ids) && is_array($ids)) {
            $sql .= " WHERE id IN(". implode(',' , $ids) . ")";
        }

        $sql .=";";


        $query  = $this->dbh->query($sql);
        $results = $query->fetchAll();

        return $results;
    }

    function __destruct() {
        parent::__destruct();
    }

}
?>
