<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objProfilePicture = new \App\ProfilePicture\ProfilePicture();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objProfilePicture->setData($_GET);
    $objProfilePicture->delete();
}
Utility::redirect("index.php");