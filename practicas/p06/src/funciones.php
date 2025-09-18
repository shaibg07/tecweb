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

    function entero_aleatorio($num){
        if ($num <= 0) {
            echo "Inserte un número mayor que 0";
            return;
        }
        $aleatorio = rand(1,1000); 
        
        while($aleatorio % $num != 0){
            $aleatorio = rand (1, 1000); 
        }
        echo "Número aleatorio generado: $aleatorio <br>";
        echo "¡El número $aleatorio es múltiplo de $num!<br>"; 
    }

    function entero_aleatorio_do_while($numero){
        if ($num <= 0) {
        echo "Inserte un número mayor que 0";
        return;
    }

    do {
        
        $aleatorio = rand(1, 1000);
    } while ($aleatorio % $num != 0); 

    echo "Número aleatorio generado: $aleatorio <br>";
    echo "¡El número $aleatorio es múltiplo de $num!<br>";
    }
?>
