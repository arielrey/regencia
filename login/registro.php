<?php
$servername = "localhost";
$username = "root";
$password = ""; //cambiar si es necesario
$database = "pp2-final";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtener datos del formulario
$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$usuario = $_POST["usuario"];
$telefono = $_POST["telefono"];
$contrasenia = $_POST["contrasenia"];

// Verificar si email, DNI o usuario ya existen en la base de datos
$verificar_query = "SELECT dni, email, usuario FROM usuario WHERE dni = ? OR email = ? OR usuario = ?";
$verificar_stmt = $conn->prepare($verificar_query);
$verificar_stmt->bind_param("sss", $dni, $email, $usuario);
$verificar_stmt->execute();
$verificar_stmt->store_result();

if ($verificar_stmt->num_rows > 0) {
    $verificar_stmt->bind_result($existingDNI, $existingEmail, $existingUsuario);
    $verificar_stmt->fetch();

    if ($dni == $existingDNI) {
        echo "El DNI ya está registrado en la base de datos.";
    } elseif ($email == $existingEmail) {
        echo "El correo electrónico ya está registrado en la base de datos.";
    } elseif ($usuario == $existingUsuario) {
        echo "El nombre de usuario ya está registrado en la base de datos.";
    }
} else {
    // Obtener el valor de roles
    $roles = isset($_POST["roles"]) ? implode(',', $_POST["roles"]) : null;

    // Verificar si los roles son validos
    if ($roles) {
        $roles_array = explode(',', $roles);
        foreach ($roles_array as $role_id) {
            $query = "SELECT id_rol FROM roles WHERE id_rol = $role_id";
            $result = $conn->query($query);
            if ($result->num_rows == 0) {
                die("Error: Uno o más roles seleccionados no son válidos.");
            }
        }
    }

    // Insertar datos en la base de datos
    $insert_query = "INSERT INTO usuario (dni, nombre, apellido, email, usuario, telefono, contrasenia, Roles_id_rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param("sssssssi", $dni, $nombre, $apellido, $email, $usuario, $telefono, $contrasenia, $roles);
    $insert_stmt->execute();

    // Mensaje de usuario validado
    if ($insert_stmt->affected_rows > 0) {
        foreach ($roles_array as $role_id) {
            if ($role_id == 1) {
                echo "Se registró como regente";
            } elseif ($role_id == 2) {
                echo "Se registró como profesor";
            } elseif ($role_id == 3) {
                echo "Se registró con ambos roles";
            }
        }
    } else {
        echo "Error al registrar el usuario: " . $insert_stmt->error;
    }

    $insert_stmt->close();
}

$verificar_stmt->close();
$conn->close();
