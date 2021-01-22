<?php
  $page_title = 'Agregar factura';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $all_prov = find_all('proveedor');
  
?>
<?php
 if(isset($_POST['add_product'])){
  
  

   $req_fields = array('proveedor','nro_factura','descripcion','txtfecha');
   validate_fields($req_fields);
   if(empty($errors)){
     $descripcion   = remove_junk($db->escape($_POST['descripcion']));
     $nro_factura   = remove_junk($db->escape($_POST['nro_factura']));
     $prov   = remove_junk($db->escape($_POST['proveedor']));
     $fecha_factura=$db->escape($_POST['txtfecha']);
     
     //$p_buy   = remove_junk($db->escape($_POST['buying-price']));
     //$p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     if (is_null($_POST['imagen1']) || $_POST['imagen1'] === "") {
       $media_id = '0';
     } else {
       $media_id = remove_junk($db->escape($_POST['imagen1']));
     }

     /*$date    = make_date();
     $query  = "INSERT INTO factura (";
     $query .=" id_proveedor,nro_factura,descripcion_factura,fecha_factura,imagen_factura";
     $query .=") VALUES (";
     $query .=" '{$prov}', '{$nro_factura}','{$descripcion}','{$date}', '{$media_id}'";
     $query .=")";*/
     if($db->query($query)){
      $photo = new Media();
      $photo->upload($_FILES['imagen1']);
        if($photo->process_factura($descripcion,$nro_factura,$prov,$fecha_factura)){
            $session->msg('s','Factura agregada exitosamente.');
            redirect('add_factura.php');
        } else{
          $session->msg('d',join($photo->errors));
          redirect('add_factura.php');
        }
       
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('add_factura.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_factura.php',false);
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
            <span>Agregar factura</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_factura.php" class="clearfix" enctype="multipart/form-data">
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <input type="number" class="form-control" name="nro_factura" autocomplete="off" placeholder="Nro factura">
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="proveedor">
                      <option value="">Selecciona un proveedor</option>
                    <?php  foreach ($all_prov as $prov): ?>
                      <option value="<?php echo (int)$prov['id_proveedor'] ?>">
                        <?php echo $prov['nom_pro'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                    <input type="file" name="imagen1" multiple="multiple" class="btn btn-primary btn-file"/>
                 </span>

                 
               </div>
              </div>
                  </div>
                  
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                <div class="col-md-3">
                   <div class="position-relative form-group">
                                                      <label>Fecha de Operación</label>
                                                <input  autocomplete="off" type="text" class="form-control datepicker" id="txtfecha" name="txtfecha" data-date data-date-format="yyyy-mm-dd">
                                                  </div>
                 </div>

                 <div class="col-md-9">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa una descripcion"></textarea>
                  </div>
                 </div>



              <div class="form-group">
                 

                  
                 </div>
                  
               </div>

               <div class="row">
                 

              <div class="form-group">
                 

                  
                 </div>
                  
               </div>
              </div>


              <button type="submit" name="add_product" class="btn btn-danger">Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
