<?php
  $page_title = 'Editar empleado';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $empleado = find_by_id_emp('empleados',(int)$_GET['id']);
  if(!$empleado){
    $session->msg("d","Missing categorie id.");
    redirect('empleado.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('empleado-name');
  validate_fields($req_field);
  $nom_emp = remove_junk($db->escape($_POST['empleado-name']));
  if(empty($errors)){
        $sql = "UPDATE empleados SET nom_emp='{$nom_emp}'";
       $sql .= " WHERE id_emp='{$empleado['id_emp']}'";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Empleado actualizado con éxito.");
       redirect('empleado.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('empleado.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('empleado.php',false);
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
           <span>Editando <?php echo remove_junk(ucfirst($empleado['nom_emp']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_categorie_prueba.php?id=<?php echo (int)$empleado['id_emp'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="empleado-name" value="<?php echo remove_junk(ucfirst($empleado['nom_emp']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Actualizar empleado</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
