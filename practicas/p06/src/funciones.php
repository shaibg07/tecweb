<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function multiplo_5_7(){
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    }

    function generacion_repetitiva(){
        $mtz=[]; 
        $iteracion = 0; 
        $numeros = 0; 

        do{
            $iteracion++; 
            $fila = [rand(100,999), rand(100,999), rand(100,999)]; 
            $numeros +=3; 
            $mtz[]=$fila; 
        }while (!($fila[0]%2 !=0 && $fila[1]%2==0 && $fila[2]%2!=0)); 

        foreach($mtz as $fila){
            echo implode(", ", $fila).'<br>'; 
        }
        echo '<br>'; 

        echo "\n$numeros números obtenidos en $iteracion iteraciones";
    } 
?>
</body>
</html>