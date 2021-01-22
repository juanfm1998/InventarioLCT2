<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
  
?>
<?php
  $d_sale = find_by_id_entrada('entrada',(int)$_GET['id_entrada']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('entrada.php');
  }
?>
<?php
  $p_id      = $db->escape((int)$_GET['id_prod']);

  $s_qty     = $db->escape((int)$_GET['cantidad']);

  $delete_id = delete_by_id_entrada('entrada',(int)$d_sale['id_entrada']);

  if($delete_id){
      update_entrada_qty($s_qty,$p_id);

      $session->msg("s","Entrada eliminada.");
      redirect('entrada.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('entrada.php');
  }
?>
