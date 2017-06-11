<?php
use App\Utility\Utility;
$path = $_SERVER['HTTP_REFERER'];
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$objBirthday->setData($_GET);
$objBirthday->delete();
Utility::redirect($path);