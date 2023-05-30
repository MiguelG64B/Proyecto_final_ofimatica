<?php
session_start();
include "./php/conexion.php";
if (!isset($_SESSION['datos_login'])) {
  header("Location: ./index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if($arregloUsuario['nivel']!= 'admin'){ 
  header("Location: ./index.php");
}  
$arregloUsuario = $_SESSION['datos_login'];

$resultado = $conexion->query("
select contenido.*, categorias.nombre as catego  from 
contenido 
inner join categorias on contenido.id_categoria = categorias.id
and contenido.tipo = 'ejercicios'order by id DESC") or die($conexion->error);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Panel Ejercicios
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
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>
    <script>
    ClassicEditor
      .create(document.querySelector('#editorEdit'))
      .catch(error => {
        console.error(error);
      });
  </script>

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <?php include("./layouts/admin/header.php"); ?>
  <main class="main-content position-relative border-radius-lg ps">
    <!-- Navbar -->
    <?php include("./layouts/header.php"); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Ejercicios</h6>
            </div>
            <div class="content-wrapper">
              <div class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6 text-right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i> Insertar Ejercicios
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <section class="content">
                <div class="container-fluid">

                  <?php
                  if (isset($_GET['error'])) {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_GET['error']; ?>
                    </div>

                  <?php  } ?>
                  <?php
                  if (isset($_GET['success'])) {
                  ?>
                    <div class="alert alert-success" role="alert">
                      Se ha insertado correctamente.
                    </div>

                  <?php  } ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Titulo</th>
                        <th>Fecha</th>
                      </tr>

                    </thead>
                    <tbody>

                      <?php while ($f = mysqli_fetch_array($resultado)) { ?>
                        <tr>
                          <td><?php echo $f['id_contenido']; ?></td>
                          <td> <?php
                                $res = $conexion->query("SELECT nombre FROM categorias WHERE id = " . $f['id_categoria']);
                                if ($categoria = mysqli_fetch_array($res)) {
                                  echo $categoria['nombre'];
                                }
                                ?></td>
                          <td>
                            <?php echo $f['titulo']; ?>
                          </td>
                        </td>
                        <td><?php echo $f['fecha']; ?></td>
                        <td>
                        <button class="btn btn-primary btn-small btnEditar"  
                          data-id="<?php echo $f['id_contenido']; ?>"
                          data-categoria="<?php echo $f['id_categoria']; ?>"
                          data-titulo="<?php echo $f['titulo']; ?>"
                          data-editor="<?php echo htmlspecialchars($f['contenido']); ?>"
                          data-toggle="modal" data-target="#modalEditar">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-small btnEliminar"  
                          data-id="<?php echo $f['id_contenido']; ?>"
                          data-toggle="modal" data-target="#modalEliminar">
                          <i class="fa fa-trash"></i>
                        </button>
                        </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </section>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- agregar productos -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="./php/insertarejercicio.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insertar Ejercicios</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="Titulo">Titulo</label>
                <input type="text" name="titulo" placeholder="Titulo" id="titulo" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="editor">Contenido</label>
                <textarea name="editor" id="editor" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control" required>
                  <?php
                  $res = $conexion->query("select * from categorias");
                  while ($f = mysqli_fetch_array($res)) {
                    echo '<option value="' . $f['id'] . '" >' . $f['nombre'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <!-- agregar productos -->
    <!-- Eliminar -->

    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="modalEliminarLabel">Eliminar Ejercicios</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ¿Desea eliminar este Ejercicio?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
                </div>

              </div>
            </div>
          </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="./php/editarejercicio.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditar">Editar Ejercicios</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="idEdit" name="id">

              <div class="form-group">
                <label for="titulo">Titulo</label>
                <input type="tituloEdit" name="titulo" placeholder="titulo" id="tituloEdit" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="editor">Contenido</label>
                <textarea name="editor" id="editorEdit" class="form-control editorEdit2"></textarea>
              </div>
              <div class="form-group">
                <label for="categoriaEdit">Categoria</label>
                <select name="categoria" id="categoriaEdit" class="form-control" required>
                  <?php
                  $res = $conexion->query("select * from categorias");
                  while ($f = mysqli_fetch_array($res)) {
                    echo '<option value="' . $f['id'] . '" >' . $f['nombre'] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary editar">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include("./layouts/footer.php"); ?>
  </main>


  <script src="ckeditor.js"></script>

  <script>
    ClassicEditor
      .create(document.querySelector('#editor'), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      })
      .then(editor => {
        window.editor = editor;
      })
      .catch(err => {
        console.error(err.stack);
      });
  </script>
    <script>
    ClassicEditor
      .create(document.querySelector('#editorEdit2'), {
        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
      })
      .then(editorEdit2 => {
        window.editorEdit2 = editorEdit2;
      })
      .catch(err => {
        console.error(err.stack);
      });
  </script>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
  <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="./dashboard/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="./dashboard/plugins/moment/moment.min.js"></script>
  <script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dashboard/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="./dashboard/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dashboard/dist/js/demo.js"></script>
  <script>
    $(document).ready(function() {
      var idEliminar = -1;
      var idEditar = -1;
      var fila;
      $(".btnEliminar").click(function() {
        idEliminar = $(this).data('id');
        fila = $(this).parent('td').parent('tr');
      });
      $(".eliminar").click(function() {
        $.ajax({
          url: './php/eliminarblog.php',
          method: 'POST',
          data: {
            id: idEliminar
          }
        }).done(function(res) {

          $(fila).fadeOut(1000);
        });

      });
    
    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var titulo=$(this).data('titulo');
      var editor=$(this).data('editor');
      var categoria=$(this).data('categoria');
      $("#tituloEdit").val(titulo);
      $("#editorEdit").val(editor);
      $("#categoriaEdit").val(categoria);
      $("#idEdit").val(idEditar);
    });
  });

  </script>
  <!-- Code injected by live-server -->



</body>

</html>