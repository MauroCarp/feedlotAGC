<?php
function formatearFecha($fecha){
  $fecha = explode('-',$fecha);
  $nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
  return $nuevaFecha;
}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
        Precio Índice Rosgan

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">P.I.R.I</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" id="btn-piri">
          
          Actualizar P.I.R.I

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Detalle</th>
           <th>Fecha</th>
           <th>Precio</th>
           <th style="width:50px;"></th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = NULL;
          $valor = NULL;

          $datos = ControladorPiri::ctrMostrardatos($item, $valor);
      
          foreach ($datos as $key => $value){
          $color = ($value['estado'] ==  '&darr;' OR $value['estado'] ==  ' &darr;') ? 'red' : 'green';
          $fecha = strtotime($value['fecha']);
          $fecha = date('d-m-Y',$fecha);
            echo ' <tr>
                    <td>'.$value["detalle"].'</td>
                    <td>'.$fecha.'</td>
                    <td>$ '.$value["precio"].' <span style="color:'.$color.'">'.$value['estado'].'</span></td>
                    <td><button class="btn btn-danger btnEliminarPiri" idPiri="'.$value["id"].'"><i class="fa fa-times"></i></button></td>
                  </tr>';
          }
        

        ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php

  $eliminarCliente = new ControladorPiri();
  $eliminarCliente -> ctrEliminarPiri();

?>




