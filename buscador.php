<?php

include "loader.php";

$filterCity = $_POST['ciudad'];
$filterType = $_POST['tipo'];
$filterPrice = $_POST['precio'];

$priceDivider = strpos($filterPrice, ';');
$minPrice = substr($filterPrice, 0, $priceDivider);
$maxPrice = substr($filterPrice, $priceDivider+1);

$searchResult = '';

foreach ($data as $propertyKey => $property) {
    $matchFilters = true;

    if ($filterCity != '') {
        if ($filterCity != $property['Ciudad']) {
            $matchFilters = false;
        }
    }

    if ($filterType != '' && $matchFilters) {
        if ($filterType != $property['Tipo']) {
            $matchFilters = false;
        }
    }

    if ($matchFilters) {
        $price = intval(str_replace(',', '', substr($property['Precio'], 1)));
        if ($price < $minPrice || $maxPrice < $price) {
            $matchFilters = false;
        }
    }

    if ($matchFilters) {
        $searchResult.='<div class="itemMostrado card" id="property-'.$property['Id'].'">'.
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
}
?>

<form id="myForm" action="index.php" method="post">
    <?php
        echo '<input type="hidden" name="searchResult" value="'.htmlentities($searchResult).'"/>';
        echo '<input type="hidden" name="cityFilter" value="'.$filterCity.'"/>';
        echo '<input type="hidden" name="typeFilter" value="'.$filterType.'"/>';
        echo '<input type="hidden" name="minPrice" value="'.$minPrice.'"/>';
        echo '<input type="hidden" name="maxPrice" value="'.$maxPrice.'"/>';
    ?>
</form>

<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>
