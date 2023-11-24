<?php
// Conexion a la bd
$servername = "localhost";
$username = "root";
$password = "poshosql1"; //cambiar si es necesario
$database = "pp2-final";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consultar la base de datos para verificar las credenciales y obtener el rol_id
    $sql = "SELECT Roles_id_rol FROM usuario WHERE Email='$email' AND Contrasenia='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rol_id = $row["Roles_id_rol"];

        // Redirigir a las páginas
        if ($rol_id == 1) {
            header("Location: ../regentes/inicio_regencia.html");
            exit;
        } elseif ($rol_id == 2) {
            header("Location: ../profesores/inicio_profesores.html");
            exit;
        } elseif ($rol_id == 3) {
            header("Location: ../regentes/inicio_regencia.html");
            exit;
        }
    } else {
        echo "Credenciales incorrectas";
    }
}

$conn->close();
