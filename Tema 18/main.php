<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <style>
        table, td, th, a{
            border: 2px solid black;border-collapse: collapse;padding: 10px; text-align: center}
        a{ background-color: chartreuse; border-radius: 15px; text-decoration: none; color: black;}
        .links{text-align: center; padding-top: 20px}
        table{margin: auto; margin-top: 20px}

    </style>
</head>
<body>
<div class="links">
    <a href="?table&page=1">Table</a>
    <a href="?cars&page=1">Cars</a>
    <a href="?month&page=1">Month</a>
    <a href="?year&page=1">Year</a>
</div>
<?php

require_once 'func.php';
$conn = conn();
$results_per_page = 3;

if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else { $page=1; };
$start_from = ($page-1) * $results_per_page;

if(isset($_GET['cars'])){
    $sql = "SELECT number, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax FROM radars GROUP BY number LIMIT $start_from,".$results_per_page;
    tableCars($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(number)) as total FROM radars";
    $type = 'cars';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
if (isset($_GET['table'])){
    $sql = "SELECT *, distance/time*3.6 AS speed FROM radars LIMIT $start_from,".$results_per_page;
    tableAll($conn, $sql);
    $sql2 = "SELECT COUNT(id) as total FROM radars";
    $type = 'table';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
if (isset($_GET['year'])){
    $sql = "SELECT YEAR(date) AS y, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax, AVG(distance/time*3.6) AS speedAvg,
 MIN(distance/time*3.6) AS speedMin FROM radars GROUP BY YEAR(date) LIMIT $start_from,".$results_per_page;
    tableYear($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(YEAR(date))) as total FROM radars";
    $type = 'year';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}
if (isset($_GET['month'])){
    $sql = "SELECT MONTH(date) AS m, COUNT(*) AS vnt, MAX(distance/time*3.6) AS speedMax, AVG(distance/time*3.6) AS speedAvg,
 MIN(distance/time*3.6) AS speedMin FROM radars GROUP BY MONTH(date) LIMIT $start_from,".$results_per_page;
    tableMonth($conn, $sql);
    $sql2 = "SELECT COUNT(DISTINCT(MONTH(date))) as total FROM radars";
    $type = 'month';
    scrollBtn($conn, $sql2, $results_per_page, $page, $type);
}


$conn->close();

?>

</body>
</html>