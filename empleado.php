<?php
  $page_title = 'Lista de categorías';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_emp = find_all_emp('empleados')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO empleados (nom_emp)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Empleado agregado exitosamente.");
        redirect('empleado.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Empleado</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="empleado.php">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name"  autocomplete="off" placeholder="Nombre del Empleado" required>
            </div>
            <button type="submit" name="add_cat" class="btn btn-primary">Agregar Empleado</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Empleados</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">#</th>
                    <th class="text-center" style="width: 50px;">Empleados</th>
                    <th class="text-center" style="width: 50px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_emp as $emp):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($emp['nom_emp'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie_prueba.php?id=<?php echo (int)$emp['id_emp'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_empleado.php?id=<?php echo (int)$emp['id_emp'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                          <span class="glyphicon glyphicon-trash"></span>
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
  </div>
  <?php include_once('layouts/footer.php'); ?>
