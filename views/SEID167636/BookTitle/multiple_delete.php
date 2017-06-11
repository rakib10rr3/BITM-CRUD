<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBookTitle = new \App\BookTitle\BookTitle();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objBookTitle->setData($_GET);
    $objBookTitle->delete();
}
Utility::redirect("index.php");