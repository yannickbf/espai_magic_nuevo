<?php
//Cargamos XML
$xml = simplexml_load_file('../xml/entradas_blog.xml');

//Guardamos en una variable los nodos entrada_blog para recorrer sus subnodos
$entrada_blog = $xml->entrada_blog;

//Contamos cuantos nodos entrada_blog tenemos
$cuenta_entradas_blog = $xml->entrada_blog->count();

//Codigo para mostrar todas las entradas con sus botones de eliminar y editar
//Guardaremos los resultados formateados en HTML en una variable
$resultados = "";
    
//Guardamos y mostramos (en la parte de html) todas las entradas. Añadimos boton para eliminar. Cuando cliquemos en eliminar nos manda un POST con el id y el titulo a confirmar_eliminar.php
//Recorremos los subnodos de entrada_blog inversamente, para tener las ultimas entradas primero y lo guardamos todo en $resultados
for($i=$cuenta_entradas_blog-1;$i>=0;$i--){
    $resultados .= "<div class='contenedor_entrada_blog'>";
    $resultados .= "<h1>".$entrada_blog[$i]->titulo."</h1>";
    $resultados .= "<span>Fecha envio: ".$entrada_blog[$i]->fecha."</span>";
    $resultados .= "<p>".$entrada_blog[$i]->descripcion."</p><br>";
    //El siguiente codigo es para mostrar las imagenes con boton de eliminar funcional
    //Guardamos en una variable los nodos imagen de la entrada en la que nos encontramos
    $nodos_img = $entrada_blog[$i]->getElementsByTagName('imagen');
    $nodos
    $entrada_a_eliminar = $entrada_blog[$i]->getElementsByTagName('imagen')->item($i);
    $resultados .= "";
    //Creamos un form para eliminar una entrada, si le dan a eliminar pasaremos por metodo POST el id para que lo elimine del XML
    $resultados .= "<form method='POST' action='confirmar_eliminar.php'>";
    $resultados .= "<input type='hidden' name='id_entrada' value='".$entrada_blog[$i]->id."'>"; //Le pasamos el id a eliminar
    $resultados .= "<input type='hidden' name='titulo_entrada' value='".$entrada_blog[$i]->titulo."'>"; //Le pasamos el titulo a eliminar
    $resultados .= "<input type='submit' name='confirmar_eliminar_entrada' value='Elimina esta entrada del blog'>";
    $resultados .= "</form><br>";
    //Creamos un form para editar una entrada, le pasamos los datos necesarios a editar_entrada.php, donde se podra modificar el texto y guardar cambios en el XML
    $resultados .= "<form method='POST' action='editar_entrada.php'>";
    $resultados .= "<input type='hidden' name='id_entrada' value='".$entrada_blog[$i]->id."'>"; //Le pasamos el id a editar
    $resultados .= "<input type='hidden' name='titulo_entrada' value='".$entrada_blog[$i]->titulo."'>"; //Le pasamos el titulo a editar
    $resultados .= "<input type='hidden' name='descripcion_entrada' value='".$entrada_blog[$i]->descripcion."'>"; //Le pasamos la descripcion a editar
    $resultados .= "<input type='submit' name='editar_entrada_blog' value='Edita esta entrada del blog'>";
    $resultados .= "</form>";
    $resultados .= "</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Espai Màgic - Modificar/eliminar entradas del blog</title>
</head>
<body>
    <h1>Editar/eliminar entradas del blog</h1>
    <br>
    <a href="../index.html" class="botones_volver_atras"> <--Volver al panel de administración</a>
    <br><br>
    <!--Mostramos resultados-->
    <?php echo $resultados; ?>
</body>
</html>