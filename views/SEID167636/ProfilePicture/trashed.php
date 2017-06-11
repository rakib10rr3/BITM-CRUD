<?php
/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 6/1/2017
 * Time: 11:26 PM
 */
require_once("../../../vendor/autoload.php");
$objProfilePicture = new \App\ProfilePicture\ProfilePicture();
$allData = $objProfilePicture->trashed();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../resources/bootstrap/css/bootstrap.min.css">
    <script src="../../../resources/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../resources/index_style.css">
</head>
<body>

<div class="container">
    <div class="main">
        <div>
            <h3>Profile Picture Information (Trashed)</h3>
            <br>
        </div>
        <table class="table table-bordered table-striped text-center">
            <tr>
                <th class="text-center">Serial</th>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Profile Picture</th>
                <th class="text-center">Action</th>
            </tr>

            <?php
            $serial = 1;
            foreach ($allData as $record) { ?>
                <tr>
                    <td width="5%"><?php echo $serial++; ?></td>
                    <td width="5%"><?php echo $record->id; ?></td>
                    <td width="15%"><?php echo $record->name; ?></td>
                    <td width="15%"><img style="width: 45px;height: 60px" src="images/<?php echo $record->profile_picture;?>"></td>
                    <td width="30%">
                        <a href="view.php?id=<?php echo $record->id;?>">
                            <button class="btn view">View</button>
                        </a>
                        <a href="edit.php?id=<?php echo $record->id;?>">
                            <button class="btn update">Update</button>
                        </a>
                        <a href="recover.php?id=<?php echo $record->id;?>">
                            <button class="btn btn-success">Recover</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="create.php">
            <button class="btn btn-success pull-left create">Create</button>
        </a>
        <a href="index.php">
            <button class="btn btn-primary pull-right index">Index</button>
        </a>

    </div>

</div>

</body>
</html>
