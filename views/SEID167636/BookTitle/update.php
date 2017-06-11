<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBookTitle = new App\BookTitle\BookTitle();
$objBookTitle->setData($_POST);
$objBookTitle->update();
Utility::redirect('index.php');