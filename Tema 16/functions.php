<?php
function table($conn) {

    $sql = 'SELECT *, distance/time*3.6 as speed FROM radars';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        ?>
        <div class="scroll">
        <table>
            <tr>
                <th>Id</th>
                <th>Number</th>
                <th>Date</th>
                <th>Distance</th>
                <th>Time</th>
                <th>Speed</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['distance']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo round($row['speed'], 1); ?></td>
                </tr>
            <?php endwhile; ?>

        </table>
        </div>

        <?php

    } else {
        echo 'nėra duomenų';
    }
}

function conn(){
    $servername = 'localhost';
    $username = 'Auto';
    $password = 'LabaiSlaptas123';
    $dbname = 'auto';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
        die('Connection failed: '.$conn->connect_error);
    }
    return $conn;
}
?>