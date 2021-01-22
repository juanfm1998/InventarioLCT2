<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $empleado = find_by_id_emp('empleados',(int)$_GET['id']);
  if(!$empleado){
    $session->msg("d","ID del empleado falta.");
    redirect('empleado.php');
  }
?>
<?php
  $delete_id = delete_by_id('empleados',(int)$empleado['id_emp']);
  if($delete_id){
      $session->msg("s","Empleado eliminado");
      redirect('empleado.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('empleado.php');
  }
?>
