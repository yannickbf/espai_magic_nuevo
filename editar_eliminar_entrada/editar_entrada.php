<?php 
if( isset($_POST['editar_entrada_blog'])){
    $id = $_POST['id_entrada'];
    $titulo = $_POST['titulo_entrada'];
    $descripcion = $_POST['descripcion_entrada'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espai Màgic - Editar entrada del blog</title>
</head>
<body>
    <div class="contenedor_entrada_editar">
        <form method='POST' action='guardar_cambios_edicion.php'>
            <input type='hidden' name='id_entrada_guardar' value='<?php echo $id ?>'>
            <label>Titulo:</label><br>
            <input type='text' name='titulo_entrada_guardar' value='<?php echo $titulo; ?>'><br>
            <label>Descripción:</label><br>
            <textarea name='descripcion_entrada_guardar'><?php echo $descripcion ?></textarea>
            <br><br>
            <input type='submit' name='guardar_entrada' value='Guardar cambios'>
        </form>
    </div>
    <a href="index.php"><--Volver</a>
</body>
</html>