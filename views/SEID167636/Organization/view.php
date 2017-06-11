<?php
require_once("../../../vendor/autoload.php");
$objOrganization = new \App\Organization\Organization();
$objOrganization->setData($_GET);
$singleData = $objOrganization->view();
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
    <link rel="stylesheet" href="../../../resources/index_style.css">

</head>
<body>
<div class="container">
    <div class="main">

        <div>
            <h3>Organization Information of <?php echo $singleData->name;?></h3>
            <br>
        </div>
        <table class="table table-bordered table-striped text-center">
            <tr>
                <th class="text-center">id</th>
                <td><?php echo $singleData->id; ?></td>

            </tr>
            <tr>
                <th class="text-center">Name</th>
                <td><?php echo $singleData->name; ?></td>
            </tr>
            <tr>
                <th class="text-center">Organization Name</th>
                <td><?php echo $singleData->organization_name; ?></td>
            </tr>
            <tr>
                <th class="text-center">Organization Summary</th>
                <td><?php echo $singleData->organization_summary; ?></td>
            </tr>
        </table>

    </div>

</div>

<script>
    jQuery(
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