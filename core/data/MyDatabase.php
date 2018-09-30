<?php
require 'DataBase.class.php';
class MyDatabase extends DataBase{
    private static $_instance;

    public function __construct() {
        $config = array();
        $config[parent::HOST] = 'localhost';
        $config[parent::DATABASE] = 'test';
        $config[parent::USER] = 'root';
        $config[parent::PASSWORD] = '';
        parent::__construct($config);
    }

    public static function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
