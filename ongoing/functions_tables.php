<?php

function table_r($conn, $startR, $limitR){
    $sql = "SELECT *, `distance`/`time` as `speed` FROM radars ORDER BY number, date DESC LIMIT $startR,".$limitR;
    $result = $conn->query($sql);
    $c = 0;

    if ($result->num_rows > 0) {
        ?>
        <table class="main2tb">
            <tr><th colspan="8">RADARS</th></tr>
            <tr>
                <th>ID</th>
                <th>Numeris</th>
                <th>Data</th>
                <th>Atstumas (km)</th>
                <th>Laikas (h)</th>
                <th>Greitis (km/h)</th>
                <th>Vairuotojo ID</th>
                <th>Veiksmai</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
                <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['number'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['distance'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= round($row['speed']) ?></td>
                    <td><?= $row['driverid'] ?></td>
                    <td>
                        <a href="?editR=<?= $row['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="?deleteR=<?= $row['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
    } else {
        echo 'nėra duomenų';
    }
}
//------------------------------------------------------------------
function table_d($conn, $startD, $limitD){
    $sql = "SELECT * FROM drivers LIMIT $startD,".$limitD;
    $result = $conn->query($sql);
    $c = 0;

    if ($result->num_rows > 0) {
        ?>
        <table class="main2tb">
            <tr><th colspan="4">DRIVERS</th></tr>
            <tr>
                <th>Vairuotojo ID</th>
                <th>Vardas</th>
                <th>Miestas</th>
                <th>Veiksmai</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
                <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                    <td><?= $row['driverid'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td>
                        <a href="?editD=<?= $row['driverid'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="?deleteD=<?= $row['driverid'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
    } else {
        echo 'nėra duomenų';
    }
}
//-----------------------------------------------
function tableCars($conn, $sql)
{

    $result = $conn->query($sql);$c=0;

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>NUMBER</th><th>COUNT</th><th>MAX SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {?>
            <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
            <?php echo '<td>' . $row['number'] . '</td><td>' . $row['vnt'] . '</td><td>' . round($row['speedMax']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}
//--------------------------------------------------------------
function tableYear($conn, $sql)
{
    $result = $conn->query($sql);$c=0;
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>YEAR</th><th>COUNT</th><th>MAX SPEED</th><th>AVG SPEED</th><th>MIN SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {?>
            <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
            <?php echo '<td>' . $row['y'] . '</td><td>' . $row['vnt'] . '</td><td>' . round($row['speedMax']) .
                '</td><td>' . round($row['speedAvg']) . '</td><td>' . round($row['speedMin']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}
//------------------------------------------------------------
function tableMonth($conn, $sql)
{
    $result = $conn->query($sql);$c=0;
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>MONTH</th><th>COUNT</th><th>MAX SPEED</th><th>AVG SPEED</th><th>MIN SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {?>
            <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
            <?php echo '<td>' . $row['m'] . '</td><td>' . $row['vnt'] . '</td><td>' . round($row['speedMax']) .
                '</td><td>' . round($row['speedAvg']) . '</td><td>' . round($row['speedMin']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}
//------------------------------------------

function table_both($conn, $sql){
    $result = $conn->query($sql);
    $c = 0;

    if ($result->num_rows > 0) {
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Numeris</th>
                <th>Data</th>
                <th>Atstumas (km)</th>
                <th>Laikas (h)</th>
                <th>Greitis (km/h)</th>
                <th>Vairuotojo ID</th>
                <th>Vardas</th>
                <th>Miestas</th>
                <th>Veiksmai</th>
            </tr>

            <?php while($row = $result->fetch_assoc()): ?>
                <tr class="<?=($c++%2==1) ? 'odd' : 'even' ?>">
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['number'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['distance'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td><?= round($row['speed']) ?></td>
                    <td><?= $row['driverid'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td>
<!--                        <a href="?editR=--><?//= $row['id'] ?><!--"><i class="fa fa-pencil" aria-hidden="true"></i></a>-->
                        <a href="?deleteBR=<?= $row['id'] ?>&deleteBD=<?= $row['driverid'] ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php
    } else {
        echo 'nėra duomenų';
    }
}

?>