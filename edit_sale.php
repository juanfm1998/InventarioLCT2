<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('sales',(int)$_GET['id']);
if(!$sale){
  $session->msg("d","Missing product id.");
  redirect('sales.php');
}
$all_producto  =find_all('producto');
$all_empleado  =find_all('empleados');
$product = find_by_id('producto',(int)$_GET['id']);
?>
<?php $product = find_by_id('producto',$sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('empleado','quantity', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['producto']);
          $s_id     =$db->escape((int)$_GET['id']);
          //$p_nombre   = $db->escape((int)$_POST['producto']);
          $p_empleado  = $db->escape((int)$_POST['empleado']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          //$s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          update_salida_add_qty($s_qty,$p_id,$s_id);
          
          $sql  = "UPDATE sales SET";
          $sql .= " product_id= '{$p_id}',id_emp={$p_empleado},qty={$s_qty},date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    
                    $session->msg('s',"Sale updated.");
                    redirect('sales.php?id='.$sale['id'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id='.(int)$sale['id'],false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>All Sales</span>
     </strong>
     <div class="pull-right">
       <a href="sales.php" class="btn btn-primary">Ver Salidas</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Nombre del producto </th>
          <th> Empleado </th>
          <th> Cantidad</th>
          <th> Fecha</th>
          <th> Acciones</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
                <td id="s_name">
                  <select class="form-control" name="producto">
                    <option value="">Selecciona un producto</option>
                   <?php  foreach ($all_producto as $prod): ?>
                     <option value="<?php echo (int)$prod['id']; ?>" <?php if($product['id'] === $prod['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($prod['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty">
                 <select class="form-control" name="empleado">
                    <option value="">Selecciona un empelado</option>
                   <?php  foreach ($all_empleado as $emp): ?>
                     <option value="<?php echo (int)$emp['id_emp']; ?>" <?php if($sale['id_emp'] === $emp['id_emp']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($emp['nom_emp']); ?></option>
                   <?php endforeach; ?>
                 </select>
                </td>
                <td id="s_price">
                  <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($sale['qty']);?>">
                  </td>


                
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Modificar Salida</button>
                </td>
              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
