<?php
    include_once __DIR__.'/database.php';

    $data = array();
    //Cambios, ahora se puede buscar por nombre u otros detalles del porducto
    if(isset($_POST['id'])) {
        $id = $conexion->real_escape_string($_POST['id']); // Evitamos inyecciones SQL
        $query = "SELECT * FROM productos WHERE id = '$id' OR nombre LIKE '%$id%' OR marca LIKE '%$id%' OR modelo LIKE '%$id%' OR detalles LIKE '%$id%'";
        
        if($result = $conexion->query($query)) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
            } else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>

