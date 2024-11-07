<?php
require 'utils/utils.php';
require 'entities/File.class.php';
require 'entities/ImagenGaleria.class.php';
require 'entities/connection.class.php';
require_once 'entities/QuerryBuilder.class.php';
require_once 'exceptions/AppException.class.php';
require_once 'repository/ImagenGalariaRepository.class.php';

$errores = [];
$descripcion = '';
$mensaje = '';
try {
    $config = require_once 'app/config.php';

    App::bind('config', $config);

    $imagenRepository = new ImagenGaleriaRepository();

    // $connection = App::getConnection(); // Si funciona elimina el database en config.php y quitas los corchetes aqui

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        $tipoAceptados = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];

        $imagen = new File('imagen', $tipoAceptados);

        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        // Si ocurre la función saveUploadFile es porque la imagen se ha subido correctamente
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTAFOLIO);

        // $sql = "INSERT INTO imagenes (nombre,descripcion) VALUES (:nombre,:descripcion)";
        // $pdoStatement = $connection->prepare($sql);
        // $parametersStatementArray = [':nombre' => $imagen->getFileName(), ':descripcion' => $descripcion];
        // //Lanzamos la sentencia y vemos si se ha ejecutado correctamente.
        // $response = $pdoStatement->execute(($parametersStatementArray));
        // if ($response === false) {
        //     $errores[] = 'No se ha podido guardar la imagen en la base de datos.';
        // } else {
        //     $descripcion = '';
        //     $mensaje = 'Imagen guardada';
        // }
        // $querrySql = 'SELECT * FROM imagenes';
        // $querryStatement = $connection->query($querrySql);

        $imagenGaleria = new ImagenGaleria($imagen->getFileName(),$descripcion);
        $imagenRepository->save($imagenGaleria);
        $descripcion='';
        $mensaje = 'Imagen guardada';
    }
} catch (FileException $exception) {
    $errores[] = $exception->getMessage();
} catch (QuerryException $exception) {
    $errores[] = $exception->getMessage();
} catch (AppException $exception) {
    $errores[] = $exception->getMessage();
} finally {
    
    $imagenes = $imagenRepository->findAll();
}
require 'views/galeria.view.php';
