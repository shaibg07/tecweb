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
        .form-container {
            font-family: sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 400px; /* Ancho máximo del formulario */
        }
        .form-container label {
            display: block; /* Hace que la etiqueta ocupe su propia línea */
            margin-bottom: 5px; /* Espacio debajo de la etiqueta */
            font-weight: bold;
            color: #333;
        }
        .form-container input[type="text"],
        .form-container select {
            width: 100%; /* Ocupa todo el ancho disponible */
            padding: 10px; /* Relleno interno */
            margin-bottom: 15px; /* Espacio debajo de cada campo */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Asegura que el padding no afecte el ancho total */
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50; /* Mismo verde que la tabla */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer; /* Cambia el cursor a una manita */
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #45a049; /* Un verde un poco más oscuro al pasar el mouse */
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

    <h2>Ejercicio 5: Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
bienvenida apropiado.</h2>

        <div class="form-container">
        <form action="index.php" method="post">
            <label for="edad">Edad:</label>
            <input type="text" name="edad" id="edad" required>
            
            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo">
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
            </select>
            
            <button type="submit">Enviar</button>
        </form>
    </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") { 
                if (isset($_POST['edad']) && isset($_POST['sexo'])) {
                    
                    $edad = $_POST['edad'];
                    $sexo = $_POST['sexo'];

                    $mensaje = mayorEdad($edad, $sexo);

                    echo "<h3>Resultado:</h3>";
                    echo "Su edad es: $edad años y su sexo es $sexo.<br>";
                    echo "<p>$mensaje</p>";
                }
            }
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