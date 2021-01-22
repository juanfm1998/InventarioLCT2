
<?php

$connect = mysqli_connect("localhost", "root", "", "oswa_inv");
$columns = array('date','product_id','id_emp','qty');

$query = "SELECT s.date,p.name,e.nom_emp,s.qty FROM sales s LEFT JOIN producto p ON s.product_id = p.id LEFT JOIN empleados e on s.id_emp = e.id_emp WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 's.date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (s.date LIKE "%'.$_POST["search"]["value"].'%" 
  OR p.name LIKE "%'.$_POST["search"]["value"].'%"
  OR e.nom_emp LIKE "%'.$_POST["search"]["value"].'%" 
  OR s.qty LIKE "%'.$_POST["search"]["value"].'%" )
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY date DESC ';
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
    
 $sub_array = array();
 $sub_array[] = $row["date"];
 $sub_array[] = $row["name"];
 $sub_array[] = $row["nom_emp"];
 $sub_array[] = $row["qty"];

        

 $data[] = $sub_array;


}



function get_all_data($connect)
{
 $query = "SELECT s.date,p.name,e.nom_emp,s.qty FROM sales s LEFT JOIN producto p ON s.product_id = p.id LEFT JOIN empleados e on s.id_emp = e.id_emp";
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