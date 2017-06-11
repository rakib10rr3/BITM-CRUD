<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objGender = new \App\Gender\Gender();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objGender->setData($_GET);
    $objGender->delete();
}
Utility::redirect("index.php");