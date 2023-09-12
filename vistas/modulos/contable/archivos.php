<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Archivos Cargados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Archivos</li>
    
    </ol>

  </section>

  <section class="content">
    <h2>Contable</h2>

    <div class="box"  style="width:100%;">

      <div class="box-body">
        
        <?php

        $meses = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $archivos = array();

        $item = null;
        $valor = null;
        $tabla = 'contable';
        $archivosContable = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,false);
        
        foreach ($archivosContable as $key => $value){
          $archivos[$value['periodo']][] = array('archivo'=>$value['archivo'],'libro'=>$value['libro'],'id'=>$value['id']); 
        }

        $tabla = 'contablePaihuen';
        $archivosPaihuen = ControladorArchivos::ctrMostrarArchivos($item, $valor,$tabla,false);

        foreach ($archivosPaihuen as $key => $value){
          $archivos[$value['periodo']][] = array('archivo'=>$value['archivo'],'libro'=>'Paihuen','id'=>$value['id']); 
        }
      
        ?> 
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           <th>Periodo</th>
           <th></th>
           <th></th>
           <th></th>
         </tr> 

        </thead>

        <tbody>

        <?php
          foreach ($archivos as $key => $value) { 
            $periodo = explode('-',$key);

            $mes = $meses[$periodo[1] - 1];
           echo "<tr>
            <td>". $mes . " " . $periodo[0] . "</td>";

            foreach ($value as $clave => $valor){

              if($valor['libro'] == 'Principal'){?>

                    <td><b><?=$valor['libro']?></b> | <?=$valor['archivo']?>

                    <div class="btn-group" style="float:right">
                
                      <button class="btn btn-danger btnEliminarArchivoContable" idArchivo="<?=$valor["id"]?>" tablaDB="contable"><i class="fa fa-times"></i></button>

                    </div>
                  
                    </td>

              <?php }else if($valor['libro'] == 'Consolidado'){?>

                <td><b><?=$valor['libro']?></b> | <?=$valor['archivo']?>

                <div class="btn-group" style="float:right">
            
                  <button class="btn btn-danger btnEliminarArchivoContable" idArchivo="<?=$valor["id"]?>" tablaDB="contable"><i class="fa fa-times"></i></button>

                </div>
              
                </td>

              <?php }else if($valor['libro'] == 'Paihuen'){?>

                <td><b><?=$valor['libro']?></b> | <?=$valor['archivo']?>

                <div class="btn-group" style="float:right">
            
                  <button class="btn btn-danger btnEliminarArchivoContable" idArchivo="<?=$valor["id"]?>" tablaDB="contablePaihuen"><i class="fa fa-times"></i></button>

                </div>
              
                </td>

              <?php }else{
                  echo "<td></td>";
              }

            }

           echo "</tr>";
          
          }
        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<?php

  $borrarArchivo = new ControladorArchivos();
  $borrarArchivo -> ctrBorrarArchivos();
?>