<?php
// $item = 'libro';

// $item2 = 'periodo';

//             $valor = 'Principal';
    
//             $valor2 = '2022-04-01';
            
//             $principal = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);        
            
// var_dump($principal);
// die();

            
?>
<div class="content-wrapper">
  
    <div class="box">
      
      <section class="content" style="padding-top:5px;">
        
        <button class="btn btn-primary" id="btnFiltrarContable" style="margin-bottom:10px;"><b>Filtrar</b></button>
  
        <div class="row">

                <div class="col-md-12">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.5em;">
                  
                            <li class='tabs active' id='economicoTab'><a href='#tab_1' data-toggle='tab' id="btnEconomico"><b>Economico</b></a></li>
                            <li class='tabs' id='financieroTab'><a href='#tab_2' data-toggle='tab' id="btnFinanciero"><b>Financiero</b></a></li>
                            <li class='tabs' id='impositivoTab'><a href='#tab_3' data-toggle='tab' id="btnImpositivo"><b>Impositivo</b></a></li>

                        </ul>

                        <div class="tab-content">


                          <div class='tab-pane active' id='tab_1'>

                            <?php include 'economico.php';?>
                          
                          </div>

                          <div class='tab-pane' id='tab_2'>

                            <?php include 'financiero.php';?>

                          </div>

                          <div class='tab-pane' id='tab_3'>
                            
                            <?php include 'impositivo.php';?>
                          
                          </div>

                    </div>

                </div>

        </div>

      </section>

    </div>

</div>
