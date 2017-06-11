<?php
use App\Utility\Utility;

require_once("../../../vendor/autoload.php");
$objOrganization = new \App\Organization\Organization();
$objOrganization->setData($_POST);
$objOrganization->store();
Utility::redirect('index.php');