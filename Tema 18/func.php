<?php

function conn()
{
    $servername = 'localhost';
    $username = 'Auto';
    $password = 'LabaiSlaptas123';
    $dbname = 'auto';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    return $conn;
}
//-------------------------------------------------------------
function tableAll($conn, $sql)
{

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>DATE</th><th>NUMBER</th><th>DISTANCE</th><th>TIME</th><th>SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row['id'] . '</td><td>' . $row['date'] . '</td><td>' . $row['number'] . '</td><td>' .
                $row['distance'] . '</td><td>' . $row['time'] . '</td><td>' . round($row['speed']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}
//------------------------------------------------------
function tableCars($conn, $sql)
{

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>NUMBER</th><th>COUNT</th><th>MAX SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row['number'] . '</td><td>' .
                $row['vnt'] . '</td><td>' . round($row['speedMax']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}
//--------------------------------------------------------------
function tableYear($conn, $sql)
{
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>YEAR</th><th>COUNT</th><th>MAX SPEED</th><th>AVG SPEED</th><th>MIN SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row['y'] . '</td><td>' . $row['vnt'] . '</td><td>' . round($row['speedMax']) .
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
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>MONTH</th><th>COUNT</th><th>MAX SPEED</th><th>AVG SPEED</th><th>MIN SPEED</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td>' . $row['m'] . '</td><td>' . $row['vnt'] . '</td><td>' . round($row['speedMax']) .
                '</td><td>' . round($row['speedAvg']) . '</td><td>' . round($row['speedMin']) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'nėra duomenų';
    }
}

function scrollBtn($conn, $sql2, $results_per_page, $page, $type){
    $result = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $results_per_page);
    echo '<div class="links">';
    if(isset($_GET['page']) && $_GET['page'] <= $total_pages && $page != 1){
        $i = $_GET['page'] - 1;
        echo "<a href='main.php?".$type."&page=".$i."'>Back</a> ";
    }else{echo "<a style='background-color: grey' href='#'>Back</a> ";}
    echo ' '.$_GET['page'].' of '.$total_pages.' ';
    if($page < $total_pages){
        $x = ++$page;
        echo "<a href='main.php?".$type."&page=".$x."'>Next</a> ";
    }else{echo "<a style='background-color: grey' href='#'>Next</a> ";}
    echo '</div>';
}

?>