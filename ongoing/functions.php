<?php
function connectDB()
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
//===========================================================================

function scrollBtn($conn, $sql2, $results_per_page, $page, $type){
    $result = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $results_per_page);

    echo '<div class="tb-btn">';

    if(isset($_GET['page']) && $_GET['page'] <= $total_pages && $page != 1){
        $i = $_GET['page'] - 1;
        echo "<a href='index.php?".$type."&page=".$i."'>BACK</a> ";
    }else{echo "<a class='stop' href='#'>BACK</a> ";}

    echo ' '.$_GET['page'].' of '.$total_pages.' ';

    if($page < $total_pages){
        $x = ++$page;
        echo "<a  href='index.php?".$type."&page=".$x."'>NEXT</a> ";
    }else{echo "<a class='stop' href='#'>NEXT</a> ";}

    echo '</div>';
}
//===========================================================================

function limitedR($conn, $sql, $limitR, $page_r, $page_d){
    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $limitR);
    if ($row['total'] > $limitR) {
        echo '<div class="tb-btn">';

        if ($page_r <= $total_pages && $page_r != 1) {
            $ri = $page_r - 1; ?>
        <a href='index.php?Radars_page=<?= $ri ?>&Drivers_page=<?= $page_d ?>'>BACK</a><?php
        } else {
            echo "<a class='stop' href='#'>BACK</a> ";
        }

        echo ' ' . $page_r . ' of ' . $total_pages . ' ';

        if ($page_r < $total_pages) {
            $rx = $page_r +1; ?>
        <a href='index.php?&Radars_page=<?= $rx ?>&Drivers_page=<?= $page_d ?>'>NEXT</a><?php
        } else {
            echo "<a class='stop' href='#'>NEXT</a> ";
        }

        echo '</div>';
    }
}

function limitedD($conn, $sql, $limitD, $page_r, $page_d){
    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $limitD);
    if ($row['total'] > $limitD) {
        echo '<div class="tb-btn">';

        if ($page_d <= $total_pages && $page_d != 1) {
            $di = $page_d - 1; ?>
        <a href='index.php?Radars_page=<?= $page_r ?>&Drivers_page=<?= $di ?>'>BACK</a><?php
        } else {
            echo "<a class='stop' href='#'>BACK</a> ";
        }

        echo ' ' . $page_d . ' of ' . $total_pages . ' ';

        if ($page_d < $total_pages) {
            $dx = $page_d + 1; ?>
        <a href='index.php?&Radars_page=<?= $page_r ?>&Drivers_page=<?= $dx ?>'>NEXT</a><?php
        } else {
            echo "<a class='stop' href='#'>NEXT</a> ";
        }

        echo '</div>';
    }
}

function get_limitd (){
    if (!empty($_COOKIE['limitd'])){
        $limitD = $_COOKIE['limitd'];
    }else{ $limitD = 100;}
    return $limitD;
}
function get_limitr (){
    if (!empty($_COOKIE['limitr'])){
        $limitR = $_COOKIE['limitr'];
    }else{ $limitR = 100;}
    return $limitR;
}
?>