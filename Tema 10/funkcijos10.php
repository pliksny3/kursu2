<?php

//Tema 10: lentele su duomenimis
function mokinys(array $array){
    foreach ($array as $value){
        echo '<tr><td>'.$value->vardas.'</td><td>'.$value->pavarde.'</td><td>'.$value->vid().'</td></tr>';
    }
}
//===========================

?>