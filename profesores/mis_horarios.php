<?php
$servername = "localhost";
$username = "root";
$password = "44602955";
$database = "pp2-final";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="../css/styles.css">
    <link rel="shortcout icon" href="../img/logoesc.jpg">
    <title>Mis horarios</title>
</head>

<body>

    <div class="conteiner-fluid">

        <!-- MENU -->

        <nav class="nav shadow-lg p-3 mb-5 bg-body-tertiary rounded justify-content-center">
            <div class="conteiner-fluid text-start justify-content-start">
                <img src="../img/logoesc.jpg" alt="" style="width: 30%; margin-top: 1%;">
            </div>
            <div class="nav p-3 justify-content-end text-end">
                <a href="inicio_profesores.html" class="nav-link active" aria-current="page">Inicio</a>
                <a href="crear_horario.php" class="nav-link active" aria-current="page">Cargar horarios</a>
                <a href="mis_horarios.html" class="nav-link active" aria-current="page">Mis horarios</a>
                <button class="nav-link active" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Regentes</button>
                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h4 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Inicio Regencia</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <h6 class="container-fluid text-start">Para ingresar a la página de regencia debe ingresar su DNI.</h6><br>
                        <form action="validar_dni.php" method="post" class="row g-3">
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">DNI</label>
                                <input type="text" class="form-control" id="inputPassword2" placeholder="DNI" name="dni">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <a href="../login/login.html" class="justify-content-center text-center"><button type="button" class="btn btn-danger">Salir</button></a>
            </div>
        </nav><br><br>

        <!--Logo-->

        <div class="col text-center" class="flex-col logo">
            <a href="inicio_profesores.html">
                <img width="15%" src="../img/esc.jpg" class="header_logo header-logo"></a>
        </div>
        <div class="text-center">
            <p>
            <h1 class="display-4"> Mis Horarios </h1>
            </p><br>
        </div>
    </div>
    <?php
    // Suponiendo que tienes una sesión o alguna manera de identificar al usuario, reemplaza USER_ID con el identificador real
    if (isset($_POST['dni'])) {
        $dni = $_POST['dni']; // Obtener el DNI del formulario
        $user_id = $dni; // Cambia esto según tu método de autenticación

        $sql = "SELECT dia, bloque_horario, disponibilidad FROM disponibilidad
            JOIN horario ON disponibilidad.bloque = horario.id_bloque
            WHERE dni_docente = $user_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive justify-content-center text-center' style='margin-left:30%; margin-right: 30%; margin-top:5%;'>
                <table class='table table-bordered'>
                    <thead class='table-dark'>
                        <tr>
                            <th scope='col'>Día</th>
                            <th scope='col'>Bloque Horario</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Imprimir datos de cada fila
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <th scope='row'>{$row['dia']}</th>
                    <td>{$row['bloque_horario']}</td>
                </tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "<div class='alert alert-info' role='alert'>
                Todavía no has cargado tus horarios.
            </div>";
        }
    }

    $conn->close(); ?>

    <!-- Bootstrap -->
    <br><br>
    <button class="btn btn-primary" style="margin-left: 30%;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Info</button>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header text-center">
            <h4 class="offcanvas-title" id="offcanvasBottomLabel"> Nota: </h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">

            <div class="justify-content-center text-center">
                <p>
                <h5>Los días están representados por números</h5>
                </p><br>
            </div>
            <table class="table justify-content-center text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Día semanal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Lunes</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Martes</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Miercoles</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Jueves</td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Viernes</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a href="mis_horarios.html" class="justify-content-center text-center"><button type="button" class="btn btn-danger">Volver atrás</button></a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
<br><br><br>
<footer id="" class="conteiner-fluid py-4 bg-dark text-white-50">
    <div class="d-flex flex-column">
        <div id="page-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <h1 class="fw-light mt-4 text-white">Porfesores Terciario Esc. Sup. N49 "J.J. de Urquiza"</h1><br>
                        <p class="lead text-white-50">Mas informacion</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-lg-2 offset-lg-1 mb-3">
            <h5>Guides</h5>
            <ul class="list-unstyled">
                <li class="mb-2"><a href="inicio_profesores.html" class="nav-link active">Inicio</a></li>
                <li class="mb-2"><a href="crear_horario.php" class="nav-link active">Cargar horario</a></li>
                <li class="mb-2"><a href="mis_horarios.html" class="nav-link active">Mis horarios</a></li>
            </ul>
        </div>
        <div class="col-6 col-lg-2 mb-3">
            <h5>Contacto</h5>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <p>-------</p>
                </li>
                <li class="mb-2">
                    <p>-------</p>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <div class="container text-center">
        <small>Copyright 2023 &copy</small>
    </div>
</footer>

</html>