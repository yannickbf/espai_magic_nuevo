<?php
    // Agregar info a XML
    // Se ejecuta cuando enviamos por $_POST en la misma pagina
    if( isset($_POST['mv'])){
        //Cambiamos la zona horaria
        date_default_timezone_set("Europe/Madrid");
        //Obtenemos la fecha con date y la formateamos para que se muestre como queremos
        $hoy = date("j/n/Y, g:i a"); 

        //Guardamos el titulo y descripcion obtenidos por $_POST
        $Titulo = $_POST['Titulo'];
        $Descripcion = $_POST['Descripcion'];

        //Cargamos el XML desde un archivo xml
        $xml = simplexml_load_file('../xml/entradas_blog.xml');

        //ATENCION he intentado obtener el ultimo entrada_blog con [-1] para cojer directamente el ultimo nodo y con lastChild.
        //No lo he conseguido y no encuentro info en internet, asi que he obtenido la ultima posicion de la siguiente manera:

        //Contamos las entradas del nodo entrada_blog
        $contar_entradas_blog = $xml->entrada_blog->count();

        //Le restamos 1 para obtener la posicion de la ultima entrada
        $contar_entradas_blog--;

        //Guardamos el id de la ultima entrada
        $id_ultimo_elemento = $xml->entrada_blog[$contar_entradas_blog]->id;

        //Guardamos el id de la nueva entrada, para ello le sumamos +1 a la ultima entrada
        $id_entrada_blog = $id_ultimo_elemento+1;
        
        //Creamos un nodo entrada_blog y lo guardamos en la variable $entrada_blog
        $entrada_blog = $xml->addChild('entrada_blog');

        //Creamos los subnodos con su informacion correspondiente que hemos obtenido
        $entrada_blog->addChild('id',$id_entrada_blog);
        $entrada_blog->addChild('fecha',$hoy);
        $entrada_blog->addChild('titulo',$Titulo);
        $entrada_blog->addChild('descripcion',$Descripcion);

        //Guardamos la nueva entrada en el arxivo XML
        file_put_contents('../xml/entradas_blog.xml',$xml->asXML());

        //Mostramos mensaje confirmando que se ha subido la entrada
        echo "<h1>Subido con exito!!</h1> <a href='index.html'><--Volver</a>";
    }
?>
