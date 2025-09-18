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

    function arregloAscii(){
        $indices=[]; 
        for($i=97; $i<=122; $i++){
            $indices[$i] = chr($i); 
        }
        
        echo "<table>"; 
        echo "<tr><th>Indice</th><th>Letra</th></tr>";
        foreach ($indices as $key =>$value){
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    }

    function mayorEdad($edad, $sexo){
        
        if($sexo=="Femenino" && $edad >=18 && $edad <=35){
            return "Bienvenida, usted está en el rango de edad apropiado."; 
        }
        else{
            return "Error, no se pudo obtener respusta."; 
        }
    }

    $autos = array(
    'ABC1001' => array(
        'auto' => array('marca' => 'HONDA', 'modelo' => '2022', 'tipo' => 'Camioneta'),
        'Propietario' => array('nombre' => 'Roberto Castillo', 'ciudad' => 'Puebla', 'direccion' => 'C. 5 de Mayo 12')
    ),
    'DEF1002' => array(
        'auto' => array('marca' => 'MAZDA', 'modelo' => '2020', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Jimena Soto', 'ciudad' => 'San Andrés Cholula', 'direccion' => 'Av. 3 Poniente 8')
    ),
    'GHI1003' => array(
        'auto' => array('marca' => 'TOYOTA', 'modelo' => '2021', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Miguel Vélez', 'ciudad' => 'Tepeaca', 'direccion' => 'C. Colón 5')
    ),
    'JKL1004' => array(
        'auto' => array('marca' => 'FORD', 'modelo' => '2019', 'tipo' => 'Hatchback'),
        'Propietario' => array('nombre' => 'Gabriela Morales', 'ciudad' => 'Atlixco', 'direccion' => 'C. Hidalgo 3')
    ),
    'MNO1005' => array(
        'auto' => array('marca' => 'CHEVROLET', 'modelo' => '2021', 'tipo' => 'Camioneta'),
        'Propietario' => array('nombre' => 'Daniela Fernández', 'ciudad' => 'Puebla', 'direccion' => 'Col. La Paz 4')
    ),
    'PQR1006' => array(
        'auto' => array('marca' => 'NISSAN', 'modelo' => '2023', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Fernando Gutiérrez', 'ciudad' => 'Teziutlán', 'direccion' => 'Barrio Francia 2')
    ),
    'STU1007' => array(
        'auto' => array('marca' => 'KIA', 'modelo' => '2020', 'tipo' => 'Hatchback'),
        'Propietario' => array('nombre' => 'Javier Mendoza', 'ciudad' => 'Zacatlán', 'direccion' => 'C. Leandro 6')
    ),
    'VWX1008' => array(
        'auto' => array('marca' => 'HYUNDAI', 'modelo' => '2022', 'tipo' => 'Camioneta'),
        'Propietario' => array('nombre' => 'Luisa Rojas', 'ciudad' => 'San Pedro Cholula', 'direccion' => 'C. 2 Norte 1')
    ),
    'YZA1009' => array(
        'auto' => array('marca' => 'MITSUBISHI', 'modelo' => '2021', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Ricardo Nava', 'ciudad' => 'Tehuacán', 'direccion' => 'Col. México 10')
    ),
    'BCD1010' => array(
        'auto' => array('marca' => 'VOLKSWAGEN', 'modelo' => '2019', 'tipo' => 'Hatchback'),
        'Propietario' => array('nombre' => 'Verónica Castro', 'ciudad' => 'Amozoc', 'direccion' => 'Barrio San Antonio 7')
    ),
    'EFG1011' => array(
        'auto' => array('marca' => 'AUDI', 'modelo' => '2022', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Adrián Jiménez', 'ciudad' => 'Puebla', 'direccion' => 'Angelópolis 9')
    ),
    'HIJ1012' => array(
        'auto' => array('marca' => 'BMW', 'modelo' => '2020', 'tipo' => 'Camioneta'),
        'Propietario' => array('nombre' => 'Sofía Corona', 'ciudad' => 'Izúcar de Matamoros', 'direccion' => 'Plaza 2')
    ),
    'KLM1013' => array(
        'auto' => array('marca' => 'MERCEDES', 'modelo' => '2021', 'tipo' => 'Hatchback'),
        'Propietario' => array('nombre' => 'Óscar Benítez', 'ciudad' => 'Tehuacán', 'direccion' => 'Agua Blanca 4')
    ),
    'NOP1014' => array(
        'auto' => array('marca' => 'HONDA', 'modelo' => '2008', 'tipo' => 'Sedan'),
        'Propietario' => array('nombre' => 'Mariana Paredes', 'ciudad' => 'Puebla', 'direccion' => 'Amalucan 11')
    ),
    'QRS1015' => array(
        'auto' => array('marca' => 'JEEP', 'modelo' => '2023', 'tipo' => 'Camioneta'),
        'Propietario' => array('nombre' => 'Alejandro Flores', 'ciudad' => 'Chignahuapan', 'direccion' => 'Laguna 1')
    )
    );


    function autoMatricula($matricula){
        global $autos;
        if (array_key_exists($matricula, $autos)) {
            $auto = $autos[$matricula];
            echo "<h2>Información del Auto</h2>";
            echo "<p>Matrícula: $matricula</p>";
            echo "<p>Marca: " . $auto["auto"]["marca"] . "</p>";
            echo "<p>Modelo: " . $auto["auto"]["modelo"] . "</p>";
            echo "<p>Tipo: " . $auto["auto"]["tipo"] . "</p>";
            echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
            echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
            echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
        } else {
            echo "<p>La matrícula no existe en el registro.</p>";
        }
    }

    function todosLosAutos(){
        global $autos;
        foreach ($autos as $matricula => $auto) {
            echo "<h3>Matrícula: $matricula</h3>";
            echo "<p>Marca: " . $auto["auto"]["marca"] . "</p>";
            echo "<p>Modelo: " . $auto["auto"]["modelo"] . "</p>";
            echo "<p>Tipo: " . $auto["auto"]["tipo"] . "</p>";
            echo "<p>Nombre del Propietario: " . $auto["Propietario"]["nombre"] . "</p>";
            echo "<p>Ciudad: " . $auto["Propietario"]["ciudad"] . "</p>";
            echo "<p>Dirección: " . $auto["Propietario"]["direccion"] . "</p>";
            echo "<hr>";
        }
    }
?>
