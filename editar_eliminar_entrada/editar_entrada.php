<?php 
if( isset($_POST['editar_entrada'])){

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
        <form method='POST' action='eliminar_entrada.php'>
            <input type='hidden' name='id_entrada_eliminar' value='<?php echo $id; ?>'>
            <input type='submit' name='eliminar_entrada' value='Si'>
        </form>
    </div>
</body>
</html>