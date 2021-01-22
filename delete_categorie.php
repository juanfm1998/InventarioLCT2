<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categoria = find_by_id_categoria('categories',(int)$_GET['id']);
  if(!$categoria){
    $session->msg("d","ID del categoria falta.");
    redirect('categorie.php');
  }
?>
<?php
  $delete_id = delete_by_id_categoria('categories',(int)$categoria['id']);
  if($delete_id){
      $session->msg("s","Categoria eliminada");
      redirect('categorie.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('categorie.php');
  }
?>
