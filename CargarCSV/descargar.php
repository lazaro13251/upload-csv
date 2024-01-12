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
echo "Conexión exitosa!" . "<br>";

// Obtener los datos de la tabla
$query = "SELECT * FROM articulos";
echo $query . "<br>";
$result = mysqli_query($conn, $query);

// Crear el archivo CSV
$csv_filename = "articulos.csv";
$csv_file = fopen($csv_filename, "w");

// Agregar los encabezados al archivo CSV
$headers = array("ID", "Nombre", "Descripción", "Precio", "Cantidad");
fputcsv($csv_file, $headers);

// Agregar los datos al archivo CSV
while ($row = mysqli_fetch_assoc($result)) {
  fputcsv($csv_file, $row);
}

// Cerrar el archivo CSV
fclose($csv_file);

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Descargar CSV</title>
</head>

<body>
  <a href="<?php echo $csv_filename; ?>" download>Descargar CSV</a>
</body>

</html>