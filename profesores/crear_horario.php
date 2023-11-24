<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="../css/styles.css">
  <link rel="shortcout icon" href="../img/logoesc.jpg">
  <title>Cargar horarios</title>

  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }
  </style>
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

    <div class="col text-center" class="flex-col logo">
      <a href="inicio_profesores.html">
        <img width="15%" src="../img/esc.jpg" class="header_logo header-logo"></a>
    </div>
    <div class="text-center">
      <p>
      <h1 class="display-4">Cargar Horarios</h1>
      </p><br>
    </div>
  </div>

  <form id="horarioForm" action="../horarios/guardar_horarios.php" method="post">
    <table>
      <thead>
        <tr>
          <th>Hora</th>
          <th>Lunes</th>
          <th>Martes</th>
          <th>Miércoles</th>
          <th>Jueves</th>
          <th>Viernes</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // bloques horarios de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pp2-final";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
          die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        $sql = "SELECT id_bloque, bloque_horario FROM horario";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['bloque_horario']}</td>";
            for ($i = 1; $i <= 5; $i++) {
              echo "<td><input type='checkbox' name='horarios[]' value='{$row['id_bloque']}-{$i}'></td>";
            }
            echo "</tr>";
          }
        }
        $conn->close();
        ?>
      </tbody>
    </table>
    <br>
    <div class="conteiner-fluid form-floating mb-5" style="margin-left: 40%; margin-right: 40%;">
      <label>Ingresar DNI para validar</label><br><br>
      <input class="form-control text-center" type="text" placeholder="Validar DNI" name="dni_docente" id="dni_docente" aria-label="Validar DNI">
    </div>

    <button type="submit" class="btn btn-success col-lg-2 conteiner-fluid" style="margin-left: 42%;margin-bottom: 2%;">Guardar Horarios</button>
    <a href="inicio_profesores.html" class="justify-content-center text-center" style="margin-left: 47%;"><button type="button" class="btn btn-danger">Volver atrás</button></a>
  </form>

  <script>
    function guardarHorarios() {
      // Obtén los valores seleccionados
      const checkboxes = document.querySelectorAll('input[name="horarios"]:checked');
      const horariosSeleccionados = Array.from(checkboxes).map(checkbox => checkbox.value);

      // Envía los datos al servidor usando AJAX
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'guardar_horarios.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          alert(xhr.responseText); // Muestra la respuesta del servidor
        }
      };
      xhr.send('horarios=' + JSON.stringify(horariosSeleccionados));
    }
  </script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body><br><br>
<footer id="" class="conteiner-fluid py-4 bg-dark text-white-50">
  <div class="d-flex flex-column">
    <div id="page-content">
      <div class="container text-center">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <h1 class="fw-light mt-4 text-white">Profesores Terciario Esc. Sup. N49 "J.J. de Urquiza"</h1><br>
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