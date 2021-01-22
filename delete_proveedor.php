<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $proveedor = find_by_id_proveedor('proveedor',(int)$_GET['id']);
  if(!$proveedor){
    $session->msg("d","ID del proveedor falta.");
    redirect('lista_proveedor.php');
  }
?>
<?php
  $delete_id = delete_by_id_pro('proveedor',(int)$proveedor['id_proveedor']);
  if($delete_id){
      $session->msg("s","Proveedor eliminado");
      redirect('lista_proveedor.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('lista_proveedor.php');
  }
?>
