<?php
session_start();
include ('./admin/connection.php');

if (isset ($_POST['request'])) {
    $request = $_POST['request']; // denreason
    // echo $request;
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM denreason JOIN schedules ON denreason.denReasonID = schedules.denReasonID AND schedules.totalPatient!=0 AND schedules.date >= CURDATE()+3 WHERE denreason.denReasonID = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $request);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) { // Check if the query executed successfully
        $count = mysqli_num_rows($result);
        ?>
                <table class="table table-hover">
                    <?php
                    if ($count) {
                        ?>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>start time</th>
                                        <th>end time</th>
                                        <th>Date</th>
                                        <th>Clinic</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                                <tr>
                                                    <?php $sid = $row['scheduleID'] ?>
                                                    <td><?php echo $row['scheduleID'] ?></td>
                                                    <td><?php echo $row['startTime'] ?></td>
                                                    <td><?php echo $row['endTime'] ?></td>
                                                    <td><?php echo $row['date'] ?></td>
                                                    <td><?php
                                                    $cliid=$row['clinicID'];
                                                    $go_query = mysqli_query($connection, "SELECT * FROM clinicinfo WHERE clinicID=$cliid");
                                                    while ($row = mysqli_fetch_array($go_query)) {
                                                        $clinicName = $row['clinicName']; 
                                                    }
                                                    echo $clinicName; 
                                                    ?></td>
                                                    <td>
                                                        <a class="appointmentBtn" href="checkappointment.php?sid=<?php echo $sid ?>">Appointment</a>
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