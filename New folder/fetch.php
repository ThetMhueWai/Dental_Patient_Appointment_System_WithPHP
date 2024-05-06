<?php
session_start();
include ('./connection.php');
if(isset($_POST['request'])){
    $request = $_POST['request'];
    $query = "SELECT * FROM schedules WHERE Sname = $request";
    $result = mysqli_query($connection,$query);
    $count = mysqli_num_rows($result);
}
?>
<table>
    <?php 
        if($count){
    ?>
    <thread>
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
        <?php
        }else{
            echo "Sorry! no record";
        }
        ?>
    </thread>
    <tbody>
        <?php 
            while($row = mysqli_fetch_assoc($reult)){
        ?>
        <tr>
            <td><?php echo $row['scheduleID'] ?></td>
            <td><?php echo $row['startTime'] ?></td>
            <td><?php echo $row['endTime'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['totalPatient'] ?></td>
            <td><?php echo $row['clinicID'] ?></td>
            <td><?php echo $row['reasonID'] ?></td>
            <td><?php echo $row['dentistID'] ?></td>
        </tr>

        <?php
            }
        ?>
    </tbody>
    <?php
        // } 
    ?>
</table>