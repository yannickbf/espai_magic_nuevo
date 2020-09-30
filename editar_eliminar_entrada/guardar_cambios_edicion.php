<?php
if( isset($_POST['guardar_entrada'])){

    $id = $_POST['id_entrada_guardar'];
    $titulo = $_POST['titulo_entrada_guardar'];
    $descripcion = $_POST['descripcion_entrada_guardar'];

    //Si no han rellenado algun campo mostramos mensaje
    if($titulo == "" || $descripcion == ""){
        echo "<h1>Debes rellenar un titulo y una descripcion</h1>";
        echo '<a href="javascript:history.back()"> <--Volver a edicion</a>';
    }
    //Si han rellenado hacemos los cambios
    else{
        //Cargamos XML
        $xml = simplexml_load_file('../xml/entradas_blog.xml');

        //Guardamos en una variable los nodos entrada_blog para recorrer sus subnodos
        $entrada_blog = $xml->entrada_blog;

        //Contamos cuantos nodos entrada_blog tenemos
        $cuenta_entradas_blog = $xml->entrada_blog->count();

        //Cargamos el xml en un nuevo documento
        $doc = new DOMDocument;
        $doc->load('../xml/entradas_blog.xml');
        //Guardamos en una variable el documento como documentElement
        $entradas = $doc->documentElement;

        //Buscamos la entrada de blog que tenga el mismo id que se nos ha pasado y si tiene el mismo id editamos todo el nodo entrada_blog diciendole la posicion
        $seguir_buscando = true;
        $i=0;
        while($seguir_buscando){
            if($entrada_blog[$i]->id == $id){

                //Cambiamos el contenido del XML con el nuevo contenido editado
                $entradas->getElementsByTagName('entrada_blog')->item($i)->getElementsByTagName('titulo')->item(0)->nodeValue = $titulo;
                $entradas->getElementsByTagName('entrada_blog')->item($i)->getElementsByTagName('descripcion')->item(0)->nodeValue = $descripcion;

                //Guardamos los cambios en el archivo xml
                $doc->save('../xml/entradas_blog.xml');

                //Mostramos mensaje editado con exito
                echo "<h1>Editado con exito!!</h1> <a href='index.php'><<-Volver a editar/eliminar</a>";

                //Pasamos $seguir_buscando a false para detener el bucle
                $seguir_buscando = false;
            }
            else{
                $i++;
            }
        }
    }    
}
?>