<?php
require "utils/utils.php";
require "entities/ImagenGaleria.class.php";
require "entities/partners.class.php";

$arrayImagenes = array();

// For para añadir a un array 12 objetos imagenesGaleria
for ($i = 0; $i < 12; $i++) {
    $arrayImagenes[] = new ImagenGaleria(($i + 1) . ".jpg", "Descripción imagen " . ($i + 1), rand(500, 1000), rand(100, 500), rand(0, 100));
}
// For para crear seis Asociados
$arrayNombreAsociados = ["Miguel Ángel Fernández", "Fernando García", "Antonio Pérez", "Ana Fernández ", "Ramon López ", "Sara Martínez"];
$num = 1;
for ($i = 0; $i < 6; $i++) {
    $arrayPartners[] = new Partners($arrayNombreAsociados[$i], "images/index/log" . $num . ".jpg", " Asociado " . ($i + 1));
    if ($num >= 3) {
        $num = 1;
    } else {
        $num++;
    }
}

require "views/index.view.php";
?>