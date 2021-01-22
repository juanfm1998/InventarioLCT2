<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>

<?php
  
  if(isset($_POST['add_salida'])){
    $req_fields = array('s_id','empleado','quantity', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $empleado   = $db->escape($_POST['empleado']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $date      = $db->escape($_POST['date']);
          //$s_date    = make_date();

          $consulta = "SELECT quantity FROM producto WHERE id = '{$p_id}'";
          $resultado = $db -> query($consulta);
          $fila = $resultado->fetch_assoc();
          $cantidad_inicial = $fila['quantity'];

          $RESTA = $cantidad_inicial-$s_qty;

          if($s_qty<=$cantidad_inicial){
            $sql  = "INSERT INTO sales (";
            $sql .= " product_id,id_emp,cantidad_inicial,qty,stock_final,date";
             $sql .= ") VALUES (";
             $sql .= "'{$p_id}','{$empleado}','{$cantidad_inicial}','{$s_qty}','{$RESTA}','{$date}'";
            $sql .= ")";

            $result=$db->query($sql);
          }

          

                if($result){
                  $update=update_product_qty($s_qty,$p_id);
                  
                  if($update){
                    $session->msg('s',"Salida agregada ");
                  }else{
                    $session->msg('d','Lo siento, no hay stock de este producto.');
                  }
                  
                  redirect('add_salida.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                 redirect('add_salida.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_salida.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Editar venta</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_salida.php">
         <table class="table table-bordered">
           <thead>
            <th> Producto </th>

            <th> Empleado</th>
            <th> Cantidad </th>
            <th> Agregado</th>
            <th> Acciones</th>
           </thead>
             <tbody  id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>
