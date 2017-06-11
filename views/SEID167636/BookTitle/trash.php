<?php
use App\Utility\Utility;
require_once ("../../../vendor/autoload.php");
$objBookTitle = new \App\BookTitle\BookTitle();
$objBookTitle->setData($_GET);
$objBookTitle->trash();
Utility::redirect("index.php");