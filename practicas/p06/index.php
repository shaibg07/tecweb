<?php
    require_once 'src/funciones.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
    <style> 
        table {
            border-collapse: collapse; 
            width: 250px; 
            margin: 20px 0; 
            font-family: sans-serif;
            text-align: center; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.15); 
        }
        th {
            background-color: #4CAF50; 
            color: white; 
            padding: 12px; 
        }
        td{
            border: 1px solid #ddd; 
            padding: 8px; 
        }
    </style>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        multiplo_5_7();
    ?>

    <h2>Ejrcicio 2:Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
secuencia compuesta por: impar, par, impar</h2>
    <?php
        generacion_repetitiva();
    ?>

    <h2>Ejercicios 3: Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
pero que además sea múltiplo de un número dado.</h2>
    <?php
        echo '<h3>Uso de while</h3>';
        if(isset($_GET['num']))
        {
            entero_aleatorio($_GET['num']); 
        }
        echo '<h3>Uso de do-while</h3>';
        if(isset($_GET['numero']))
        {
            entero_aleatorio($_GET['numero']);
        }
    ?>
    <h2>Ejercicio 4: Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
el valor en cada índice.</h2>
        <?php
            arregloAscii();
        ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p06/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
</body>
</html>