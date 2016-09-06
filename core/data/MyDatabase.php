<?php
/**
 * Description of MyDatabase
 *
 * @author nayosx
 */
require 'DataBase.class.php';
class MyDatabase extends DataBase{
    //put your code here
    public function __construct() {
        $config = array();
        $config[parent::HOST] = 'localhost';
        $config[parent::DATABASE] = 'test';
        $config[parent::USER] = 'root';
        $config[parent::PASSWORD] = '';
        parent::__construct($config);
    }
}
