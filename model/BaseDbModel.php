<?php

class BaseDbModel {
    protected $dbh;

    function __construct() {
        try {
            $config=parse_ini_file('./config.ini');
            $this->dbh = new PDO('mysql:host=localhost;dbname=gaya', $config['user'], $config['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            error_log('db connect error : ' . $e->getMessage());
        }
    }

    function __destruct() {
        $this->dbh = null;
    }
}
