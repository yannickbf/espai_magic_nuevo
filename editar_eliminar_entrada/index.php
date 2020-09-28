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
    
//Guardamos y mostramos (en la parte de html) todas las entradas. Añadimos boton para eliminar. Cuando cliquemos en eliminar nos manda un POST con el id y el titulo a eliminar_entrada.php
//Recorremos los subnodos de entrada_blog inversamente, para tener las ultimas entradas primero y lo guardamos todo en $resultados
for($i=$cuenta_entradas_blog-1;$i>=0;$i--){
    $resultados .= "<h1>".$entrada_blog[$i]->titulo."</h1>";
    $resultados .= "<span>Fecha envio:".$entrada_blog[$i]->fecha."</span>";
    $resultados .= "<p>".$entrada_blog[$i]->descripcion."</p>";
    //Guardamos el id de la entrada, si le dan a eliminar se lo pasaremos por metodo POST para que lo elimine
    $id_entrada = $entrada_blog[$i]->id;
    $resultados .= "<form method='POST' action='index.php'>";
    $resultados .= "<input type='hidden' name='id_entrada' value='".$id_entrada."'>"; //Le pasamos el id a eliminar
    $resultados .= "<input type='submit' name='eliminar_entrada' value='Elimina esta entrada del blog'>";
    $resultados .= "</form>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espai Màgic - Modificar/eliminar entradas del blog</title>
</head>
<body>
    <!--Mostramos resultados-->
    <?php echo $resultados; ?>
</body>
</html>