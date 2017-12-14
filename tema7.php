<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
//Masyvu vidurkiu skirtumas
/*
$a=array(5,6,10,15);
$b=array(8,5,3,25);
//Suranda masyvo vidurki
function vidurkis(array $array){
    $sum=0;
    for($x=0;$x<count($array);$x++){
        $sum+=$array[$x];
    }
    $vid=$sum/count($array);
    return $vid;
}
var_dump(vidurkis($a)-vidurkis($b));
*/

//Tobuli skaiciai be funkciju
/*
for($x=1;$x<=1000;$x++){
    $sum=0;
    for($y=1;$y<=($x/2);$y++){
        if($x%$y==0){
            $sum+=$y;
        }
    }
    //echo $x.'+'.$sum.'<br>';
    if($sum==$x){
        echo $x.'<br>';
    }
}
*/
?>
</body>
</html>