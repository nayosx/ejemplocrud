<?php
session_start();
session_destroy();
require_once '../core/data/TestDB.class.php';
$db = TestDB::getInstance();
$db->close();
unset($_SESSION['valid']);
header('Location: ../');
die();