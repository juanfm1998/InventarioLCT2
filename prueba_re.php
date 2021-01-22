<?php
  $page_title = 'Lista de ventas';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all_sale();
?>
<?php 
include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
<html>

 <head>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 
   
    <!--DATATABLES-->
    
  <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css"> 

  

 </head>
 <body>
<div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span> Reporte por Fecha</span>
          </strong>
        </div>


  
<div class="table-responsive">
 
       <div class="form-row">
     <div class="input-daterange">
         
         
      <div class="col-md-4">
       <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" placeholder="Fecha Inicio" />
      </div>
      <div class="col-md-4">
       <input type="text" name="end_date" id="end_date"autocomplete="off" class="form-control" placeholder="Fecha Final" />
      </div>  
     </div>
        
     <div class="col">
      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
     </div>
    </div><br/>
    <table id="order_data" class="table table-bordered table-striped table-dark">
        
<div class="row">
      <div class="col text-center"><a class="btn btn-default" href="xls.php" role="button" btn-lg>Registro Total</a></div>
    </div>

     <thead>
      <tr>
        <td>Fecha</td>
        <td>Producto</td>
        <td>Empleado</td>
        <td>Cantidad</td>
         
             
      </tr>

     </thead>

        <tbody>
            
            
                   
        </tbody>
       
       </table>
    
   </div>
  </div>
     
     
<!-- para usar botones en datatables JS -->  
      <script src="DataTables/Buttons-1.6.1/js/dataTables.buttons.min.js"></script>  
    <script src="DataTables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="DataTables/Buttons-1.6.1/js/buttons.html5.min.js"></script>
 
     <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>

 </body>
</html>



<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format: "yyyy-mm-dd",
  autoclose: true
 });

 fetch_data('no');

 function fetch_data(is_date_search, start_date='', end_date='')
 {
  var dataTable = $('#order_data').DataTable({
      language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
            },
        //para usar los botones   
        responsive: "true",
        dom: 'Bfrtilp',
        buttons: [
            
            'excelHtml5',
            
            'pdfHtml5'
        ],
      
   "processing" : true,
   "serverSide" : true,
   "order" : [],
   "ajax" : {
    url:"filtro_factura_prueba.php",
    type:"POST",
    data:{
     is_date_search:is_date_search, start_date:start_date, end_date:end_date
    }
   }
  }

                                            );
 }

 $('#search').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' && end_date !='')
  {
   $('#order_data').DataTable().destroy();
   fetch_data('yes', start_date, end_date);
  }
  else
  {
   alert("Both Date is Required");
  }
 }); 
 
});

</script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="libs/js/functions.js"></script>
