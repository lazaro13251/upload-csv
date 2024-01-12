<?php
/* Establecer los detalles de conexión a la base de datos: */
$host = "127.0.0.1";
$user = "root";
$pass = "lamp";
$db = "tienda";
/* Establecer la conexión con la base de datos: */
$conn = mysqli_connect($host, $user, $pass, $db);
/* Verificar si la conexión se estableció correctamente: */
if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}
echo "Conexión exitosa!";
/* Comprobar si el formulario ha sido enviado: */
if (isset($_POST["submit"])) {
  /* Obtener la información del archivo CSV: */
  $csv_file = $_FILES["csv_file"]["tmp_name"];
  $csv_file_name = $_FILES["csv_file"]["name"];
  $csv_file_type = $_FILES["csv_file"]["type"];
  /* Obtener la información del archivo CSV: */
  if ($csv_file_type != "text/csv") {
    echo "Solo se permiten archivos CSV.";
    exit;
  }
  /* Mover el archivo CSV a la ruta especificada: */
  $csv_file_destination = "/var/www/LazaruxServer/csv/" . $csv_file_name;
  if (move_uploaded_file($csv_file, $csv_file_destination)) {
    /* Cargar los datos del archivo CSV en la tabla MySQL: */
    /* Se establece el nombre de la tabla donde se cargarán los datos: */
    $table_name = "articulos";
    /* Se abre el archivo CSV */
    $handle = fopen($csv_file_destination, "r");
    /* Se ignora la primera línea del archivo CSV (encabezados): */
    fgetcsv($handle);
    /* Se cargan los datos del archivo CSV en la tabla MySQL: */
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $query = "INSERT INTO articulos(id, nombre, descripcion, precio, cantidad) VALUES (NULL, '$data[0]', '$data[1]', '$data[2]', '$data[3]')";
      mysqli_query($conn, $query);
    }
    /* Se cierra el archivo CSV */
    fclose($handle);
    /* Se muestra un mensaje de éxito */
    echo "Se han insertado " . mysqli_affected_rows($conn) . " filas en la tabla.";
  } else {
    /* Si no se pudo mover el archivo, mostrar un mensaje de error */
    echo "Hubo un problema al cargar el archivo CSV.";
  }
}
// Mostrar el formulario para seleccionar el archivo CSV
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <form method="post" enctype="multipart/form-data" class="form-inline">
    <div class="form-group">
      <label for="csv_file">Seleccionar archivo CSV:</label>
      <input type="file" name="csv_file" id="csv_file" class="form-control-file">
    </div>
    <button type="submit" name="submit" value="Cargar datos" class="btn btn-primary mt-3">Cargar datos</button>
  </form>
  </div>
</body>

</html>