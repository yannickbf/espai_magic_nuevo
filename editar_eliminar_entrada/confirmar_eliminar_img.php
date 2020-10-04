<?php 
if( isset($_POST['boton_eliminar_img'])){
    echo '<h1>Seguro que quieres eliminar la foto?</h1>';
    echo "<form method='POST' action='eliminar_img.php'>";
    echo "<input type='hidden' name='id_entrada' value='".$_POST['id_entrada']."'>";
    echo "<input type='hidden' name='posicion_img' value='".$_POST['posicion_img']."'>";
    echo "<input type='hidden' name='nombre_imagen' value='".$_POST['nombre_imagen']."'>";
    echo "<input type='submit' name='boton_eliminar_img' value='Si'>";
    echo "</form>";
    echo '<br><a href="index.php" class="botones_volver_atras"> <--Volver atrás</a>';
}
?>