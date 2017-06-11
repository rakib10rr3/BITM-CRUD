<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objCity = new \App\City\City();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objCity->setData($_GET);
    $objCity->trash();
}
Utility::redirect("index.php");