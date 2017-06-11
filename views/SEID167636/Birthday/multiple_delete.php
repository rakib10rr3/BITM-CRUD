<?php
use App\Utility\Utility;
$path = $_SERVER['HTTP_REFERER'];
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objBirthday->setData($_GET);
    $objBirthday->delete();
}
Utility::redirect($path);