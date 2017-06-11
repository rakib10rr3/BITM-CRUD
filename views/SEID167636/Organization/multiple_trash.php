<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objOrganization = new \App\Organization\Organization();
$IDs = $_POST['multiple'];
foreach ($IDs as $id)
{
    $_GET['id'] = $id;
    $objOrganization->setData($_GET);
    $objOrganization->trash();
}
Utility::redirect("index.php");