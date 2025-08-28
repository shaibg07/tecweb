<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Includes PHP</title>
</head>
<body>
    <?php
    include("encabezado.inc.php");
    echo "<hr />";
    include_once("cuerpo.inc.php");
    require("cuerpo.html");
    require_once("pie.inc.php");
    ?>
</body>
</html>