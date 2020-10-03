<?php
$target_dir = "imagenes/"; //directorio en el que se subira
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);//se añade el directorio y el nombre del archivo
$uploadOk = 1;//se añade un valor determinado en 1
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Comprueba si el archivo de imagen es una imagen real o una imagen falsa
if(isset($_POST["submit"])) {//detecta el boton
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {//si es falso es una imagen y si no lanza error
        echo "Archivo es una imagen- " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen";
        $uploadOk = 0;
    }

    //Podemos añadir mas imagenes con este codigo, subimos 1, vuelve a cargar la misma pagina y subimos otra
    echo "<h1>Quieres añadir otra imagen? Puedes hacerlo aqui a bajo, sube todas las que quieras</h1><h2>Si por la razon que sea no has podido subir la imagen puedes reintentarlo aqui tambien.</h2>";
    echo '<form action="upload.php" method="post" enctype="multipart/form-data" id="form_img">
            <span>Elegir archivo: </span><input type="file" name="fileToUpload" id="fileToUpload"> 
            <input type="hidden" name="id_entrada_imagen" value="'.$_POST['id_entrada_imagen'].'">
            <input type="submit" value="Subir imagen" name="submit"><br>
            </form>';
}
// Comprobar si el archivo ya existe
if (file_exists($target_file)) {
    echo "El archivo ya existe";
    $uploadOk = 0;//si existe lanza un valor en 0
}
// Comprueba el peso
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Perdon pero el archivo es muy pesado";
    $uploadOk = 0;
}
// Permitir ciertos formatos de archivo
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo " Perdon solo, JPG, JPEG, PNG & GIF Estan soportados";
    $uploadOk = 0;
}
//Comprueba si $ uploadOk se establece en 0 por un error
if ($uploadOk == 0) {
    echo "<font color='red'> Perdon, pero el archivo no se subio</font> <br><a href='index.html'><<-Volver a el panel de control</a>";
// si todo está bien, intenta subir el archivo
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<font color='green'> El archivo ". basename( $_FILES["fileToUpload"]["name"]). " Se subio correctamente </font>";
        echo $target_file;

        //Si se subio correctamente añadiremos un nodo <imagen> al XML de las entradas con el nombre del archivo

        //Cargamos el XML desde un archivo xml
        $xml = simplexml_load_file('xml/entradas_blog.xml');

        //Guardamos en una variable los nodos entrada_blog para recorrer sus subnodos
        $entrada_blog = $xml->entrada_blog;

        //Buscamos la entrada de blog que tenga el mismo id que se nos ha pasado y si tiene el mismo id le añadimos el nombre del archivo en un nuevo nodo llamado imagenes
        $seguir_buscando = true;
        $i=0;
        while($seguir_buscando){
            if($entrada_blog[$i]->id == $_POST['id_entrada_imagen']){

                //Añadimos el nombre del archivo de la imagen a un nuevo nodo llamado imagen
                $anadir_img = $xml->entrada_blog[$i]->addChild('imagen',$_FILES["fileToUpload"]["name"]);

                //Guardamos la nueva entrada en el arxivo XML
                file_put_contents('xml/entradas_blog.xml',$xml->asXML());

                //Mostramos mensaje diciendo que se ha añadido al XML correctamente
                echo "<h1>Se ha guardado el nombre del archivo de la imagen en el XML!!</h1> <a href='index.html'><<-Volver a el panel de control</a>";

                //Pasamos $seguir_buscando a false para detener el bucle
                $seguir_buscando = false;
            }
            else{
                $i++;
            }
        }
        
    } else {
        echo "Error al cargar el archivo";
    }
}
?>
