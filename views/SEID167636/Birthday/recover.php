<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$objBirthday->setData($_GET);
$objBirthday->recover();
Utility::redirect('trashed.php');