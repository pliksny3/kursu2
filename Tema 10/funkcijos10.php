<?php

//Tema 10: lentele su duomenimis
function mokinys(array $array){
    foreach ($array as $key=>$value){
        echo $value->duomenys();
    }
}
//===========================

?>