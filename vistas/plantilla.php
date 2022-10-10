<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Reportes Feedlot</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/icono-negro.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
 
  <!-- ESTILOS PERSONALES -->
  <link rel="stylesheet" href="vistas/dist/css/style.css">

  <!-- Icomoon -->
  <link rel="stylesheet" href="vistas/bower_components/icomoon/css/icomoon.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>

  
  <!-- ChartJS LABELS https://github.com/emn178/chartjs-plugin-labels/-->
  <script src="vistas/bower_components/chart/Chart.bundle.js"></script>

  <script src="vistas/bower_components/chart/utils.js"></script>

  <script src="vistas/bower_components/chart/chartjs-plugin-labels.min.js"></script>

  <style>
  
    @media all {
      div.saltopagina{
        display: none;
        }
    }
    
    @media print{
      div.saltopagina{
          display:block;
          page-break-before:always;
      }
    }

  </style>
</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
 
  <?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    echo '<div class="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/
    
    if($_SESSION["perfil"] == 'Ganadero'){

      if(isset($_GET["ruta"])){

        if($_GET["ruta"] == "inicio" ||
          $_GET["ruta"] == "datos" ||
          $_GET["ruta"] == "datos-compras" ||
          $_GET["ruta"] == "datos-muertes" ||
          $_GET["ruta"] == "panelControl" ||
          $_GET["ruta"] == "resumenConversion" ||
          $_GET["ruta"] == "piri" ||
          $_GET["ruta"] == "usuarios" ||
          $_GET["ruta"] == "archivosCarga" ||
          $_GET["ruta"] == "generar-reportes" ||
          $_GET["ruta"] == "cargar-datos-compras" ||
          $_GET["ruta"] == "reportes-compras" ||
          $_GET["ruta"] == "reportes-compras.imprimir" ||
          $_GET["ruta"] == "reportes-muertes" ||
          $_GET["ruta"] == "reportes-muertes.imprimir" ||
          $_GET["ruta"] == "reportes-muertesRango.imprimir" ||
          $_GET["ruta"] == "cargar-datos" ||
          $_GET["ruta"] == "cargar-datos-ventas" ||
          $_GET["ruta"] == "cargar-datos-muertes" ||
          $_GET["ruta"] == "reportes" ||
          $_GET["ruta"] == "reportes.imprimir" ||
          $_GET["ruta"] == "reportes/reportesFiltrados" ||
          $_GET["ruta"] == "reportes/reportesFiltrados.imprimir" ||
          $_GET["ruta"] == "reportes/reportesFiltradosMuertes" ||
          $_GET["ruta"] == "reportesRango" ||
          $_GET["ruta"] == "reportesRango.imprimir" ||
          $_GET["ruta"] == "reportes/reportes-muertesRango" ||
          $_GET["ruta"] == "reportes/reportesFiltradosMuertes.imprimir" ||
          $_GET["ruta"] == "reportes/grafico-general" ||
          $_GET["ruta"] == "salir"){

          include "modulos/".$_GET["ruta"].".php";

        }else{

          include "modulos/404.php";

        }

      }else{

        include "modulos/inicio.php";

      }

    }

    if($_SESSION["perfil"] == 'Agro'){

      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "agro/agro" ||
        $_GET["ruta"] == "agro" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "salir"){
          
          include "modulos/".$_GET["ruta"].".php";
          
        }else{
          
          include "modulos/404.php";
          
        }
        
      }else{
        
        include "modulos/agro/agro.php";

      }

    }

    if($_SESSION["perfil"] == 'Contable'){

      if(isset($_GET["ruta"])){
        if($_GET["ruta"] == "contable/contable" ||
        $_GET["ruta"] == "contable" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "salir"){
          
          include "modulos/".$_GET["ruta"].".php";
          
        }else{
          
          include "modulos/404.php";
          
        }
        
      }else{
        
        include "modulos/contable/contable.php";

      }

    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';
    
  }else{

    include "modulos/login.php";

  }
  ?>

  
<!-- EN AMBOS -->
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/archivos.js"></script>

<?php
if($_SESSION["perfil"] == 'Administrador Contable' OR $_SESSION["perfil"] == 'Contable'){
?>

  <script src="vistas/js/contable/contable.js"></script>

<?php

}

// AGRO Y CONTABLE

if($_SESSION["perfil"] == 'Agro' OR $_SESSION["perfil"] == 'Administrador Agro' OR $_SESSION["perfil"] == 'Administrador Contable' OR $_SESSION["perfil"] == 'Contable'){
?>

<script src="vistas/js/agro/agro.js"></script>

<?php
}
// SOLO EN AGRO


if($_SESSION["perfil"] == 'Agro' OR $_SESSION["perfil"] == 'Administrador Agro'){
?>

<script src="vistas/js/agro/planificacion.js"></script>
<script src="vistas/js/agro/ejecucion.js"></script>

<?php
}

// SOLO EN GANADERO
if($_SESSION["perfil"] == 'Ganadero' OR $_SESSION["perfil"] == 'Administrador Ganadero'){
  ?>
<script src="vistas/js/compras.js"></script>
<script src="vistas/js/muertes.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/panelControl.js"></script>
<script src="vistas/js/reportesCompras.js"></script>
<script src="vistas/js/reportesMuertes.js"></script>
<script src="vistas/js/conversion.js"></script>
<script src="vistas/js/piri.js"></script>

<?php
}
?>


</body>
</html>
