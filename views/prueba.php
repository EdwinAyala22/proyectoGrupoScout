<?php

$productos = array(

    [0] => array(
        "nombre" => "Gorra",
        "precio" => "15000"
    ),
    [1] => array(
        "nombre" => "Pañoleta",
        "precio" => "5000"
    )
);

foreach($productos as $pro => $p){
    print_r($p->nombre."</br>");
    echo $p->nombre."</br>";
}


?>