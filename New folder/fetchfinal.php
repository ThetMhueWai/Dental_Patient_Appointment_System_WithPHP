<?php
session_start();
include ('./connection.php');
if (isset ($_POST['request'])) {
    $request = $_POST['request'];
    // echo $request;
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM schedules WHERE Sname = ?";
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
                <thead>
                    <tr>
                        <th>#</th>
                        <th>start time</th>
                        <th>end time</th>
                        <th>Date</th>
                        <th>Total Patient</th>
                        <th>Clinic</th>
                        <th>Reason</th>
                        <th>Dentists</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['scheduleID'] ?>
                            </td>
                            <td>
                                <?php echo $row['startTime'] ?>
                            </td>
                            <td>
                                <?php echo $row['endTime'] ?>
                            </td>
                            <td>
                                <?php echo $row['date'] ?>
                            </td>
                            <td>
                                <?php echo $row['totalPatient'] ?>
                            </td>
                            <td>
                                <?php echo $row['clinicID'] ?>
                            </td>
                            <td>
                                <?php echo $row['reasonID'] ?>
                            </td>
                            <td>
                                <?php echo $row['dentistID'] ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
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