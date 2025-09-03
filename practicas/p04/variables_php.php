<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title> Variables php </title>
    </head>

    <body>
        <h1>Variables en php</h1>
        <h2>1-.Determina cuål de las siguientes variables son vålidas y explica por qué:</h2>
        <?php
            echo '$_myvar: Si es, porque comienza con $ y despues tiene un _';
            echo "<br>";
            echo '$_7var: No es, unque el nombre de una variable puede comenzar con un guion bajo (_), el siguiente carácter no puede ser un número. ';
            echo "<br>";
            echo 'myvar: No es porque no comuenza con $';
            echo "<br>";
            echo '$myvar:  Si es, porque comienza con $ y despues empieza con una letra';
            echo "<br>";
            echo '$var7:  Si es, porque comienza con $ y despues empieza con una letra.';
            echo "<br>";
            echo '$_element1:  Si es, porque comienza con $ y despues tiene un _';
            echo "<br>";
            echo '$house*5: La variable $house*5: No es válida porque el * no está permitido en los nombres de las variables.';
        ?>

        <h2>2-. Proporciona los valores de $a, $b, $c com sigue:</h2>
        <?php
            $a = "ManejadorSQL";
            $b = 'MySQL';
            $c = &$a;
            
            echo "Variable \$a: $a <br>";
            echo "Variable \$b: $b <br>";
            echo "Variable \$c: $c";
        ?>
        <h3>b. Agregar nuevas asignaciones</h3>
        <h3>c. Mostrar contenido</h3>
        <?php
            $a = "PHP server";
            $b = &$a;
            
            echo "Variable \$a: $a <br>";
            echo "Variable \$b: $b <br>";
            echo "Variable \$c: $c";
        ?>

        <h3>d. Describir que ocurrió en el segundo bloque de asignaciones</h3>
        <?php
            echo "La variable \$a cambia su valor a 'PHP server' y como las variables \$b y \$c son referencias de \$a, toman el mismo valor";
            unset($a, $b, $c)
        ?>

    </body>
</html>