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
    <title>Birthday</title>
    <link rel="stylesheet" href="../../../resources/bootstrap/css/bootstrap.min.css">
    <script src="../../../resources/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        form {
            width: 700px;
            padding: 20px;
            /*border-radius: 0 0 15px 15px;*/
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
            background-color: whitesmoke;
            width: 702px;
            box-shadow: 0 0 2px;
            border-radius: 12px 12px 15px 15px;
        }

        .main {
            margin-top: 50px;
        }
    </style>
    <script>
        $(function () {
            $("#birthday").datepicker({dateFormat: 'yy-mm-dd'});
        });
    </script>
</head>
<body>
<div class="container">
    <div class="main">
        <?php
        if (isset($msg))
            echo $msg;
        ?>
        <div class="formInfo">
            <h3 align="center">Birthday Information Entry</h3>
            <form action="store.php" method="post">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="birthday">Your Birthday</label>
                    <input type="text" name="birthday" id="birthday" class="form-control" placeholder="yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Create">
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    jQuery(
        function($) {
            $('#message').fadeOut (550);
            $('#message').fadeIn (550);
            $('#message').fadeOut (550);
            $('#message').fadeIn (550);
            $('#message').fadeOut (550);
            $('#message').fadeIn (550);
            $('#message').fadeOut (550);
        }
    )
</script>
</body>
</html>
