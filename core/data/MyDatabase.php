<?php
require 'DataBase.class.php';
class MyDatabase extends DataBase{
    public function __construct() {
        $config = array();
        $config[parent::HOST] = 'localhost';
        $config[parent::DATABASE] = 'test';
        $config[parent::USER] = 'root';
        $config[parent::PASSWORD] = '';
        parent::__construct($config);
    }
}
