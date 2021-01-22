<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
  $factura = show_factura();

  
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>

    <div class="col-md-12">
      <div class="panel panel-default">    
        <div class="panel-heading clearfix">  
        <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Lista de Producto</span>
         </strong>           
         <div class="pull-right">         

           <a href="add_factura.php" class="btn btn-primary">Agregar factura</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Imagen</th>
                <th> Descripcion </th>
                <th class="text-center" style="width: 10%;"> Proveedor </th>
                <th class="text-center" style="width: 10%;"> Nro Factura </th>
                <!--<th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>-->
                <th class="text-center" style="width: 10%;"> Fecha </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($factura as $fac):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if(substr($fac['imagen_factura'], -3)=="pdf"): ?>
                    <img class="img-avatar" src="uploads/products/pdfp.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $fac['imagen_factura']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($fac['descripcion_factura']); ?></td>

                <td class="text-center"> <?php echo remove_junk($fac['id_proveedor']); ?></td>
                <td class="text-center"> <?php echo remove_junk($fac['nro_factura']); ?></td>
                <!--<td class="text-center"> <?php //echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php //echo remove_junk($product['sale_price']); ?></td>-->
                <td class="text-center"> <?php echo remove_junk($fac['fecha_factura']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_factura.php?id=<?php echo (int)$fac['id_factura'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_factura.php?id=<?php echo (int)$fac['id_factura'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>

                    <a href="uploads/products/<?php echo $fac['imagen_factura']; ?>" download="<?php echo $fac['descripcion_factura']; ?>" class="btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-download-alt"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>

             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
