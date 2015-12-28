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
        try {
            $sql = "INSERT INTO beacons VALUES(:ID, :ONE, :TWO, :LONG);";
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':ID',   $id,   PDO::PARAM_INT);
            $sth->bindParam(':ONE',  $one,  PDO::PARAM_INT);
            $sth->bindParam(':TWO',  $two,  PDO::PARAM_INT);
            $sth->bindParam(':LONG', $long, PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
    function deleteBeacon($id) {
        try {
            $sql = "DELETE FROM beacons WHERE id = :ID";
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':ID',   $id,   PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }


    function updateBeacon($id, $tap_type, $sound_id) {
        
        try {
            $sql = "UPDATE beacons SET $tap_type = :SOUND_ID WHERE id = :ID";
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':ID',   $id,   PDO::PARAM_INT);
            $sth->bindParam(':SOUND_ID',  $sound_id,  PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
           
        }
    }


    function __destruct() {
        parent::__destruct();
    }


}
