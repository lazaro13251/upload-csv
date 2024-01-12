<?php
// Consulta para obtener los departamentos existentes
$sql = "SELECT nombre FROM departamentos";
$result = $conexion->query($sql);
// Mostrar los departamentos en el select
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value=\"" . $row["nombre"] . "\">" . $row["nombre"] . "</option>";
    }
} else {
    echo "<option value=\"\">No hay departamentos disponibles</option>";
}
// Cerrar la conexión
$conexion->close();