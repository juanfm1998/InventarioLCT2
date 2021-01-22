<?php
  $page_title = 'Lista de ventas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php


$registros0="select id from sales order by id desc limit 80";
$resultado = $db -> query($registros0);
$total_registros= mysqli_num_rows($resultado);

$pagina= isset($_GET['pagina']) ? (int)$_GET['pagina']:1;
$postPorPagina=20;
$inicio=($pagina>1) ? ($pagina*$postPorPagina)-$postPorPagina : 0;
$totalpaginas= ceil($total_registros/$postPorPagina);

$sales = find_all_sale($inicio,$postPorPagina);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Todas las salidas</span>
          </strong>
          <div class="pull-right">
            <a href="add_salida.php" class="btn btn-primary">Agregar salida</a>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Nombre del producto </th>
                <th class="text-center" style="width: 15%;"> Empleado</th>
                <th class="text-center" style="width: 15%;"> Cantidad</th>
                <th class="text-center" style="width: 15%;"> Fecha </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td><?php echo remove_junk($sale['nom_emp']); ?></td>
               <td class="text-center"><?php if($sale['qty']%2==0 && $sale['product_id']=='38' && $sale['qty']>=1000){ echo ((int)$sale['qty']/1000). " millares";} else{
                echo (int)$sale['qty']." unidades";
               } ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="delete_sale.php?id_prod=<?php echo (int)$sale['product_id'];?>&cantidad=<?php echo (int)$sale['qty'];?>&id_sal=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>

         <div style="text-align:center;margin-top:30px;margin: auto; ">     
                                        <nav>
                                            <ul class="pagination">  
                                                <?php

                                                  if ($totalpaginas > 1) {
                                                        if ($pagina != 1)
                                                            echo '<li><a href="sales.php?pagina='.($pagina-1).'" aria-label="Previous"><span aria-hidden="true">«</span> 

                                                                            </a>

                                                                       </li>';
                                                        for ($i=1;$i<=$totalpaginas;$i++) {
                                                            if ($pagina == $i)

                                                                echo '<li><a href="#"><div style="color:#C30;">'.$pagina.'</div></a></li>';
                                                            else

                                                                echo ' <li><a href="sales.php?pagina='.$i.'">'.$i.'</a></li> ';
                                                        }
                                                        if ($pagina != $totalpaginas)
                                                            echo '<li><a href="sales.php?pagina='.($pagina+1).'" aria-label="Next"><span aria-hidden="true">»</span> 

                                                                             </a>

                                                                      </li>';
                                                    }
                                                    echo '</p>';

                                                ?>
                                            </ul>
                                        </nav>
                                    </div>  
        </div>
      </div>
    </div>
  </div>
<?php include_once('layouts/footer.php'); ?>
