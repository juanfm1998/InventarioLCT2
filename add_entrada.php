<?php
  $page_title = 'Agregar entrada';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $all_prov = find_all('proveedor');
  $all_prod = find_all('producto');
  
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('idprod','product-quantity');
   validate_fields($req_fields);
   if(empty($errors)){
     $e_name  = remove_junk($db->escape($_POST['idprod']));
     $e_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $paqt   = remove_junk($db->escape($_POST['paqt']));
     //$p_buy   = remove_junk($db->escape($_POST['buying-price']));
     //$p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['product-photo']));
     }
     $e_date    = make_date();

    $consulta = "SELECT quantity FROM producto WHERE id = '{$e_name}'";
    $resultado = $db -> query($consulta);
    $fila = $resultado->fetch_assoc();
    $cantidad_inicial = $fila['quantity'];


     $query  = "INSERT INTO entrada (";
     $query .=" id_producto,cantidad_inicial,paqt,cantidad,fecha_entrada";
     $query .=") VALUES (";
     $query .=" '{$e_name}','${cantidad_inicial}','{$paqt}','{$e_qty}','{$e_date}'";
     $query .=")";
     if($db->query($query)){
        $update=update_entrada_product($e_qty,$paqt,$e_name);
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_entrada.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_entrada.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_entrada.php',false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar entrada</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_entrada.php" class="clearfix">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <select class="form-control" name="idprod">
                        <option value="">Selecciona un producto</option>
                      <?php  foreach ($all_prod as $prod): ?>
                        <option value="<?php echo (int)$prod['id'] ?>">
                          <?php echo $prod['name'] ?></option>
                      <?php endforeach; ?>
                      </select>
                    </div>
                </div>
              </div>
              <div class="form-group">
                
                <div class="form-group">
                   <div class="col-md-6">
                     <div class="input-group">
                       <span class="input-group-addon">
                        <i class="glyphicon glyphicon-briefcase"></i>
                       </span>
                       <input type="number" class="form-control" name="paqt" placeholder="N° Paquete">
                      
                    </div>
                   </div>
                  </div>

              <div class="form-group">
                  <div class="row">
                   <div class="col-md-6">
                     <div class="input-group">
                       <span class="input-group-addon">
                        <i class="glyphicon glyphicon-ok-sign"></i>
                       </span>
                       <input type="number" class="form-control" name="product-quantity" placeholder="Unidades/Paquete">

                    </div>
                   </div>
                  </div>
              </div>
              
              <div class="form-group">    
                <div class="row">
                  <div class="col-md-6">
                    <div class="position-relative form-group">
                                                      <label>Fecha de Operación</label>
                                                <input  autocomplete="off" type="text" class="form-control" id="txtfecha" name="txtfecha">
                                                  </div>
                  </div>
                 </div>   
              </div>

              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Agregar entrada</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>



<?php include_once('layouts/footer.php'); ?>
