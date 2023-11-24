<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los valores del formulario
    $dniDocente = $_POST['dni_docente'];
    $horariosSeleccionados = isset($_POST['horarios']) ? $_POST['horarios'] : [];

    // Conecta a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "poshosql1";
    $database = "pp2-final";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Elimina los horarios previos del usuario
    $sqlDelete = "DELETE FROM disponibilidad WHERE dni_docente = $dniDocente";
    $conn->query($sqlDelete);

    // Inserta los nuevos horarios seleccionados
    foreach ($horariosSeleccionados as $horario) {
        list($idBloque, $dia) = explode('-', $horario);
        $sqlInsert = "INSERT INTO disponibilidad (dia, bloque, disponibilidad, dni_docente) VALUES ('$dia', $idBloque, 1, $dniDocente)";
        $conn->query($sqlInsert);
    }

    $conn->close();
    echo "Horarios guardados correctamente.";
} else {
    echo "Acceso no autorizado.";
}
