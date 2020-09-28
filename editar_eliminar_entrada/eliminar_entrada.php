<?php
//Cuando confirmamos que queremos eliminar nos manda aqui
//Eliminamos la entrada del archivo XML buscando su id
if( isset($_POST['eliminar_entrada'])){

    //Guardamos en una variable el id que queremos eliminar
    $id_eliminar = $_POST['id_entrada_eliminar'];
    
    //Cargamos el xml en un nuevo documento
    $doc = new DOMDocument;
    $doc->load('../xml/entradas_blog.xml');
    //Guardamos en una variable el documento como documentElement
    $entradas = $doc->documentElement;
}
?>