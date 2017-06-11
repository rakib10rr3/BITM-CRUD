<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objHobbies = new \App\Hobbies\Hobbies();
$objHobbies->setData($_GET);
$objHobbies->trash();
Utility::redirect("index.php");