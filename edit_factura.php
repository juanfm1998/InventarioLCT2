<?php
  $page_title = 'Editar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$factura = find_by_id_factura('factura',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
$all_prov   =find_all('proveedor');

?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('nro_factura','proveedor','txtfecha', 'descripcion' );
    validate_fields($req_fields);

   if(empty($errors)){
       $nro_factura  = remove_junk($db->escape($_POST['nro_factura']));
       $proveedor   = (int)$_POST['proveedor'];
       $txtfecha   = $db->escape($_POST['txtfecha']);
       $descripcion=remove_junk($db->escape($_POST['descripcion']));
       $id_fact=(int)$_GET['id'];
       //$p_buy   = remove_junk($db->escape($_POST['buying-price']));
       //$p_sale  = remove_junk($db->escape($_POST['saleing-price']));
       /*if (is_null($_POST['imagen1']) || $_POST['imagen1'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['imagen1']));
       }*/
       $query   = "UPDATE factura SET";
       $query  .=" id_proveedor ='{$proveedor}', nro_factura ='{$nro_factura}',";
       $query  .=" descripcion_factura ='{$descripcion}', fecha_factura ='{$txtfecha}' ";
       $query  .=" WHERE id_factura ='{$id_fact}'";
       $result = $db->query($query);
               if($result == 1){
                 $session->msg('s',"Factura ha sido actualizado. ");
                 redirect('factura.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización falló.'.$query);
                 redirect('edit_factura.php?id='.$factura['id_factura'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_factura.php?id='.$factura['id_factura'], false);
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
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Editar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md">
           <form method="post" action="edit_factura.php?id=<?php echo (int)$factura['id_factura'] ?>">
              
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <input type="number" class="form-control" name="nro_factura" autocomplete="off" placeholder="Nro factura" value="<?php echo (int)$factura['nro_factura']; ?>">
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="proveedor">
                      <option value="">Selecciona un proveedor</option>
                    <?php  foreach ($all_prov as $prov): ?>
                     <option value="<?php echo (int)$prov['id_proveedor']; ?>" <?php if($factura['id_proveedor'] === $prov['id_proveedor']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($prov['nom_pro']); ?></option>
                   <?php endforeach; ?>
                    </select>
                  </div>

                  
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-3">
                   <div class="position-relative form-group">
                                                      <label>Fecha de Operación</label>
                                                <input  autocomplete="off" type="text" class="form-control datepicker" id="txtfecha" name="txtfecha" value="<?php echo $factura['fecha_factura']; ?>" data-date data-date-format="yyyy-mm-dd">
                                                  </div>
                 </div>

                  <div class="col-md-6">
                                                                           <label>Descripcion</label>

    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $factura['descripcion_factura']; ?>" ></input>
                 </div>
                   </div>
               </div>
                 </div>
                  <div class="row">
                 
                             <button type="submit" name="product" class="btn btn-danger">Actualizar</button>

                 </div>
               
          </form>
         </div>
        </div>
      </div>
    </div>
<?php include_once('layouts/footer.php'); ?>
