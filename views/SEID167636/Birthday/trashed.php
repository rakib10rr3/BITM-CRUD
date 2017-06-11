<?php
if (!isset($_SESSION)) session_start();
require_once("../../../vendor/autoload.php");
use App\Message\Message;

$msg = Message::getMessage();
$objBirthday = new \App\Birthday\Birthday();
$allData = $objBirthday->trashed();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../resources/jquery-ui/jquery-ui.css">
    <script src="../../../resources/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../resources/index_style.css">
    <link rel="stylesheet" href="../../../resources/simple-confirmation-popup/css/style.css">
    <script src="../../../resources/jquery.js"></script>
    <script src="../../../resources/jquery-ui/jquery-ui.js"></script>
    <style>
        .additional_buttons li {
            display: inline;
            margin-left: 10px;
        }

        .bottom {
            float: right;
        }

        .bottom li {
            display: inline;
            margin-right: 10px;
        }

        ul {
            margin-bottom: 30px;
        }

        input[type="text"] {
            height: 30px;

        }
    </style>
</head>
<body>

<div class="container">
    <div class="main">
        <div>
            <h3>Birthday Information (Trashed)</h3>
            <br>
        </div>

        <div class="text-center" style="height: 35px">
            <?php echo "<div id='message'>$msg</div>" ?>
        </div>

        <ul class="additional_buttons">
            <li>
                <button type="button" class="btn btn-success" value="" id="recoverMultiple"
                        name="recoverMultiple"><span class="glyphicon glyphicon-upload"></span> Recover Multiple
                </button>
            </li>
            <li>
                <button type="button" class="btn btn-danger" value="" id="deleteMultiple"
                        name="deleteMultiple"><span class="glyphicon glyphicon-list"></span><span
                            class="glyphicon glyphicon-remove-circle"></span> Delete Multiple
                </button>
            </li>
        </ul>

        <form id="recoverForm" action="multiple_recover.php" method="post">
            <table class="table table-bordered table-striped text-center">
                <tr>
                    <th class="text-center"><input type="checkbox" name="select_all" id="select_all"> Check All</th>
                    <th class="text-center">Serial</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Birthday</th>
                    <th class="text-center">Action</th>
                </tr>

                <?php
                $serial = 1;
                foreach ($allData as $record) { ?>
                    <tr>
                        <td width="10%"><input style="margin-left: 35px" type="checkbox" class="checkbox"
                                               name="multiple[]" value="<?php echo $record->id; ?>"></td>
                        <td width="10%"><?php echo $serial++; ?></td>
                        <td width="10%"><?php echo $record->id; ?></td>
                        <td width="20%"><?php echo $record->name; ?></td>
                        <td width="20%"><?php echo $record->birthday; ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $record->id; ?>">
                                <button class="btn view">View</button>
                            </a>
                            <a href="recover.php?id=<?php echo $record->id; ?>">
                                <button class="btn btn-success">Recover</button>
                            </a>
                            <a onclick="del(<?php echo $record->id; ?>)">
                                <button type="button" class="btn btn-danger delete"><span
                                            class="glyphicon glyphicon-remove-circle"></span> Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>
        <a href="index.php">
            <button class="btn btn-primary pull-right index">Index</button>
        </a>
    </div>

    <script src="../../../resources/simple-confirmation-popup/js/main.js"></script>
    <script>
        var id;
        var isClicked;
    </script>

    <script>

        $("#recoverMultiple").click(function () {
            $("#recoverForm").submit();

        });

        $('#deleteMultiple').on('click', function (event) {
            event.preventDefault();
            isClicked = "multiple";
            $('.cd-popup').addClass('is-visible');
        });

        $('.delete').on('click', function (event) {
            event.preventDefault();
            isClicked = "single";
            $('.cd-popup').addClass('is-visible');
        });

        function del(sid) {
            id = sid;
        }

        function yes() {
            if (isClicked === "multiple")
                $("#recoverForm").attr("action", "multiple_delete.php").submit();
            if (isClicked === "single")
                location.href = "delete.php?id=" + id;
        }

        function no() {
            $(".cd-popup").removeClass('is-visible');
        }

    </script>

    <div class="cd-popup" role="alert">
        <div class="cd-popup-container">
            <p>Are you sure you want to delete?</p>
            <ul class="cd-buttons">
                <li><a id="yes" href="javascript:yes()">Yes</a></li>
                <li><a id="no" href="javascript:no()">No</a></li>
            </ul>
            <a class="cd-popup-close img-replace">Close</a>
        </div>
    </div>
</div>

<script>

    //select all checkboxes

    $("#select_all").change(function () {  //"select all" change
        var status = this.checked; // "select all" checked status
        $('.checkbox').each(function () { //iterate all listed checkbox items
            this.checked = status; //change ".checkbox" checked status
        });
    });

    $('.checkbox').change(function () { //".checkbox" change
//uncheck "select all", if one of the listed checkbox item is unchecked
        if (this.checked == false) { //if this item is unchecked
            $("#select_all")[0].checked = false; //change "select all" checked status to false
        }

//check "select all" if all checkbox items are checked
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $("#select_all")[0].checked = true; //change "select all" checked status to true
        }
    });
</script>


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
