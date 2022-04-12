<?php

$item2 = null;
$valor2 = null;
$operador = '!=';
$valor = "";


$item = 'adpvRP';

$recriaPastoril = ControladorDatos::ctrContarDatos($item, $valor,$item2,$valor2,$operador);
$totalRecriaPastoril = $recriaPastoril['total'];


$item = 'adpvRC';

$recriaCorral = ControladorDatos::ctrContarDatos($item, $valor,$item2,$valor2,$operador);
$totalRecriaCorral = $recriaCorral['total'];


$item = 'adpvT';

$terminacion = ControladorDatos::ctrContarDatos($item, $valor,$item2,$valor2,$operador);
$totalTerminacion = $terminacion['total'];



?>



<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3><?php echo $totalRecriaPastoril." Animales"; ?></h3>

      <h3>Recría Pastoril</h3>
    
    </div>
    
    <div class="icon">
      
    <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="reportes?activo=recriaPastoril" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3><?php echo $totalRecriaCorral." Animales"; ?></h3>

      <h3>Recría Corral</h3>
    
    </div>
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="reportes?activo=recriaCorral" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-4 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3><?php echo $totalTerminacion." Animales"; ?></h3>

      <h3>Terminación</h3>
  
    </div>
    
    <div class="icon">
    
    <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="reportes?activo=terminacion" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>
