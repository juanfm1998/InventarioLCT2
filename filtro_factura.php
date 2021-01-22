
<?php

$connect = mysqli_connect("localhost", "root", "", "sistemafac");
$columns = array('FCT_FCH_EMISION','FCT_SERIE','FCT_CORRELATIVO','FCT_EMISOR_TIP_DOC', 'FCT_EMISOR_NRO_DOC', 'FCT_EMISOR_NOMBRE','FCT_IMPORTE_TOTAL', 'FCT_WKS_CRE');

$query = "SELECT * FROM factura WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'FCT_FCH_EMISION BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (FCT_FCH_EMISION LIKE "%'.$_POST["search"]["value"].'%" 
  OR FCT_SERIE LIKE "%'.$_POST["search"]["value"].'%"
  OR FCT_CORRELATIVO LIKE "%'.$_POST["search"]["value"].'%" 
  OR FCT_EMISOR_TIP_DOC LIKE "%'.$_POST["search"]["value"].'%" 
  OR FCT_EMISOR_NRO_DOC LIKE "%'.$_POST["search"]["value"].'%"
  OR FCT_EMISOR_NOMBRE LIKE "%'.$_POST["search"]["value"].'%" 
  OR FCT_IMPORTE_TOTAL LIKE "%'.$_POST["search"]["value"].'%" 
  OR FCT_WKS_CRE LIKE "%'.$_POST["search"]["value"].'%" )
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY FCT_FCH_EMISION DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $visualizar = '<button class="btn btn-success">
            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
          </button>';
    $baja = '<button class="btn btn-warning" >
            <i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>';
    $pdf = '<button class="btn btn-danger">
            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
          </button>';
 $sub_array = array();
 $sub_array[] = $row["FCT_FCH_EMISION"];
 $sub_array[] = $row["FCT_SERIE"];
 $sub_array[] = $row["FCT_CORRELATIVO"];
 $sub_array[] = $row["FCT_EMISOR_TIP_DOC"];
 $sub_array[] = $row["FCT_EMISOR_NRO_DOC"];
 $sub_array[] = $row["FCT_EMISOR_NOMBRE"];
 $sub_array[] = $row["FCT_IMPORTE_TOTAL"];
 $sub_array[] = $row["FCT_WKS_CRE"];
    $sub_array[] = "$visualizar";
        $sub_array[] = "$baja";
        $sub_array[] = "$pdf";
        

 $data[] = $sub_array;


}



function get_all_data($connect)
{
 $query = "SELECT * FROM factura";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>