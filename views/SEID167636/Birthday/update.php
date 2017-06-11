<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$objBirthday->setData($_POST);
$objBirthday->update();
Utility::redirect('index.php');