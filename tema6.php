<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
//lyginia-- nelyginiai++
/*
$array=[
    [5,4,2],
    [7,2,6],
    [9,8,9]
];
for($i=0;$i<count($array);$i++){
    for($j=0;$j<count($array[$i]);$j++){
        if($array[$i][$j]%2==0){
            echo --$array[$i][$j];
            echo " ";
        }else {echo ++$array[$i][$j]." ";}
    }
}
*/

//Trikampiai
/*
$array=[[3,4,5],[2,10,8],[5,6,5],[5,5,5]];
for($i=0;$i<count($array);$i++){
    sort($array[$i]);
    $a=$array[$i][0];$b=$array[$i][1];$c=$array[$i][2];
    if($a+$b<=$c){
        echo "Skaiciai: ".$a." ".$b." ".$c." Negali buti trikampio krastiniu ilgiai<br>";
    }elseif ($a==$c){
        $x=round(($a**2*sqrt(3))/4,2);
        echo "Skaiciai: ".$a." ".$b." ".$c." Sudaro lygiakrasti trikampi, kurio plotas - ".$x."<br>";
    }elseif ($a==$b){
        $x=round(((sqrt($a**2-(($c/2)**2)))*$c)/2,2);
        echo "Skaiciai: ".$a." ".$b." ".$c." Sudaro lygiasoni trikampi, kurio plotas - ".$x."<br>";
    }elseif ($b==$c) {
        $x=round(((sqrt($b**2-(($a/2)**2)))*$a)/2, 2);
        echo "Skaiciai: ".$a." ".$b." ".$c." Sudaro lygiasoni trikampi, kurio plotas - ".$x."<br>";
    }else{
        $p=(($a+$b+$c)/2);$x=round(sqrt($p*($p-$a)*($p-$b)*($p-$c)), 2);
        echo "Skaiciai: ".$a." ".$b." ".$c." Sudaro ivairiakrasti trikampi, kurio plotas - ".$x."<br>";
    }
}
*/

//Mazejimo tvarka naudojant splice
/*
$a=array(-10,0,2,9,-5);
for ($z=0;count($a)>$z;$z=0){   //Meginau naudoti while(count($a)>0) bet rodydavo "bad gateway". su for veikia gerai.
    $x=$a[0];
    $nr=0;
    for ($i=1;$i<count($a);$i++){
        if($a[$i]>$x){
            $nr=$i;
            $x=$a[$i];
        }
    }
    echo $x." ";
    array_splice($a,$nr,1);
}
*/

//Trikampiai-nepavykes darbas
/*
$array=[[3,4,5],[2,10,8],[5,6,5],[5,5,5]];
for($i=0;$i<count($array);$i++) {
    if ($array[$i][0]==$array[$i][1] && $array[$i][0]==$array[$i][2]){
        $x=($array[$i][0]**2*sqrt(3))/4;
        var_dump($array[$i]);
        echo " Lygiakrastis trikampis. Plotas:".round($x,2)."<br>";
    }
    elseif ($array[$i][0]==$array[$i][1] xor $array[$i][0]==$array[$i][2] xor $array[$i][1]==$array[$i][2]){
        var_dump($array[$i]);
        echo " Lygiasonis trikampis<br>";
    }
    elseif ($array[$i][0]**2==$array[$i][1]**2+$array[$i][2]**2xor
        $array[$i][1]**2==$array[$i][0]**2+$array[$i][2]**2xor
        $array[$i][2]**2==$array[$i][1]**2+$array[$i][0]**2){
        var_dump($array[$i]);
        echo " Ivairiakrastis trikampis<br>";
    }
    else{
        var_dump($array[$i]);
        echo " Negali buti trikampio krastiniu ilgiai<br>";
    }
}
*/

?>
</body>
</html>