<?php
// Comprubo que arrayPartners menos o igual de tres posiciones y muestro todo su contenido,
// en cabio si arrayPartners es mayor a 3 posiciones llamo al metodo extraerTresAsociados del fichero utils.php y mostraria 3 objetos del array
if (count($arrayPartners) <= 3) {
    $arrayMostrarPartner = $arrayPartners;
} else {
    if (count($arrayPartners) > 3) {
        $arrayMostrarPartner = extraerTresAsociados($arrayPartners);
    }
}
// Muestro por pantalla los Asociados
foreach ($arrayMostrarPartner as $partner) {
    print "<ul class='list-inline'>
    <li><img src=" . $partner->getLogo() . " alt='" . $partner->getDescripcion() . "' title='" . $partner->getDescripcion() . "'></li>
    <li>" . $partner->getNombre() . "</li>
  </ul>";
}
