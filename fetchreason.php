<?php
session_start();
include ('./admin/connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</head>

<body>
<?php 
if (isset ($_POST['request'])) {
    $request = $_POST['request']; // reasonID
    // echo $request;
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM denreason,dentists WHERE reasonID = ? AND denreason.dentistsID=dentists.dentistID";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $request);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) { // Check if the query executed successfully
        $count = mysqli_num_rows($result);
        ?>
        <table>
            <?php
            if ($count) {
                ?>
                    <div class="col-md-6">
                        <input type="text" hidden id="reasonID" value="<?php echo $request ?>">
                        <div class="form-floating" id="filter">
                                <select name="fetchvaldentists" class="form-select" id="fetchvaldentists" id="validationDefault04" required>
                                    <option selected disabled value="">Choose Dentists</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $dentistName = $row['dentistName'];
                        $dentistID = $row['dentistID'];
                        $denreasonID = $row['denReasonID'];

                        // $optionValue = '{"dentistID":' . $dentistID . ',"denreasonID":' . $denreasonID . '}';
                        // echo "<option value='" . $optionValue . "'>{$dentistName}</option>";
                        echo "<option value={$denreasonID}>{$dentistName}</option>";
                        ?>
                        <?php
                    }
                    ?>
                    </select>
                    <label for="floatingName">Dentists</label>
                        </div>
                    </div>
                <?php
            } else {
                echo "<tr><td colspan='8'>Sorry! no record</td></tr>";
            }
            ?>
        </table>
        <?php
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }
}
?>

<script>
    $(document).ready(function(){
            $("#fetchvaldentists").on('change',function(){
                var value = $(this).val();
                var denreasonID = $('#denreasonID').val();
                // alert(value);
                $.ajax({
                    url:"fetchdentists.php",
                    type:"POST",
                    data:{ request: value},
                //     data:{ 
                //         request: value, // dentistsID
                //         denreasonID : // denreasonID
                //     },
                    beforeSend:function(){
                        $(".schedulecontainer").html("<span>Working......</span>");
                    },
                    success:function(data){
                        $(".schedulecontainer").html(data);
                    }
                });
            });
        });
</script>
</body>
</html>