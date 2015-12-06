<?php

class BeaconModel extends BaseDbModel {
    function __construct() {
        parent::__construct();
    }

    function getBeacons($ids = null) {
        $sql = 'SELECT id, one_sound, two_sound, long_sound FROM beacons';

        if (!is_null($ids) && is_array($ids)) {
            $sql .= " WHERE id IN(". implode(',' , $ids) . ")";
        }

        $query  = $this->dbh->query($sql);
        $results = $query->fetchAll();

        return $results;
    }

    function insertBeacon($id, $one, $two, $long) {
        $sql = "INSERT INTO beacons VALUES(:ID, :ONE, :TWO, :LONG);";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':ID',   $id,   PDO::PARAM_INT);
        $sth->bindParam(':ONE',  $one,  PDO::PARAM_INT);
        $sth->bindParam(':TWO',  $two,  PDO::PARAM_INT);
        $sth->bindParam(':LONG', $long, PDO::PARAM_INT);
        $sth->execute();
    }


    function __destruct() {
        parent::__destruct();
    }


}
