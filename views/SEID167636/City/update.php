<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objCity = new \App\City\City();
$objCity->setData($_POST);
$objCity->update();
Utility::redirect('index.php');