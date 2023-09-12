<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

function formatearNumero2($number){

  return number_format($number,2,",",".");

}

function formatearNumero($number){

  return number_format($number,0,",",".");

}

$meses = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Archivos de Carga
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Archivos</li>
    
    </ol>

  </section>
  

  <?php 
  if($_SESSION["perfil"] != "Administrador Agro"){ ?> 
  
  <section class="content" style="display:inline-block">
    <h2>Compras</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
        $tabla = 'compras';
        $archivosCompras = ControladorArchivos::ctrMostrarArchivos($item,$valor,$tabla,true);

        foreach ($archivosCompras as $key => $value){
         
          echo ' <tr>
                 
                  <td>'.($key+1).'</td>
          
                  <td>'.$value["archivo"].'</td>

                  <td>

                  <div class="btn-group">
                    
                    <button class="btn btn-danger btnEliminarArchivo" nombreArchivo="'.$value["archivo"].'" tablaDB="compras"><i class="fa fa-times"></i></button>

                  </div>  

                </td>

                </tr>';
        }


        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

  
  <section class="content" style="display:inline-block">
    <h2>Ventas</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
        $tabla = 'animales';
        $archivosVentas = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,true);

       foreach ($archivosVentas as $key => $value){
         
          echo ' <tr>
                 
                  <td>'.($key+1).'</td>
          
                  <td>'.$value["archivo"].'</td>
                  
                  <td>
                    <div class="btn-group">
                    
                    <button class="btn btn-danger btnEliminarArchivo" nombreArchivo="'.$value["archivo"].'" tablaDB="animales"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
        }


        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

  
  <section class="content" style="display:inline-block">
    <h2>Muertes</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
        $tabla = 'muertes';
        $archivosMuertes = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,true);

       foreach ($archivosMuertes as $key => $value){
         
          echo ' <tr>
                 
                  <td>'.($key+1).'</td>
          
                  <td>'.$value["archivo"].'</td>
                  <td>

                  <div class="btn-group">
                    
                    <button class="btn btn-danger btnEliminarArchivo" nombreArchivo="'.$value["archivo"].'" tablaDB="muertes"><i class="fa fa-times"></i></button>

                  </div>  

                </td>

                </tr>';
        }


        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>
  
  <?php
  }

  if($_SESSION["perfil"] != "Administrador Agro"){

  ?>

  <section class="content" style="display:inline-block">
    <h2>Trablero de Control</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
        $tabla = 'controlpanel';
        $archivosCP = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,false);

       foreach ($archivosCP as $key => $value){

          $periodo = $value['periodo'];

          $periodoExplode = explode('-',$periodo);

          $mes = number_format($periodoExplode[1]);

          $anio = $periodoExplode[0];

          echo ' <tr>
                 
                  <td>'.($key+1).'</td>
          
                  <td>'.$meses[$mes - 1].' - '.$anio.'</td>
                  <td>';

                  echo '<a href="#" class="btn btn-warning modalEditar btn-block"  data-toggle="modal" data-target="#modificarPanelControl" archivo="'.$value['archivo'].'" periodo="'.$value['periodo'].'"><i class="fa fa-pencil"></i></a>';
          

                  if($_SESSION["usuario"] == "tecnicoGanadero"){ 
                    
                    echo '<button class="btn btn-danger btnEliminarArchivo btn-block" nombreArchivo="'.$value["archivo"].'" tablaDB="controlpanel"><i class="fa fa-times"></i></button>';
                    
                  }

                echo '

                </td>

                </tr>';

                
              }
              
              
              ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

  <section class="content" style="display:inline-block">
    <h2>Conversion</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Archivo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;
        $tabla = 'conversion';
        $archivosConv = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,false);

       foreach ($archivosConv as $key => $value){

          $periodo = $value['periodo'];

          $periodoExplode = explode('-',$periodo);

          $mes = number_format($periodoExplode[1]);

          $anio = $periodoExplode[0];

          echo ' <tr>
                 
                  <td>'.($key+1).'</td>
          
                  <td>'.$meses[$mes - 1].' - '.$anio.'</td>
                  <td>';

          

                  if($_SESSION["perfil"] == "Master"){ 
                    
                    echo '<button class="btn btn-danger btnEliminarArchivo btn-block" nombreArchivo="'.$value["archivo"].'" tablaDB="conversion"><i class="fa fa-times"></i></button>';
                    
                  }

                echo '

                </td>

                </tr>';

                
              }
              
              
              ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>
  
  <?php
  }
?>

</div>

<?php
  
  include 'modales/modificarPanelControl.modal.php';

  $editarPlanilla = new ControladorArchivos();
  $editarPlanilla -> ctrEditarPlanilla();

  $borrarArchivo = new ControladorArchivos();
  $borrarArchivo -> ctrBorrarArchivos();


?> 


