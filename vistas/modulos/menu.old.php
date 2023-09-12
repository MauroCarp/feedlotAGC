<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		switch ($_SESSION['perfil']) {	
				case 'Agro':
				case 'Administrador Agro':
					$inicio = 'agro';
					break;
				
				case 'Administrador Ganadero':
				case 'Ganadero':
					$inicio = 'inicio';
					break;

				case 'Administrador Contable':
				case 'Contable':
					$inicio = 'contable';
					break;

				default:
					# code...
					break;
			}

			echo '<li class="active">

					<a href="'.$inicio.'">

						<i class="fa fa-home"></i>
						<span>Inicio</span>

					</a>

				</li>';
		
				if($_SESSION["perfil"] == "Ganadero"){
					echo '
						<li class="treeview">

							<a href="#">

								<i class="icon-COW"></i>
								
								<span>Compras</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>

								</span>

							</a>

							<ul class="treeview-menu">';
				}
				
				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					
					echo '		
							<li>

								<a href="datos-compras">
									
									<i class="fa fa-circle-o"></i>
									<span>Cargar Compras</span>

								</a>

							</li>';
				}

				if($_SESSION["perfil"] == "Ganadero"){

							echo '
							<li>

								<a href="#" data-toggle="modal" data-target="#ventanaModalFechaCompra">
									
									<i class="fa fa-bar-chart"></i>
									<span>Generar Reportes</span>

								</a>

							</li>
						</ul>

					</li>


					<li class="treeview">

						<a href="#">

							<i class="fa fa-money"></i>
							<span>Ventas</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>

						<ul class="treeview-menu">';
				}
				
				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					echo '
					<li>

						<a href="datos">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Ventas</span>

						</a>

					</li>';
				}

				if($_SESSION["perfil"] == "Ganadero"){

					echo '
							<li>

								<a href="reportes">
									
									<i class="fa fa-bar-chart"></i>
									<span>Generar Reportes</span>

								</a>

							</li>
						</ul>

					</li>

					<li class="treeview">

						<a href="#">

							<i class="icon-muerteIco"></i>
							<span>Muertes</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>

						<ul class="treeview-menu">';
				}

				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					
					echo '
					<li>

						<a href="datos-muertes">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Muertes</span>

						</a>

					</li>';

				}

				if($_SESSION["perfil"] == "Ganadero"){

						echo '<li>

								<a href="reportes-muertes">
									
									<i class="fa fa-bar-chart"></i>
									<span>Generar Reportes</span>

								</a>

							</li>
						</ul>

					</li>

					<li class="treeview">

						<a href="#">

							<i class="fa fa-tasks"></i>
							
							<span>Panel de Control</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>

						<ul class="treeview-menu">';
			
				}
				
				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					echo '
					<li>

						<a href="#" data-toggle="modal" data-target="#modalCargarPanelControl">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar P. de Control</span>

						</a>

					</li>';
				}

				if($_SESSION["perfil"] == "Ganadero"){

					echo '<li>

									<a href="#" data-toggle="modal" data-target="#ventanaModalFechaPanelControl">
										
										<i class="fa fa-bar-chart"></i>
										<span>Generar Reportes</span>

									</a>

								</li>

							</ul>

						</li>

						<li class="treeview">

							<a href="#">

								<i class="fa fa-retweet"></i>
								
								<span>Conversi&oacute;n</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>

								</span>

							</a>

							<ul class="treeview-menu">';

				}
						
				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					echo '
					<li>

						<a href="#" data-toggle="modal" data-target="#modalCargarConversion">
							
							<i class="fa fa-circle-o"></i>
							<span>Cargar Conversion</span>

						</a>

					</li>';
				}

				if($_SESSION["perfil"] == "Ganadero"){

					echo '<li>

									<a href="#" data-toggle="modal" data-target="#ventanaModalResumenConversion">
										
										<i class="fa fa-bar-chart"></i>
										<span>Generar Reportes</span>

									</a>

								</li>

							</ul>

						</li>';

					if($_SESSION['usuario'] == 'tecnicoGanadero'){
					echo '<li class="treeview">

							<a href="#">

								<i class="icon-fardo"></i>
								
								<span>Pastoreo</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>

								</span>

							</a>

							<ul class="treeview-menu">
							
								<li>
									
									<a href="#" data-toggle="modal" data-target="#ventanaModalFechaPastoreoEntrada">
												
										<i class="fa fa-circle-o"></i>
										<span>Cargar Fecha Entrada</span>
										
									</a>
								
								</li>
								<li>
									
									<a href="#" data-toggle="modal" data-target="#ventanaModalFechaPastoreoSalida" onclick="$(`#tropaPastoreo`).select2({disabled:false})">
												
										<i class="fa fa-circle-o"></i>
										<span>Cargar Fecha Salida</span>
										
									</a>
								
								</li>
								
								<li>
								
									<a href="diasPastoreo">
									
										<i class="fa fa-line-chart "></i>
										<span>Tabla Pastoreo</span>
										
									</a>
								
								</li>	
							
							</ul>

						</li>';
				}

				echo '<li>

							<a href="piri">

								<i class="fa fa-line-chart "></i>
								<span>P.I.R.I</span>

							</a>

						</li>';
				}
			
				if($_SESSION["perfil"] == "Ganadero" AND $_SESSION['carga'][0]){
					
					echo '<li>
						
						<a href="archivosCarga">
						
						<i class="fa fa-files-o"></i>
						<span>Lista de Archivos Carga</span>
						
						</a>
					
					</li>';
					
				}

				if($_SESSION["perfil"] == "Agro"){
					echo '
						<li class="treeview">

							<a href="#">

								<i class="fa fa-calendar"></i>
								
								<span>Planificacion</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>

								</span>

							</a>

							<ul class="treeview-menu">';
				}
				
				if($_SESSION["perfil"] == "Agro" AND $_SESSION['carga'][0]){
					
					echo '		
							<li>

							<a href="#" data-toggle="modal" data-target="#modalCarga"  class="menusCarga" data-carga="Planificacion">

								<i class="fa fa-calendar"></i>
								<span>Cargar Planificación</span>

							</a>

							</li>';
				}

				if($_SESSION["perfil"] == "Agro"){

					echo '
					<li>

						<a href="#" data-toggle="modal" data-target="#modalInforme"  class="menusInforme" data-informe="Planificacion">
							
							<i class="fa fa-bar-chart"></i>
							<span>Generar Reportes</span>

						</a>

					</li>
						</ul>

					</li>


					<li class="treeview">

						<a href="#">

							<i class="icon-tractor"></i>
							<span>Ejecución</span>
							
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>

						<ul class="treeview-menu">';
				}
								
				if($_SESSION["perfil"] == "Agro" AND $_SESSION['carga'][1]){
					
					echo '		
							<li>

							<a href="#" data-toggle="modal" data-target="#modalCarga"  class="menusCarga" data-carga="Ejecucion">

								<i class="icon-tractor"></i>
								<span>Cargar Ejecución</span>

							</a>

							</li>';
				}

				if($_SESSION["perfil"] == "Agro"){

					echo '
					<li>

						<a href="#" data-toggle="modal" data-target="#modalInforme"  class="menusInforme" data-informe="Ejecucion">
							
							<i class="fa fa-bar-chart"></i>
							<span>Generar Reportes</span>

						</a>

					</li>
						</ul>

					</li>';
				}

				if($_SESSION["perfil"] == "Agro" AND in_array('Produccion',$_SESSION['perfilAgro'])){

					echo '<li class="treeview">

						<a href="#">

							<i class="icon-fardo"></i>
							<span>Producción</span>
								
							<span class="pull-right-container">
							
								<i class="fa fa-angle-left pull-right"></i>

							</span>

						</a>

						<ul class="treeview-menu">';

					if($_SESSION['carga'][2]){
						
						echo '		
								<li>

									<a href="#" data-toggle="modal" data-target="#modalCarga"  class="menusCarga" data-carga="Produccion">

										<i class="icon-fardo"></i>
										<span>Cargar Producción</span>

									</a>

								</li>';
					}

					if($_SESSION["perfil"] == "Agro"){

						echo '
						<li>

						<a href="#" data-toggle="modal" data-target="#modalInforme"  class="menusInforme" data-informe="Produccion">
								
								<i class="fa fa-bar-chart"></i>
								<span>Generar Reportes</span>

							</a>

						</li>
							</ul>

						</li>';

					} 
					
				}

				if($_SESSION["perfil"] == "Contable" AND $_SESSION['carga']){

					echo '<li>

						<a href="#" data-toggle="modal" data-target="#modalCarga"  class="menusCarga" data-carga="Barlovento">

							<b>1</b>
							<span><b>Cargar Principal</b></span>

						</a>

					</li>

					<li>

					<a href="#" data-toggle="modal" data-target="#modalCarga"  class="menusCarga" data-carga="Barlovento Consolidado">

							<b>2</b>
							<span><b>Cargar Consolidado</b></span>

						</a>

					</li>

					<li>
					
						<a href="archivosContable">

							<b><i class="fa fa-file"></i></b>
							<span><b>Archivos Cargados</b></span>


						</a>

					</li>';

				}

				if($_SESSION["perfil"] == "Master" OR $_SESSION["usuario"] == "Gruben" OR $_SESSION["usuario"] == "Aruben" OR $_SESSION["usuario"] == "Cruben" OR $_SESSION["usuario"] == "tecnicoAgro" OR $_SESSION["usuario"] == "tecnicoGanadero" OR $_SESSION["usuario"] == "tecnicoContable"){

					echo '<li>
			
						<a href="usuarios">

							<i class="fa fa-user"></i>
							<span>Usuarios</span>

						</a>

					</li>';
					
				}

				
		?>

		</ul>

	 </section>

</aside>
<?php
// $modalSeccion es el ID del modal GENERAL de cada SECCION

// $idModal es el ID del Modal, puede ser el principial o el Comparar

// $seccion es la seccion que pertenece el modal

if($_SESSION["perfil"] == "Ganadero"){

	$modalSeccion = 'ventanaModalFechaCompra';
	
	$idCalendar = 'daterange-btnCompras';
	
	$idGenerar = 'generarReporteCompras';
	
	$idModal = 'modalFechaCompra';
	
	$seccion = 'Compras';
	
	include 'modales/filtroFecha.modal.php';
	
	$modalSeccion = 'ventanaModalFechaPanelControl';
	
	$titulo = 'Panel de Control';
	
	$inputID = 'PC';
	
	$divBtnPlus = 'btn-plusPC';
	
	$btnPlus = 'compararPC';
	
	$idGenerar = 'generarPanelControl';
	
	include 'modales/filtroMensualAnual.modal.php';
	
	$modalSeccion = 'ventanaModalResumenConversion';
	
	$titulo = 'Resumen Conversión';
	
	$inputID = 'Conv';
	
	$divBtnPlus = 'btn-plusConv';
	
	$btnPlus = 'compararConversion';
	
	$idGenerar = 'generarResumen';
	
	include 'modales/filtroMensualAnual.modal.php';

	$modalSeccion = 'ventanaModalFechaPastoreoEntrada';
	
	$titulo = 'Cargar Fecha Entrada';
				
	$idGenerar = 'entrada';
	
	include 'modales/fechaPastoreo.modal.php';

	$modalSeccion = 'ventanaModalFechaPastoreoSalida';
	
	$titulo = 'Cargar Fecha Salida';
				
	$idGenerar = 'salida';
	
	include 'modales/fechaPastoreo.modal.php';

	$nuevoRegistro = ControladorPastoreo::ctrNuevoRegistro();

	?>

	<div id="modalCargarPanelControl" class="modal fade" role="dialog">
	  
	  <div class="modal-dialog">
	
		<div class="modal-content">
	
		  <form role="form" method="post" enctype="multipart/form-data" action="cargar-panelControl.php">
	
			<!--=====================================
			CABEZA DEL MODAL
			======================================-->
	
			<div class="modal-header" style="background:#3c8dbc; color:white">
	
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
	
			  <h4 class="modal-title">Cargar Datos</h4>
	
			</div>
	
			<!--=====================================
			CUERPO DEL MODAL
			======================================-->
	
			<div class="modal-body">
	
			  <div class="box-body">
	
				<!-- ENTRADA PARA SUBIR FOTO -->
	
				 <div class="form-group">
				  
				  <div class="panel">Seleccionar Archivo</div>
	
				  <input type="file" class="nuevosDatos" name="nuevosDatos">
	
				</div>
	
			  </div>
	
			</div>
	
			<!--=====================================
			PIE DEL MODAL
			======================================-->
	
			<div class="modal-footer">
	
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	
			  <button type="submit" class="btn btn-primary">Cargar Datos</button>
	
			</div>
	
		  </form>
	
		</div>
	
	  </div>
	
	</div>
	
	<div id="modalCargarConversion" class="modal fade" role="dialog">
	  
	  <div class="modal-dialog">
	
		<div class="modal-content">
	
		  <form role="form" method="post" enctype="multipart/form-data" action="cargar-conversion.php">
	
			<!--=====================================
			CABEZA DEL MODAL
			======================================-->
	
			<div class="modal-header" style="background:#3c8dbc; color:white">
	
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
	
			  <h4 class="modal-title">Cargar Datos</h4>
	
			</div>
	
			<!--=====================================
			CUERPO DEL MODAL
			======================================-->
	
			<div class="modal-body">
	
			  <div class="box-body">
	
				<!-- ENTRADA PARA SUBIR FOTO -->
	
				 <div class="form-group">
				  
				  <div class="panel">Seleccionar Archivo</div>
	
				  <input type="file" class="nuevosDatos" name="nuevosDatos">
	
				</div>
	
			  </div>
	
			</div>
	
			<!--=====================================
			PIE DEL MODAL
			======================================-->
	
			<div class="modal-footer">
	
			  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
	
			  <button type="submit" class="btn btn-primary">Cargar Datos</button>
	
			</div>
	
		  </form>
	
		</div>
	
	  </div>
	
	</div>

	<?php

}

if($_SESSION["perfil"] == "Agro" OR $_SESSION["perfil"] == "Contable"){
	
	include 'modales/agro/cargarAgro.modal.php';
	
}

if($_SESSION["perfil"] == "Agro"){
	include 'modales/agro/informeAgro.modal.php';
}
?>