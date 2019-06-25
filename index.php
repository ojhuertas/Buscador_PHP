<!DOCTYPE html>
<?php include 'loader.php' ?>
<?php
$cityFilter = "";
$typeFilter = "";
$minPrice = 0;
$maxPrice = 100000;

if (isset($_POST['cityFilter'])) {
    if ($_POST['cityFilter'] != "") {
        $cityFilter = $_POST['cityFilter'];
    }
}

if (isset($_POST['typeFilter'])) {
    if ($_POST['typeFilter'] != "") {
        $typeFilter = $_POST['typeFilter'];
    }
}

if (isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];
}
?>

<html>

    <head>
        <meta charset="utf-8">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Buscador</title>
    </head>

    <body>

        <div class="contenedor">
            <div class="card rowTitulo">
                <h1>Buscador</h1>
            </div>
            <div class="colFiltros">
                <form action="buscador.php" method="post" id="formulario">
                    <div class="filtrosContenido">
                        <div class="tituloFiltros">
                            <h5>Realiza una búsqueda personalizada</h5>
                        </div>
                        <div class="filtroCiudad input-field">
                            <label for="selectCiudad">Ciudad:</label>
                            <select name="ciudad" id="selectCiudad">
                                <option value="" selected>Elige una ciudad</option>
                                <?php foreach ($cityOptions as $cityKey => $city) { ?>
                                    <option value="<?php echo $city; ?>"><?php echo $city; ?></option><?php
                                } ?>
                            </select>
                        </div>
                        <div class="filtroTipo input-field">
                            <label for="selecTipo">Tipo:</label><br>
                            <select name="tipo" id="selectTipo">
                                <option value="" selected>Elige un tipo</option>
                                <?php foreach ($typeOptions as $typeKey => $type) { ?>
                                    <option value="<?php echo $type; ?>"><?php echo $type; ?></option><?php
                                } ?>
                            </select>
                        </div>
                        <div class="filtroPrecio">
                            <label for="rangoPrecio">Precio:</label>
                            <input type="text" id="rangoPrecio" name="precio" value="" />
                        </div>
                        <div class="botonField">
                            <input type="submit" class="btn white" value="Buscar" id="submitButton">
                        </div>
                    </div>
                </form>
            </div>

            <div class="colContenido">
                <div class="tituloContenido card">
                    <h5>Resultados de la búsqueda:</h5>
                    <div class="divider"></div>
                    <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>
                </div>
                <?php if (isset($_POST['searchResult'])) {
                    echo $_POST['searchResult'];
                } ?>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript">
            function updateFilter($filter, $value) {
                $($filter).val($value);
                $($filter).material_select();
            }
            function updatePrice($from, $to) {
                $("#rangoPrecio").data("ionRangeSlider").update({
                    from: $from,
                    to: $to
                });
            }
            $(document).ready(function() {
                if ("<?php echo $cityFilter; ?>" != "") {
                    updateFilter('#selectCiudad', "<?php echo $cityFilter; ?>");
                }
                if ("<?php echo $typeFilter; ?>" != "") {
                    updateFilter('#selectTipo', "<?php echo $typeFilter; ?>");
                }
                updatePrice("<?php echo $minPrice; ?>", "<?php echo $maxPrice; ?>");

                $('#mostrarTodos').on('click', function() {
                    $(".itemMostrado").remove();
                    updateFilter('#selectCiudad, #selectTipo', "");
                    updatePrice(0, 100000);
                    $('.colContenido').append('<?php echo $htmlData; ?>');
                });
            });
        </script>
    </body>

</html>
