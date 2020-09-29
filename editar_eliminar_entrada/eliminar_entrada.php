<?php
//Cuando confirmamos que queremos eliminar nos manda aqui
//Eliminamos la entrada del archivo XML buscando su id
if( isset($_POST['eliminar_entrada'])){

    //Cargamos XML
    $xml = simplexml_load_file('../xml/entradas_blog.xml');

    //Guardamos en una variable los nodos entrada_blog para recorrer sus subnodos
    $entrada_blog = $xml->entrada_blog;

    //Contamos cuantos nodos entrada_blog tenemos
    $cuenta_entradas_blog = $xml->entrada_blog->count();

    //Guardamos en una variable el id que queremos eliminar
    $id_eliminar = $_POST['id_entrada_eliminar'];
    
    //Cargamos el xml en un nuevo documento
    $doc = new DOMDocument;
    $doc->load('../xml/entradas_blog.xml');
    //Guardamos en una variable el documento como documentElement
    $entradas = $doc->documentElement;

    //Buscamos la entrada de blog que tenga el mismo id que se nos ha pasado y si tiene el mismo id eliminamos todo el nodo entrada_blog diciendole la posicion y detenemos el bucle
    $seguir_buscando = true;
    $i=0;
    while($seguir_buscando){
        if($entrada_blog[$i]->id == $id_eliminar){

            //Guardamos en una variable la entrada a eliminar y la eliminamos
            $entrada_a_eliminar = $entradas->getElementsByTagName('entrada_blog')->item($i);
            $eliminar_entrada = $entradas->removeChild($entrada_a_eliminar);

            //Guardamos los cambios en el archivo xml
            $doc->save('../xml/entradas_blog.xml');

            //Mostramos mensaje eliminado con exito
            echo "<h1>Eliminado con exito!!</h1> <a href='index.php'><--Volver</a>";

            //Pasamos $seguir_buscando a false para detener el bucle
            $seguir_buscando = false;
        }
        else{
            $i++;
        }
    }
}


?>