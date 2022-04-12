<?php

$item = null;
$valor = null;
$orden = "id";

// $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

 ?>


<div class="box box-primary  collapsed-box">

  <div class="box-header with-border">

    <h3 class="box-title">Ranking Tropas</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse">

        <i class="fa fa-plus"></i>

      </button>

    </div>

  </div>
  
  <div class="box-body">

            <ul class="products-list product-list-in-box">

            <?php

            for($i = 0; $i < 10; $i++){

            echo '<li class="item">

                <div class="product-info">

                <div class="product-title">

                    Barlovento SRL

                    <span class="label pull-right" style="color:yellow;font-size:1.5em;">&#9733;&#9733;&#9733;&#9733;&#9733;
                    </span>

                </div>
            
            </div>

            </li>';

            }

            ?>

            </ul>
  </div>

  <div class="box-footer text-center">

    <a href="#" class="uppercase">Ver todo el Ranking</a>
  
  </div>

</div>

