<?php
//var_dump($_POST);
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$objBirthday->setData($_POST);
$objBirthday->store();
Utility::redirect('index.php');