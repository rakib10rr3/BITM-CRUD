<?php
use App\Utility\Utility;

require_once ("../../../vendor/autoload.php");
$objHobbies = new \App\Hobbies\Hobbies();
$objHobbies->setData($_POST);

$objHobbies->store();
Utility::redirect('create.php');