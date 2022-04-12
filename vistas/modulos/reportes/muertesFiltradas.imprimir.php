<!-- ---------
          GENERAL 
                  --------->
<h4>Comp. General</h4>
    <div class="row">

        <div class="col-md-6">

          <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">Cantidad de Muertes:</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="cantMuertes" style="height:200px"></canvas>

                </div>

              </div>

          </div>
        
        </div>

        <div class="col-md-6">

          <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">% de Muertes</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="porcentajeMuertes" style="height:200px"></canvas>

                </div>

              </div>

          </div>
        
        </div>


    </div>
<br>
    <div class="row">

          <div class="col-md-6">

            <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">Muertes por Mes</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="muertesPorMes" style="height:300px"></canvas>

                </div>

              </div>


            </div>
            

          </div>

          <div class="col-md-6">

            <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">Distribución Mensual de Muertes General</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="muertesMesGeneral" style="height:300px"></canvas>

                </div>

              </div>

            </div>
            

          </div>

    </div>

<div class="saltopagina"></div>


<?php
  for ($i=0; $i < $cantidad ; $i++) { ?> 

<h2><?php echo $datosGraficos[$i + 1];?></h2>
      <div class="row">

        <div class="col-md-6">

          <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">Muertes según Causa:</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="muertesMotivo<?php echo $i;?>" height='100px'></canvas>

                </div>

              </div>

          </div>

        </div>

        <div class="col-md-6">

          <div class="box box-success">

              <div class="box-header with-border">

                <h3 class="box-title">% de Muertes según Causa</h3>

              </div>

              <div class="box-body">

                <div class="chart">

                  <canvas id="porcentajeMotivo<?php echo $i;?>" height='100px'></canvas>

                </div>

              </div>

          </div>

        </div>

      </div>

      <div class="row">

        <div class="col-md-6">

          <div class="box box-success">

            <div class="box-header with-border">

              <h3 class="box-title">Distribución Mensual de Muertes</h3>

            </div>

            <div class="box-body">

              <div class="chart">

                <canvas id="muertesMeses<?php echo $i;?>" height='100px'></canvas>

              </div>

            </div>


          </div>
          

        </div>

        <div class="col-md-6">

          <div class="box box-success">

            <div class="box-header with-border">

              <h3 class="box-title">Distribución Mensual de Muertes Según Causa</h3>

            </div>

            <div class="box-body">

              <div class="chart">

                <canvas id="muertesMesCausa<?php echo $i;?>" height='100px'></canvas>

              </div>

            </div>

          </div>
          

        </div>

      </div>

</div> 
<div class="saltopagina"></div>

<?php }
?>
