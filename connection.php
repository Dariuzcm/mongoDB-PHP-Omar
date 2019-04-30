<?php 
 require 'vendor/autoload.php'; // include Composer's autoloader
 //Conectar al servidor
 $connection = new MongoDB\Client("mongodb://localhost:27017");
 //Conectar a la base de datos
 $db = $connection->Reyna_jose;
 //Acceder a la collection
 $library_collection = $db->biblioteca;

$result = $library_collection->find();


echo "Valores encontrados: \n<br>";

foreach ($result as $entry) {
  echo "<strong>Nombre del Libro: </strong>".$entry['nombre_libro'], ': ', "<strong>Año de edición:</strong>".$entry['ed_year'], "\n <br>";
}

?>