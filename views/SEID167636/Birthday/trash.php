<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$objBirthday->setData($_GET);
$objBirthday->trash();
Utility::redirect("index.php");