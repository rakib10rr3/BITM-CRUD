<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objHobbies = new \App\Hobbies\Hobbies();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objHobbies->setData($_GET);
    $objHobbies->trash();
}
Utility::redirect("index.php");