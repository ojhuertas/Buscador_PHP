<?php
$cityOptions = array();
$typeOptions = array();


$data = json_decode(file_get_contents("data-1.json"), true);

$htmlData = "";
foreach ($data as $propertyKey => $property) {
    foreach ($property as $infoKey => $info) {
        if ($infoKey == 'Ciudad') {
            if (!in_array($info, $cityOptions)) {
                $cityOptions[] = $info;
            }
        } elseif ($infoKey == 'Tipo') {
            if (!in_array($info, $typeOptions)) {
                $typeOptions[] = $info;
            }
        }
    }
    $htmlData.='<div class="itemMostrado card" id="property-'.$property['Id'].'">'.
        '<img class="itemMostrado" src="img/home.jpg" alt="">'.
        '<div class="card-stacked">'.
            '<ul>'.
                '<li><strong>Dirección: </strong><span>'.$property['Direccion'].'</span</li>'.
                '<li><strong>Ciudad: </strong><span>'.$property['Ciudad'].'</span</li>'.
                '<li><strong>Teléfono: </strong><span>'.$property['Telefono'].'</span</li>'.
                '<li><strong>Código Postal: </strong><span>'.$property['Codigo_Postal'].'</span</li>'.
                '<li><strong>Tipo: </strong><span>'.$property['Tipo'].'</span</li>'.
                '<li><strong>Precio: </strong><span class="precioTexto">'.$property['Precio'].'</span</li>'.
            '</ul>'.
            '<div class="divider"></div>'.
            '<div class="botonField card-action">'.
                '<input type="button" class="btn white" value="Ver más" id="moreButton">'.
            '</div>'.
        '</div>'.
    '</div>';
}
sort($cityOptions);
sort($typeOptions);
