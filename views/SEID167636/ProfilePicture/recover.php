<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objProfilePicture = new \App\ProfilePicture\ProfilePicture();
$objProfilePicture->setData($_GET);
$objProfilePicture->recover();
Utility::redirect('trashed.php');