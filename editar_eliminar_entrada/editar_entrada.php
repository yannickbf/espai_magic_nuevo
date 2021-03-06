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
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Espai Màgic - Editar entrada del blog</title>
</head>
<body>
    
    <!-- Form para cambiar el titulo y descripcion de la entrada -->
    <form method='POST' action='guardar_cambios_edicion.php' class="contenedor_entrada_editar">
        <input type='hidden' name='id_entrada_guardar' value='<?php echo $id ?>'>
        <label><b>Titulo:</b></label><br>
        <input type='text' name='titulo_entrada_guardar' value='<?php echo $titulo; ?>'><br><br>
        <label><b>Descripción:</b></label><br>
        <textarea name='descripcion_entrada_guardar'><?php echo $descripcion ?></textarea>
        <br><br>
        <input type='submit' name='guardar_entrada' value='Guardar cambios'>
    </form><br>

    <!-- Form para añadir imagenes -->
    <form action="../upload.php" method="post" enctype="multipart/form-data" id="form_img" class="contenedor_entrada_editar_anadir_imagen">
        <label><b>Sube imagenes</b></label><br><br>
        <span>Elegir archivo: </span><input type="file" name="fileToUpload" id="fileToUpload"><br><br>
        <input type="hidden" name="id_entrada_imagen" value="<?php echo $id ?>">
        <input type="submit" value="Subir imagen" name="submit"><br>
    </form>

    <br><br>
    <a href="index.php" class="botones_volver_atras"> <--Volver a editar/eliminar entradas</a>
    <br><br>
    <a href="../index.html" class="botones_volver_atras"> <--Volver al panel de administración</a>
</body>
</html>
