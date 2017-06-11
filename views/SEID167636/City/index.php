<?php
if (!isset($_SESSION)) session_start();

require_once("../../../vendor/autoload.php");
use App\Message\Message;

$msg = Message::getMessage();

$objCity = new \App\City\City();
$allData = $objCity->index();


################## search  block 1 of 5 start ##################
if (isset($_REQUEST['search'])) {
    $someData = $objCity->search($_REQUEST);
}

$availableKeywords = $objCity->getAllKeywords();
$comma_separated_keywords = '"' . implode('","', $availableKeywords) . '"';
################## search  block 1 of 5 end ##################

######################## pagination code block#1 of 2 start ######################################
$recordCount = count($allData);
if (isset($_REQUEST['Page'])) $page = $_REQUEST['Page'];
else if (isset($_SESSION['Page'])) $page = $_SESSION['Page'];
else   $page = 1;
$_SESSION['Page'] = $page;

if (isset($_REQUEST['ItemsPerPage'])) $itemsPerPage = $_REQUEST['ItemsPerPage'];
else if (isset($_SESSION['ItemsPerPage'])) $itemsPerPage = $_SESSION['ItemsPerPage'];
else   $itemsPerPage = 3;
$_SESSION['ItemsPerPage'] = $itemsPerPage;
$pages = ceil($recordCount / $itemsPerPage);

$someData = $objCity->indexPaginator($page, $itemsPerPage);
$allData = $someData;
$serial = (($page - 1) * $itemsPerPage) + 1;
if ($serial < 1) $serial = 1;
####################### pagination code block#1 of 2 end #########################################

################# search  block 2 of 5 start ##################
if (isset($_REQUEST['search'])) {
    $someData = $objCity->search($_REQUEST);
    $serial = 1;
    $allData = $someData;

}
################## search  block 2 of 5 end ################

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

        .bottom_left {
            float: left;
            margin: -32px 0 0 15px;
            display: inline-block;
        }


        .bottom_right{
            margin-right: 10px;
        }

        .bottom_right li {
            float: right;
            display: inline;
            margin-top: 5px;
            margin-right: 3px;

        }

        ul {
            margin-bottom: 35px;
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
            <h3>City Information (Active)</h3>
            <br>
        </div>

        <div class="text-center" style="height: 35px">
            <?php echo "<div id='message'>$msg</div>" ?>
        </div>

        <ul class="additional_buttons">
            <li><button type="button" class="btn btn-warning" value="" id="trashMultiple"
                        name="trashMultiple"><span class="glyphicon glyphicon-trash"></span> Trash Multiple</button></li>
            <li><button type="button" class="btn btn-danger" value="" id="deleteMultiple"
                        name="deleteMultiple"><span class="glyphicon glyphicon-list"></span><span class="glyphicon glyphicon-remove-circle"></span> Delete Multiple</button></li>
            <li><input type="button" class="btn btn-success" value="Downlaod As PDF"></li>
            <li><input type="button" class="btn btn-info" value="Downlaod As Excel"></li>
            <li><input type="button" class="btn btn-primary" value="Email whole record"></li>
            <li style="float: right">
                <form action="index.php" method="get" id="searchForm">
                    <div>
                        <input type="text" name="search" id="searchID" placeholder="search">
                        <input type="checkbox" name="byName" id="byName" checked> By Name
                        <input type="checkbox" name="byCity" id="byCity" checked> By City
                        <input hidden type="submit">
                    </div>
                </form>
            </li>
        </ul>

        <form id="selectionForm" action="multiple_trash.php" method="post">
            <table class="table table-bordered table-striped text-center">
                <tr>
                    <th class="text-center"><input type="checkbox" name="select_all" id="select_all">   Check All</th>
                    <th class="text-center">Serial</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">City</th>
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
                        <td width="15%"><?php echo $record->name; ?></td>
                        <td width="15%"><?php echo $record->city_name; ?></td>
                        <td width="45%">
                            <a href="view.php?id=<?php echo $record->id; ?>">
                                <button type="button" class="btn view "><span class="glyphicon glyphicon-eye-open"></span> View</button>
                            </a>
                            <a href="edit.php?id=<?php echo $record->id; ?>">
                                <button type="button" class="btn update"><span class="glyphicon glyphicon-pencil"></span> Update</button>
                            </a>
                            <a href="trash.php?id=<?php echo $record->id; ?>">
                                <button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Trash</button>
                            </a>
                            <a onclick="del(<?php echo $record->id; ?>)">
                                <button type="button"  class="btn btn-danger delete"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>

        <div class="bottom_left">
            <ul class="pagination">

                <?php
                $pageMinusOne = $page - 1;
                $pagePlusOne = $page + 1;


                if ($page > $pages) \App\Utility\Utility::redirect("index.php?Page=$pages");

                if ($page > 1) echo "<li><a href='index.php?Page=$pageMinusOne'>" . "Previous" . "</a></li>";


                for ($i = 1; $i <= $pages; $i++) {
                    if ($i == $page) echo '<li class="active"><a href="">' . $i . '</a></li>';
                    else  echo "<li><a href='?Page=$i'>" . $i . '</a></li>';

                }
                if ($page < $pages) echo "<li><a href='index.php?Page=$pagePlusOne'>" . "Next" . "</a></li>";

                ?>
                <li>
                    <select class="form-control" name="ItemsPerPage" id="ItemsPerPage" style="margin-bottom: 40px"
                            onchange="javascript:location.href = this.value;">
                        <?php
                        if ($itemsPerPage == 3) echo '<option value="?ItemsPerPage=3" selected >Show 3 Items Per Page</option>';
                        else echo '<option  value="?ItemsPerPage=3">Show 3 Items Per Page</option>';

                        if ($itemsPerPage == 4) echo '<option  value="?ItemsPerPage=4" selected >Show 4 Items Per Page</option>';
                        else  echo '<option  value="?ItemsPerPage=4">Show 4 Items Per Page</option>';

                        if ($itemsPerPage == 5) echo '<option  value="?ItemsPerPage=5" selected >Show 5 Items Per Page</option>';
                        else echo '<option  value="?ItemsPerPage=5">Show 5 Items Per Page</option>';

                        if ($itemsPerPage == 6) echo '<option  value="?ItemsPerPage=6"selected >Show 6 Items Per Page</option>';
                        else echo '<option  value="?ItemsPerPage=6">Show 6 Items Per Page</option>';

                        if ($itemsPerPage == 10) echo '<option  value="?ItemsPerPage=10"selected >Show 10 Items Per Page</option>';
                        else echo '<option  value="?ItemsPerPage=10">Show 10 Items Per Page</option>';

                        if ($itemsPerPage == 15) echo '<option  value="?ItemsPerPage=15"selected >Show 15 Items Per Page</option>';
                        else    echo '<option  value="?ItemsPerPage=15">Show 15 Items Per Page</option>';
                        ?>
                    </select>
                </li>
            </ul>
        </div>

        <ul class="bottom_right">
            <li>
                <a href="trashed.php"><button class="btn btn-info">Trash List</button></a>
            </li>
            <li>
                <a href="create.php"><button class="btn btn-success">Create</button></a>
            </li>
        </ul>
    </div>
    <script src="../../../resources/simple-confirmation-popup/js/main.js"></script>
    <script>
        var id;
        var isClicked;
    </script>

    <script>

        $("#trashMultiple").click(function () {
            $("#selectionForm").submit();

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
                $("#selectionForm").attr("action", "multiple_delete.php").submit();
            if(isClicked === "single")
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

<!-- required for search, block 5 of 5 start -->
<script>

    $(function () {
        var availableTags = [
            <?php
            echo $comma_separated_keywords;

            ?>
        ];
        // Filter function to search only from the beginning of the string
        $("#searchID").autocomplete({
            source: function (request, response) {

                var results = $.ui.autocomplete.filter(availableTags, request.term);

                results = $.map(availableTags, function (tag) {
                    if (tag.toUpperCase().indexOf(request.term.toUpperCase()) === 0) {
                        return tag;
                    }
                });

                response(results.slice(0, 15));

            }
        });


        $("#searchID").autocomplete({
            select: function (event, ui) {
                $("#searchID").val(ui.item.label);
                $("#searchForm").submit();
            }
        });
    });
</script>
<!-- required for search, block 5 of 5 end -->

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
