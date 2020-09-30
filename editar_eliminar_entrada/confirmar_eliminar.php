<?php
//Cuando clicamos en eliminar nos manda aqui
//Preguntaremos una confirmacion de que quiere eliminar
if( isset($_POST['confirmar_eliminar_entrada'])){
    $id = $_POST['id_entrada'];
    $titulo = $_POST['titulo_entrada'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espai Màgic - Eliminar entrada del blog</title>
</head>
<body>
    <!--Preguntamos si quiere eliminar. En caso afirmativo lo eliminamos mandando por action el id de la entrada a eliminar_entrada.php-->
    <h1>Estas seguro/a de que quieres eliminar la entrada: <?php echo $titulo; ?>? Si la borras no la podras recuperar</h1>
    <form method='POST' action='eliminar_entrada.php'>
        <input type='hidden' name='id_entrada_eliminar' value='<?php echo $id; ?>'>
        <input type='submit' name='eliminar_entrada' value='Si'>
    </form>
    <br>
    <a href="index.php"><<-Volver a editar/eliminar</a>
</body>
</html>
