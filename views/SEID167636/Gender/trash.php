<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objGender = new \App\Gender\Gender();
$objGender->setData($_GET);
$objGender->trash();
Utility::redirect("index.php");