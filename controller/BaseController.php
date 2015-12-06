<?php


abstract class BaseController {
    protected $app;

    function __construct($app) {
        $this->app = $app;
    }

    function exec() {
        $method =  $this->app->request()->getMethod();
        if ($method === 'GET') {
            $this->get();
        } else if ($method === 'POST') {
            $this->post();
        }

    }

    abstract function get();
    abstract function post();

}
