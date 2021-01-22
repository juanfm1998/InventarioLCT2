<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
?>
<?php
  $d_sale = find_by_id('sales',(int)$_GET['id_sal']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('sales.php');
  }
?>
<?php
  $p_id      = $db->escape((int)$_GET['id_prod']);

  $s_qty     = $db->escape((int)$_GET['cantidad']);

  $id_sal= (int)$d_sale['id'];

  $consulta2 = "SELECT qty FROM sales WHERE id = '$id_sal'";
  $resultado = $db -> query($consulta2);
  $fila = $resultado->fetch_assoc();
  $salida = $fila['qty'];

  $delete_id = delete_by_id_salida('sales',(int)$d_sale['id']);

  if($delete_id){
      update_salida_qty($s_qty,$p_id,$salida,$id_sal);

      $session->msg("s","Salida eliminada.");
      redirect('sales.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('sales.php');
  }
?>
