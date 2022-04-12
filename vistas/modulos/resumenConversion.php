<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">
  
    <div class="box">
    
        <section class="content" style="padding-top:0;">

            <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirResumenConversion">
                    <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
            </button>

            <div class="row">

                    <div class="col-md-12">

                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.em;">
                     
                                <li class='tabs active' id='cicloCompleto'><a href='#tab_1' data-toggle='tab' id="btnCC">Ciclo Completo</a></li>
                                <li class='tabs' id='recriaPastoril'><a href='#tab_2' data-toggle='tab' id="btnRP">Recria Pastoril</a></li>
                                <li class='tabs' id='recriaCorral'><a href='#tab_3' data-toggle='tab' id="btnRC">Recria Corral</a></li>
                                <li class='tabs' id='terminacion'><a href='#tab_4' data-toggle='tab' id="btnT">Terminaci&oacute;n</a></li>
                                <li class='tabs' id='anual'><a href='#tab_5' data-toggle='tab' id="btnAnual">Estadistica Anual</a></li>

                            </ul>

                            <div class="tab-content">


                              <div class='tab-pane active' id='tab_1'>
                                <?php include 'conversion/cicloCompleto.php';?>
                              </div>
                              <div class='tab-pane' id='tab_2'>
                                <?php include 'conversion/recriaPastoril.php';?>
                              </div>
                              <div class='tab-pane' id='tab_3'>
                                <?php include 'conversion/recriaCorral.php';?>
                              </div>
                              <div class='tab-pane' id='tab_4'>
                                <?php include 'conversion/terminacion.php';?>
                              </div>
                              <div class='tab-pane' id='tab_5'>
                                
                                <?php include 'conversion/etapasAnual.php';?>

                              </div>

                        </div>

                    </div>

            </div>

        </section>

    </div>

</div>