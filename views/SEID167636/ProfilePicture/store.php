<?php
use App\Utility\Utility;
require_once("../../../vendor/autoload.php");
$objProfilePicture = new \App\ProfilePicture\ProfilePicture();
$fileName = time() . $_FILES["profilePicture"]["name"];
$source = $_FILES["profilePicture"]["tmp_name"];
$destination = "images/" . $fileName;
move_uploaded_file($source, $destination);
$_POST["profilePicture"] = $fileName;
$objProfilePicture->setData($_POST);
$objProfilePicture->store();
Utility::redirect('index.php');
