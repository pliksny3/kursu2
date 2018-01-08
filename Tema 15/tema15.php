<!DOCTYPE html>
<html>
<head>
    <title>Title</title>
    <meta charset="UTF-8">
    <style>
        table, td, a{
            border: 2px solid black;border-collapse: collapse;padding: 10px;}
        a{ background-color: chartreuse; border-radius: 15px; text-decoration: none; color: black}
    </style>
</head>
<body>
<h1> Duomenu lentele</h1>
<?php

require_once 'functions.php';
$conn = conn();
$results_per_page = 10;

if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else { $page=1; };

$start_from = ($page-1) * $results_per_page;
$sql = "SELECT *, distance/time*3.6 AS speed FROM radars LIMIT $start_from, ".$results_per_page;
$rs_result = $conn->query($sql);

if($rs_result->num_rows > 0){
    echo '<table>';
    while ($row = $rs_result->fetch_assoc()){
        echo '<tr><td>'.$row['id'].'</td><td>'.$row['date'].'</td><td>'.$row['number'].'</td><td>'.$row['distance'].'</td><td>'
            .$row['time'].'</td><td>'.round($row['speed'],2).'</td></tr>';
    }
    echo '</table>';
}else{
    echo '0 Results';
}

$sql = "SELECT COUNT(ID) AS total FROM radars";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);

//for ($i=1; $i<=$total_pages; $i++) {
//    echo "<a href='tema15.php?page=".$i."'>".$i."</a> ";
//};
echo '<br><br>';
if(isset($_GET['page']) && $_GET['page'] <= $total_pages && $page != 1){
    $i = $_GET['page'] - 1;
    echo "<a href='tema15.php?page=".$i."'>Back</a> ";
}else{echo "<a style='background-color: grey' href='#'>Back</a> ";}

if($page < $total_pages){
    $x = ++$page;
    echo "<a href='tema15.php?page=".$x."'>Next</a> ";
}else{echo "<a style='background-color: grey' href='#'>Next</a> ";}

$conn->close();

?>

</body>
</html>