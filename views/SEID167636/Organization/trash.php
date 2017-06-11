<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objOrganization = new \App\Organization\Organization();
$objOrganization->setData($_GET);
$objOrganization->trash();
Utility::redirect("index.php");