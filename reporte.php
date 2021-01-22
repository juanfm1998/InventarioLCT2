<?php
  $page_title = 'Venta diaria';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>

<?php
 $year  = date('Y');
 $month = date('m');
 $sales = dailySales($year,$month);
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Venta diaria</span>
          </strong>
        </div>
</div>

        <html>
 <head>
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
 
     <link href="bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!--DATATABLES-->
    
  <link rel="stylesheet" type="text/css" href="DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css"> 

  

 </head>
 <body>
<div class="container-fluid">
<div class="table-responsive">
 
    <div class="form-row">
     <div class="input-daterange">
       
      <div class="col">
       <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" placeholder="Fecha Inicio" />
      </div>
         <br>
      <div class="col">
       <input type="text" name="end_date" id="end_date"autocomplete="off" class="form-control" placeholder="Fecha Final" />
      </div>  
        <br>
     </div></div>
        
     <div class="col">
      <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
     </div>
    </div>
    <table id="order_data" class="table table-bordered table-striped table-dark">
        
     <thead>
      <tr>
        <td>Fecha Emision</td>
        <td>Serie</td>
        <td>Numero de Factura</td>
        <td>Tipo Doc</td>
        <td>N° Ruc</td>
        <td>Nombre de Cliente</td>
        <td>Importe total</td>
          <td>Isla</td>
          <td>Vista</td>
          <td>Baja</td>
          <td>PDF</td>
         
             
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
    url:"filtro_factura.php",
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

<?php include_once('layouts/footer.php'); ?>
