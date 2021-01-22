<?php
  $page_title = 'Lista de Proveedores';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_pro = find_all_pro('proveedor')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('nom_proveedor' , 'RUC');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['nom_proveedor']));
   $n_ruc = remove_junk($db->escape($_POST['RUC']));
   if(empty($errors)){
      $sql  = "INSERT INTO proveedor (nom_pro ,n_ruc)";
      $sql .= " VALUES ('{$cat_name}' , '{$n_ruc}') ";
      if($db->query($sql)){
        $session->msg("s", "Proveedor agregado exitosamente.");
        redirect('lista_proveedor.php',false);
      } else {
        $session->msg("d", "Lo siento, registro falló");
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
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Proveedor</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="lista_proveedor.php">
            <div class="form-group">
                <input type="text" class="form-control" name="nom_proveedor" autocomplete="off" placeholder="Razon Social" required><br>
                <input type="text" class="form-control" name="RUC" autocomplete="off" placeholder="Numero de RUC" required>
        </div>

            <button type="submit" name="add_cat" class="btn btn-primary">Agregar Proveedor</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Lista de Proveedores</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 25px;">#</th>
                    <th class="text-center" style="width: 50px;">Proveedor</th>
                    <th class="text-center" style="width: 50px;">Numero de RUC</th>
                    <th class="text-center" style="width: 50px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_pro as $pro):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo remove_junk(ucfirst($pro['nom_pro'])); ?></td>
                    <td><?php echo remove_junk(ucfirst($pro['n_ruc'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_proveedor.php?id=<?php echo (int)$pro['id_proveedor'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_proveedor.php?id=<?php echo (int)$pro['id_proveedor'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
