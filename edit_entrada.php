<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$entrada = find_by_id_entrada('entrada',(int)$_GET['id']);
if(!$entrada){
  $session->msg("d","Missing product id.");
  redirect('entrada.php');
}
$all_producto  =find_all('producto');
$all_empleado  =find_all('empleados');
$product = find_by_id('producto',(int)$_GET['id']);
?>
<?php $product = find_by_id('producto',$entrada['id_producto']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('quantity', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['producto']);
          $s_id     =$db->escape((int)$_GET['id']);
          //$p_nombre   = $db->escape((int)$_POST['producto']);
          $e_qty     = $db->escape((int)$_POST['quantity']);
          //$s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          update_entrada_add_qty($e_qty,$p_id,$s_id);
          
          $sql  = "UPDATE entrada SET";
          $sql .= " id_producto= '{$p_id}',cantidad={$e_qty},fecha_entrada='{$s_date}'";
          $sql .= " WHERE id_entrada ='{$entrada['id_entrada']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    
                    $session->msg('s',"Entrada actualizada.");
                    redirect('entrada.php?id='.$entrada['id_entrada'], false);
                  } else {
                    $session->msg('d',' Sorry failed to updated!');
                    redirect('entrada.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_entrada.php?id='.(int)$entrada['id_entrada'],false);
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
        <span>Todas las Entradas</span>
     </strong>
     <div class="pull-right">
       <a href="entrada.php" class="btn btn-primary">Ver Entradas</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> Nombre del producto </th>
          <th> Cantidad</th>
          <th> Fecha</th>
          <th> Acciones</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="edit_entrada.php?id=<?php echo (int)$entrada['id_entrada']; ?>">
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
                
                <td id="s_price">
                  <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($entrada['cantidad']);?>">
                  </td>


                
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" value="<?php echo remove_junk($entrada['fecha_entrada']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn btn-primary">Modificar Entrada</button>
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
