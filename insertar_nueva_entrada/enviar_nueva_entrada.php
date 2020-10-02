<?php
    // Agregar info a XML
    // Se ejecuta cuando enviamos por $_POST en la misma pagina
    if( isset($_POST['mv'])){

        //Guardamos el titulo y descripcion obtenidos por $_POST
        $Titulo = $_POST['Titulo'];
        $Descripcion = $_POST['Descripcion'];

        //Si no han rellenado algun campo mostramos mensaje
        if($Titulo == "" || $Descripcion == ""){
            echo "<h1>Debes rellenar un titulo y una descripcion</h1>";
            echo '<a href="javascript:history.back()"> <--Volver a edicion</a>';
        }
        //Si han rellenado insertamos la entrada con un id +1 que el ultimo
        else{
            //Cambiamos la zona horaria
            date_default_timezone_set("Europe/Madrid");
            //Obtenemos la fecha con date y la formateamos para que se muestre como queremos
            $hoy = date("j/n/Y, g:i a"); 

            //Cargamos el XML desde un archivo xml
            $xml = simplexml_load_file('../xml/entradas_blog.xml');

            //ATENCION he intentado obtener el ultimo entrada_blog con [-1] para cojer directamente el ultimo nodo y con lastChild.
            //No lo he conseguido y no encuentro info en internet, asi que he obtenido la ultima posicion de la siguiente manera:

            //$id_ultimo_elemento_lastChild = $xml->lastChild->id;
            //echo "hola ".$id_ultimo_elemento_lastChild;
            
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
            echo "<h1>Subido con exito!!</h1>";

            //Preguntamos si quiere añadir imagen y si quiere le mandamos a la pagina para añadir pasandole el id
            echo "<h1>Quieres añadir alguna imagen a la entrada que acabas de publicar? Añadela aqui, si quieres añadir varias añade la primera, subela y añade otra, puedes añadir todas las que quieras. De lo contrario tu post ya esta publicado puedes volver al panel de administrácion, cerrar esta ventana, o lo que desés</h1>";
            echo '<form action="upload.php" method="post" enctype="multipart/form-data" id="form_img">
            <span>Elegir archivo: </span><input type="file" name="fileToUpload" id="fileToUpload"> 
            <input type="hidden" name="id_entrada_imagen" value="'.$id_entrada_blog.'">
            <input type="submit" value="Subir imagen" name="submit"><br>
            </form>';

            //Mostramos link para volver al panel de administracion
            echo "<a href='../index.html'><--Volver al panel de administracion</a>";
        }

        
    }
?>
