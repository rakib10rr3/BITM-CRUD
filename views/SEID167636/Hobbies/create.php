<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 5/29/2017
 * Time: 11:14 AM
 */
if (!isset($_SESSION)) session_start();
require_once("../../../vendor/autoload.php");
use App\Message\Message;

$msg = Message::getMessage();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hobbies</title>
    <link rel="stylesheet" href="../../../resources/bootstrap/css/bootstrap.min.css">
    <script src="../../../resources/bootstrap/js/bootstrap.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        form {
            width: 700px;
            padding: 20px;
            background-color: whitesmoke;
            border-radius: 0 0 15px 15px;
            margin: 0 auto;
        }

        h3 {
            background-color: #2a9fb4;
            color: #ffffff;
            padding: 10px 0;
            margin: 0 auto;
            border-radius: 10px 10px 0 0;
            width: 700px;
        }

        #message {
            width: 700px;
            text-align: center;
            margin: 0 auto;
            display: none;

        }

        .formInfo {
            margin: 0 auto;
            border: 1px solid #2a9fb4;
            width: 702px;
            box-shadow: 0 0 2px;
            border-radius: 12px 12px 15px 15px;
        }
        .main{
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="main">
        <?php echo"<div id='message'> $msg</div>"?>
        <div class="formInfo">
            <h3 align="center">Hobbies Information Entry</h3>
            <form action="store.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hobbies">Your Hobbies</label>
                    <div class="checkbox">
                        <label><input type="checkbox" value="gaming" name="hobbies[]" id="hobbies">Gaming</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="reading" name="hobbies[]" id="hobbies">Reading</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="gardening" name="hobbies[]" id="hobbies">Gardening</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="cooking" name="hobbies[]" id="hobbies">Cooking</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="music" name="hobbies[]" id="hobbies">Music</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="painting" name="hobbies[]" id="hobbies">Painting</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="photography" name="hobbies[]"
                                      id="hobbies">Photography</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="traveling" name="hobbies[]" id="hobbies">Traveling</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="sleeping" name="hobbies[]" id="hobbies">Sleeping</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="sports" name="hobbies[]" id="hobbies">Sports</label>
                    </div>
                </div>
                <div class="form-group button">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../../../resources/jquery.js"></script>

<script>


    $(
        function ($) {
            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
            $('#message').fadeIn(550);
            $('#message').fadeOut(550);
        }
    )
</script>
</body>
</html>
