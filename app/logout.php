<?php
session_start();
session_destroy();
require_once '../core/data/MyDatabase.php';
$db = MyDatabase::getInstance();
$db->close();
unset($_SESSION['valid']);
header('Location: ../');
die();