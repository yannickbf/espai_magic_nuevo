<?php
if( isset($_POST['boton_eliminar_img'])){

    //Cargamos XML
    $xml = simplexml_load_file('../xml/entradas_blog.xml');

    //Guardamos en una variable los nodos entrada_blog para recorrer sus subnodos
    $entrada_blog = $xml->entrada_blog;

    //Contamos cuantos nodos entrada_blog tenemos
    $cuenta_entradas_blog = $xml->entrada_blog->count();

    //Guardamos en una variable el id que queremos eliminar
    $id_borrar_img = $_POST['id_entrada'];
    
    //Cargamos el xml en un nuevo documento
    $doc = new DOMDocument;
    $doc->load('../xml/entradas_blog.xml');
    //Guardamos en una variable el documento como documentElement
    $entradas = $doc->documentElement;

    //Buscamos la entrada de blog que tenga el mismo id que se nos ha pasado y si tiene el mismo id eliminamos la imagen con la posicion que tambien se nos ha pasado
    $seguir_buscando = true;
    $i=0;
    while($seguir_buscando){
        if($entrada_blog[$i]->id == $id_borrar_img){

            //Guardamos en una variable la imagen que queremos borrar y la borramos
            $img_a_eliminar = $entradas->getElementsByTagName('entrada_blog')->item($i)->getElementsByTagName('imagen')->item($_POST['posicion_img']);
            $eliminar_img = $entradas->getElementsByTagName('entrada_blog')->item($i)->removeChild($img_a_eliminar);

            //Guardamos los cambios en el archivo xml
            $doc->save('../xml/entradas_blog.xml');

            //Borramos la imagen de nuestro servidor
            $nombre_img = $_POST['nombre_imagen'];
            unlink('../imagenes/'.$nombre_img);

            //Mostramos mensaje eliminado con exito
            echo "<h1>Eliminado con exito!!</h1> <a href='index.php'><<-Volver a editar/eliminar</a>";

            //Pasamos $seguir_buscando a false para detener el bucle
            $seguir_buscando = false;
        }
        else{
            $i++;
        }
    }

}
?>