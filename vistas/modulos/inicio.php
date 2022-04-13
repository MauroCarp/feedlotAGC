<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">
    
    <div class="row">
      
      <?php

      if($_SESSION["perfil"] =="Administrador" OR $_SESSION["perfil"] =="Ganadero"){

        include "inicio/cajas-superiores.php";

        ?>

        </div> 

        <div class="row">
          
            <div class="col-md-4">
              <?php

                include "inicio/rankingConsignatarios.php";

              ?>
            </div>  
            
            <div class="col-md-4">
              <?php

                include "inicio/rankingProveedores.php";

              ?>
            </div>  
            
            <div class="col-md-4">

              <?php

                include "inicio/rankingTropas.php";

              ?>

            </div>  

        </div>

        <?php

      }

    ?>

    <div class="row">

          <div class="col-lg-12" style="padding: 50px">
            <br>
            <img src="vistas/img/plantilla/logo-barlovento.png" style="width:100%;">
          
          </div>

    </div>

  </section>
 
</div>
