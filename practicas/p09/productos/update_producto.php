<?php
/* MySQL Conexion*/
$link = mysqli_connect("localhost", "root", "Tec&12Web", "marketzone");
// Chequea conexion
if($link === false){
die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}
  // Verificar el envío del ID 
    if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
        die("ID de producto no válido");
    }

    $id = intval($_POST['id']); 
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $detalles = $_POST['descripcion']; 
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];

    if(!empty($_FILES['imagen']['name'])){
        $imagen = 'img/'.basename($_FILES['imagen']['name']); 
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    } else {
        $imagen = $_POST['imagen_defecto']; 
    }

    // Consulta sql para la actualizacion del campo 
    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, detalles = ?, precio = ?, unidades = ?, imagen = ? WHERE id = ?";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssssdisi", $nombre, $marca, $modelo, $detalles, $precio, $unidades, $imagen, $id); 

    // se acutaliza 
    if($stmt->execute()){
        echo "<p>Producto actualizado exitosamente</p>"; 
    } else {
        die("No fue posible actualizar el producto: " . $stmt->error); 
    }

    // Cierra la conexion
    mysqli_close($link);

    echo '<a href="get_productos_xhtml_v2.php">Ver productos en XHTML</a> <br>';
    echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';

?>