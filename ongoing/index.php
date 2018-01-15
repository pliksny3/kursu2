<!DOCTYPE html>
<html>
<head>
    <title>Ongoing</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php
require_once 'functions.php';
require_once 'functions_tables.php';
$conn = connectDB();
//Puslapio limitas: cars,months,years
$results_per_page = 3;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else { $page=1; };
$start_from = ($page-1) * $results_per_page;

//Puslapio limitas: Radars, Drivars
$limitR = get_limitr(); setcookie('limitr',$limitR);
$limitD = get_limitd(); setcookie('limitd',$limitD);

if (isset($_POST['save_limit'])) {
    if (empty($_POST['limitr']) && !empty($_POST['limitd'])) {
        $limitD = $_POST['limitd']; setcookie('limitd',$limitD);
    }elseif (!empty($_POST['limitr']) && empty($_POST['limitd'])) {
        $limitR = $_POST['limitr']; setcookie('limitr',$limitR);
    }elseif (!empty($_POST['limitr']) && !empty($_POST['limitd'])) {
        $limitD = $_POST['limitd']; setcookie('limitd',$limitD);
        $limitR = $_POST['limitr']; setcookie('limitr',$limitR);
    }elseif (empty($_POST['limitr']) && empty($_POST['limitd'])) {
        $limitR = 100; setcookie('limitr',$limitR);
        $limitD = 100; setcookie('limitd',$limitD);
    }
}
if (isset($_GET['Drivers_page']) && isset($_GET['Radars_page'])){
    $page_r = $_GET['Radars_page'];
    $page_d = $_GET['Drivers_page'];
}else{
    $page_r = 1;
    $page_d = 1;
}
$startD = ($page_d - 1) * $limitD;
$startR = ($page_r - 1) * $limitR;


// 17 Tema: padaryti lentele su Delete, Update, Insert
if (isset($_GET['deleteR'])) {
    $sql = "DELETE FROM radars WHERE id = ". intval($_GET['deleteR']);
    $conn->query($sql);
}
if (isset($_GET['deleteD'])) {
    $sql = "DELETE FROM drivers WHERE driverid = ". intval($_GET['deleteD']);
    $conn->query($sql);
}
if (isset($_GET['deleteBR'])) {
    $sql = "DELETE FROM radars WHERE id = ". intval($_GET['deleteBR']);
    $conn->query($sql);
    $sql = "DELETE FROM drivers WHERE driverid = ". intval($_GET['deleteBD']);
    $conn->query($sql);
}

$row = [];
if (isset($_GET['editR'])) {
    $sql = "SELECT * FROM radars WHERE id = ". intval($_GET['editR']);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
if (isset($_GET['editD'])) {
    $sql = "SELECT * FROM drivers WHERE driverid = ". intval($_GET['editD']);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if (isset($_POST['saveR'])) {
    if (intval($_POST['id']) > 0) {
        $sql = $conn->prepare("UPDATE radars SET date = ?, number = ?, distance = ?, time = ? WHERE id = ?");
        $sql->bind_param("ssddi", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time'], $_REQUEST['id']);
        $sql->execute();
    } else {
        $sql = $conn->prepare("INSERT INTO radars (date, number, distance, time) VALUE (?, ?, ?, ?)");
        $sql->bind_param("ssdd", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time']);
        $sql->execute();
    }
    $row = [];
}
if (isset($_POST['saveD'])) {
    if (intval($_POST['driverid']) > 0) {
        $sql = $conn->prepare("UPDATE drivers SET name = ?, city = ? WHERE driverid = ?");
        $sql->bind_param("ssi", $_REQUEST['name'], $_REQUEST['city'], $_REQUEST['driverid']);
        $sql->execute();
    } else {
        $sql = $conn->prepare("INSERT INTO drivers (name, city) VALUE (?, ?)");
        $sql->bind_param("ss", $_REQUEST['name'], $_REQUEST['city']);
        $sql->execute();
    }
    $row = [];
}

if (isset($_POST['saveid'])) {
    if (intval($_POST['cars']) > 0 && intval($_POST['people']) > 0) {
        $sql = $conn->prepare("UPDATE radars SET driverid = ? WHERE id = ? ");
        $sql->bind_param("dd", $did, $id);
        $did = intval($_POST['people']);
        $id = intval($_POST['cars']);
        $sql->execute();
    }elseif (intval($_POST['cars']) > 0 && intval($_POST['people']) < 1) {
        $sql = $conn->prepare("UPDATE radars SET driverid = ? WHERE id = ? ");
        $sql->bind_param("dd", $did, $id);
        $did = 0;
        $id = intval($_POST['cars']);
        $sql->execute();
    }
    $row = [];
}

?>
<!--Inputs, buttons, Links-->
    <div class="wrapper">
        <form method='post'>
        <div class="radars">
        <h3>RADARS</h3>
        <input type='hidden' name='id' required value="<?= !empty($row['id']) ? $row['id'] : "" ?>">
        <input type='text' name='date' placeholder="DATA" required value="<?= !empty($row['date']) ? $row['date'] : "" ?>">
        <input type='number' name='distance' placeholder="DISTANCE" required value="<?= !empty($row['distance']) ? $row['distance'] : "" ?>"><br>
        <input type='text' name='number' placeholder="NUMBER" required value="<?= !empty($row['number']) ? $row['number'] : "" ?>">
        <input type='number' name='time' placeholder="TIME" required value="<?= !empty($row['time']) ? $row['time'] : "" ?>"><br>
        <button name="saveR" type="submit" id="saver">SUBMIT</button>
    </div></form>
        <form method='post'>
        <div class="drivers">
        <h3>DRIVERS</h3>
        <input type='hidden' name='driverid' required value="<?= !empty($row['driverid']) ? $row['driverid'] : "" ?>">
        <input type='text' name='name' placeholder="NAME" required value="<?= !empty($row['name']) ? $row['name'] : "" ?>"><br>
        <input type='text' name='city' placeholder="CITY" required value="<?= !empty($row['city']) ? $row['city'] : "" ?>"><br>
        <button name="saveD" type="submit" id="saved">SUBMIT</button>
        </div></form>

    <!--18 Tema: linkai-->
        <div class="links">
            <a id="c" href="?cars&page=1">CARS</a><br>
            <a id="m" href="?month&page=1">MONTH</a><br>
            <a id="y" href="?year&page=1">YEAR</a><br>
        </div>
        <div class="links">
            <a id="h" href="index.php?Radars_page=1&Drivers_page=1"><i class="fa fa-home" aria-hidden="true"></i></a><br>
            <a id="both" href="?both"><i class="fa fa-user-plus" aria-hidden="true"></i><i class="fa fa-car" aria-hidden="true"></i></a>
        </div>

    <!--19 Tema: dropdown-->
        <form method="post">
            <div class="dropdown">
                <h3>CONNECT DRIVER ID</h3>
            <select name="cars">
                <?=$sql = 'SELECT id, number, driverid FROM radars ORDER BY number, date DESC';
                $result = $conn->query($sql);
                if ($result->num_rows > 0):?>
                    <option value="0">Id - Numeris - V.id</option>
                    <?php foreach($result as $row):?>
                        <option value="<?=$row['id']?>"><?=$row['id']?> - <?=$row['number']?> - <?=$row['driverid']?></option>
                    <?php endforeach; endif;?>
            </select>
            <select name="people">
                <?=$sql = 'SELECT driverid, name FROM drivers';
                $result = $conn->query($sql);
                if ($result->num_rows > 0):?>
                    <option value="0">V.id - Vardas</option>
                    <?php while($row = $result->fetch_assoc()):?>
                        <option value="<?=$row['driverid']?>"><?=$row['driverid']?> - <?=$row['name']?></option>
                    <?php endwhile; endif;?>
            </select><br>
                <button type="submit" name="saveid" id="saveid">SUBMIT</button><br>
            </div></form>
    <!--Puslapiavimas: Radars & Drivers-->
            <form method="post"><div class="pagi2">
                    <h3>LIMIT TABLES</h3>
                <input type="number" name="limitr" class="p2" placeholder="Limit R">
                <input type="number" name="limitd" class="p2" placeholder="Limit D"><br>
                <button type="submit" name="save_limit" id="savel">SEBMIT</button><br>
                <?php if (isset($_GET['Radars_page'])): ?>
                <a class="resets" href="index.php?Radars_page=1&Drivers_page=<?=$_GET['Drivers_page']?>">R</a>
                <a class="resets" href="index.php?Radars_page=<?=$_GET['Radars_page']?>&Drivers_page=1">D</a>
                <?php endif; ?>
            </form></div></div>


<?php
// 18 temos mygtukai: Cars, Months, Years
if(isset($_GET['cars'])){
    $sql = "SELECT number, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax FROM radars GROUP BY number LIMIT $start_from,".$results_per_page;
    tableCars($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(number)) as total FROM radars";
    $type = 'cars';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
elseif (isset($_GET['year'])){
    $sql = "SELECT YEAR(date) AS y, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax, AVG(distance/time*3.6) AS speedAvg,
 MIN(distance/time*3.6) AS speedMin FROM radars GROUP BY YEAR(date) LIMIT $start_from,".$results_per_page;
    tableYear($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(YEAR(date))) as total FROM radars";
    $type = 'year';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
elseif (isset($_GET['month'])){
    $sql = "SELECT MONTH(date) AS m, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax, AVG(distance/time*3.6) AS speedAvg,
 MIN(distance/time*3.6) AS speedMin FROM radars GROUP BY MONTH(date) LIMIT $start_from,".$results_per_page;
    tableMonth($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(MONTH(date))) as total FROM radars";
    $type = 'month';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
// Iskvieciama sujungta lentele pagal driverid
elseif (isset($_GET['both'])){
    $sql = "SELECT *, distance/time as speed, name, city FROM radars r JOIN drivers d ON r.driverid = d.driverid ORDER BY r.driverid ASC";
    table_both($conn, $sql);
}
// Iskvieciamos lenteles Radars & Drivers paspaudus 'home' mygtuka
else {

    echo '<div class="body"><div class="tb_r">';
    table_r($conn, $startR, $limitR);
    $sql = "SELECT COUNT(*) AS total FROM radars";
    limitedR($conn, $sql, $limitR, $page_r, $page_d);
    echo '</div><div class="tb_d">';
    table_d($conn, $startD, $limitD);
    $sql = "SELECT COUNT(*) AS total FROM drivers";
    limitedD($conn, $sql, $limitD, $page_r, $page_d);
    echo '</div></div>';
}


?>




</body>
</html>
