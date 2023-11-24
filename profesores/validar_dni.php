<?php
// Conexion a la bd
$servername = "localhost";
$username = "root";
$password = ""; // Cambiar si es necesario
$database = "pp2-final";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["dni"];

    // Consultar la base de datos para verificar las credenciales y obtener el rol_id
    $sql = "SELECT Roles_id_rol FROM usuario WHERE DNI='$dni'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol_id = $row["Roles_id_rol"];

        // Verificar si el rol_id es 3
        if ($rol_id == 3) {
            header("Location: ../regentes/inicio_regencia.html");
            exit;
        } else {
            echo "El usuario no tiene permisos para acceder a esta página.";
        }
    } else {
        echo "Credenciales incorrectas";
    }
}

$conn->close();
