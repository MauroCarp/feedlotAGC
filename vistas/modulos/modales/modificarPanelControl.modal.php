<!--=====================================
MODAL GRAFICO  MUERTES TRATADAS
======================================-->

<div id="modificarPanelControl" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:40%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloEditarPlanilla"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="font-size:1.6em;margin-bottom:0;padding-bottom:0;">

          <div class="box-body" style="margin-bottom:0;padding-bottom:0;">
          
            <div class="box-header with-border" style="margin-bottom:0">
                   
              <div class="box-body" style="margin-bottom:0" id="editarPlanilla">
              
                <form role="form" method="post">
                  <input type="hidden" name="periodo" id="periodo">
                  <!-- COSTOS -->
                  <div class="row">

                    <div class="col-md-8"><b>Costos Diarios del periodo</b></div>

                    <div class="col-md-3"></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo de Sanidad por Cabeza Per&iacute;odo</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CSanCabPeriodo" name="CSanCabPeriodo" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo Diario en Alimentaci&oacute;n en Tal Cual por Cabeza</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CDiaAlimTCCab" name="CDiaAlimTCCab" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo Kilo de Raci&oacute;n Prom. en TC</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CKgRacPromTC" name="CKgRacPromTC" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo Kilo de Raci&oacute;n Prom. en MS</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CKgRacPromMS" name="CKgRacPromMS" ></div>

                  </div>
                  
                  <!-- CONSUMOS -->

                  <div class="row">

                    <div class="col-md-8"><b>Datos Consumo</b></div>

                    <div class="col-md-3"></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Consumo en TC PONDERADO por Cabeza</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="consumTCPondCab" name="consumTCPondCab" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Consumo en MS PONDERADO por Cabeza</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="consumMSPondCab" name="consumMSPondCab" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Conversión MS ESTIMADA según última ADPV</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="converMSEstADPV" name="converMSEstADPV" ></div>

                  </div>
                  
                  <!-- POBLACION -->

                  <div class="row">

                    <div class="col-md-8"><b>Datos Poblacionales</b></div>

                    <div class="col-md-3"></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Poblaci&oacute;n Diaria Prom. Per&iacute;odo</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="poblDiaPromPeriodo" name="poblDiaPromPeriodo" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Total Cabezas Salidas (No incluye Muertos)</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="totalCabSalida" name="totalCabSalida" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Muertos en el Per&iacute;odo</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="muertosPeriodo" name="muertosPeriodo" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Estadia Promedio</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="estadiaProm" name="estadiaProm" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Cabezas Trazadas Salidas (No incluye Muertos)</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="cabTrazSalidas" name="cabTrazSalidas" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">Peso Promedio Ingreso/Salidos - Trazados</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="pesoPromIngSalTraz" name="pesoPromIngSalTraz" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">Peso Promedio Egresos -  Trazados</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="pesoPromEgrTraz" name="pesoPromEgrTraz" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">Kilos Ganados Periodo - Trazados</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="kilosGanPeriodoTraz" name="kilosGanPeriodoTraz" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">ADPV Ganancia Diaria en el Periodo</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="adpvGanDiaPeriodo" name="adpvGanDiaPeriodo" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">&Iacute;ndice de Reposici&oacute;n</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="indiceReposicion" name="indiceReposicion"></div>

                  </div>


                  <!-- PRODUCCION -->

                  <div class="row">

                    <div class="col-md-8"><b>Kilos Carne y Rinde</b></div>

                    <div class="col-md-3"></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Total Cabezas Faenadas</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="totalCabFaenadas" name="totalCabFaenadas" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Total Kilos Carne (Faena)</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="totalKgCarne" name="totalKgCarne" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Total $ Faena (Sin Gastos)</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="totalPesosFaena" name="totalPesosFaena" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Rinde</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="rinde" name="rinde" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Valor Kg Obtenido aplicando Rinde</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="valorKgObtRinde" name="valorKgObtRinde" ></div>

                  </div>
                  
                  <div class="row">

                    <div class="col-md-8">% Desbaste</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="porceDesbaste" name="porceDesbaste" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8"><b> Costo y Margen por Kg Producido</b></div>

                    <div class="col-md-3"></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo Producción 1 Kg (Solo Alimentación)</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CProdKgAlim" name="CProdKgAlim" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Costo Producción 1 Kg ( Alimentación + Sanidad )</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="CProdKgAES" name="CProdKgAES" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Margen Técnico por Kilo Producido</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="margenTecKgProd" name="margenTecKgProd" ></div>

                  </div>

                                    <!-- PRODUCCION -->

                  <div class="row">

                    <div class="col-md-8"><b>Consumo de Maiz y Soja</b></div>

                    <div class="col-md-3"></div>

                  </div>


                  <div class="row">

                    <div class="col-md-8">Maiz</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="maiz" name="maiz" ></div>

                  </div>

                  <div class="row">

                    <div class="col-md-8">Soja</div>

                    <div class="col-md-3"><input type="number" step="0.0001" class="form-control" id="soja" name="soja" ></div>

                  </div>
                                
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button class="btn btn-warning btn-block btnEditarArchivo" style="font-size:1.5em;"><i class="fa fa-pencil"></i><b> Editar</b></button>

        </div>
      
      </form>

    </div>

  </div>

</div>