<?php
  $page_title = 'Editar Proveedor';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $proveedor = find_by_id_proveedor('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","Missing categorie id.");
    redirect('lista_proveedor.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('proveedor-name');
  validate_fields($req_field);
  $nom_pro = remove_junk($db->escape($_POST['proveedor-name']));
  $n_ruc = remove_junk($db->escape($_POST['ruc-numero']));
  if(empty($errors)){
        $sql = "UPDATE proveedor SET nom_pro='{$nom_pro}' , n_ruc='{$n_ruc}'";
       $sql .= " WHERE id_proveedor='{$proveedor['id_proveedor']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Empleado actualizado con éxito.");
       redirect('lista_proveedor.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('lista_proveedor.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('lista_proveedor.php',false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($proveedor['nom_pro']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_proveedor.php?id=<?php echo (int)$proveedor['id_proveedor'];?>">
           <div class="form-group">
               Razon Social:
               <input type="text" class="form-control" autocomplete="off" name="proveedor-name" value="<?php echo remove_junk(ucfirst($proveedor['nom_pro']));?>"><br>
               Nª RUC: 
               <input type="text" class="form-control" autocomplete="off" name="ruc-numero" value="<?php echo remove_junk(ucfirst($proveedor['n_ruc']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Actualizar Proveedor</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
