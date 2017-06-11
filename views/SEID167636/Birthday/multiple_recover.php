<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBirthday = new \App\Birthday\Birthday();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objBirthday->setData($_GET);
    $objBirthday->recover();
}
Utility::redirect("trashed.php");