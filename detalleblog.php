<?php
session_start();
include("./php/conexion.php");
if (isset($_GET['id'])) {
  $resultado = $conexion->query("select * from contenido where id_contenido=" . $_GET['id']) or die($conexion->error);
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
              <a href="./index.php">
              <button class="btn btn-outline-primary btn-sm mb-0">Volver</button>
              </a>
              <td class="align-middle text-center text-sm">
                <span class="badge badge-sm bg-gradient-success">Blog</span>
              </td>
              <h3 class="text-capitalize"><?php echo $fila[2]; ?></h3>
              <span class="text-xs font-weight-bold"> <?php
                    $res = $conexion->query("SELECT nombre FROM categorias WHERE id = " . $fila[1]);
                    if ($categoria = mysqli_fetch_array($res)) {
                      echo $categoria['nombre'];
                    }
                    ?></span>

              <script src="ckeditor.js"></script>

              <textarea id="editor" contenteditable="false"><?php echo htmlspecialchars($fila[3]); ?></textarea>

            </div>
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