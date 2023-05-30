<?php
session_start();
include("./php/conexion.php");
$arregloUsuario = $_SESSION['datos_login'];
if (isset($_GET['id2'])) {
  $resultado = $conexion->query("SELECT * FROM contenidoruta WHERE id_ruta = " . $_GET['id2'] . " ORDER BY posicion ASC") or die($conexion->error);
  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_row($resultado);
  } else {
    header("Location: ./index.php");
  }
} else {
  //redireccionar
  header("Location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Detalle
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
  <link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <?php include("./layouts/header.php"); ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <?php include("./layouts/botonesupe.php"); ?>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">

              <a href="./rutas.php">
                <button class="btn btn-outline-primary btn-sm mb-0">Volver</button>
              </a>

              <form action="./php/incribir.php" method="post">
                <input type="hidden" id="id_usuario" name="id_usuario" value=" <?php echo $arregloUsuario['id_usuario']; ?> " class="form-control" required>
                <input type="hidden" id="id_ruta" name="id_ruta" value=" <?php echo $fila[1] ?> " class="form-control" required>
                <button type="submit" class="btn btn-outline-primary btn-sm mb-0">Matricular</button>
              </form>


              <td class="align-middle text-center text-sm">
                <span class="badge badge-sm bg-gradient-success">Ruta</span>
              </td>
              <h3 class="text-capitalize">
                <?php
                $res = $conexion->query("SELECT nombre, descripcion FROM rutas WHERE id = " . $fila[1]);
                if ($c = mysqli_fetch_array($res)) {
                  echo $c['nombre'];
                }
                ?>
              </h3>
              <p> <?php
                  $res2 = $conexion->query("SELECT nombre, descripcion FROM rutas WHERE id = " . $fila[1]);
                  if ($c = mysqli_fetch_array($res2)) {
                    echo $c['descripcion'];
                  }
                  ?>
              </p>
            </div>
            <?php
            if (isset($_GET['error'])) {
            ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
              </div>

            <?php  } ?>

            <table class="table">
              <thead>
                <tr>
                  <th>Posicion</th>
                  <th>Nombre de la ruta</th>
                  <th>Contenido (Tipo)</th>
                  <th>Detalle</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($f = mysqli_fetch_array($resultado)) {
                ?>
                  <tr>
                    <td><?php echo $f['posicion']; ?></td>
                    <td>
                      <?php
                      $res = $conexion->query("SELECT * FROM rutas WHERE id = '" . $f['id_ruta'] . "'");
                      while ($f2 = mysqli_fetch_array($res)) {
                        echo '<option value="' . $f2['id'] . '" >' . $f2['nombre'] . '</option>';
                      }
                      ?>
                    </td>
                    <td>
                      <?php
                      $res2 = $conexion->query("SELECT * FROM contenido WHERE id_contenido = '" . $f['id_contenido'] . "'");
                      while ($f3 = mysqli_fetch_array($res2)) {
                        echo '<option value="' . $f3['id_contenido'] . '" >' . $f3['titulo'] . '(' . $f3['tipo'] . ') </option>';
                      }
                      ?>
                    </td>
                    <td>
                      <a href="detallejercicio.php?id2=<?php echo $f['id_contenido']; ?>">
                        <button class="btn btn-dark btn-small">
                          <i class="fa fa-external-link" aria-hidden="true"></i>
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->


  <script src="ckeditor.js"></script>


  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(err => {
        console.error(err.stack);
      });
  </script>

  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>