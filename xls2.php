<?php

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

$search = '';
$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{

  $file_name = 'Order Data.csv';
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name");
  header("Content-Type: application/csv;");

  $file = fopen('php://output', 'w');

  $header = array("Order ID", "Customer Name", "Item Name", "Order Value", "Order Date");

  fputcsv($file, $header);

  /*$query = "
  SELECT * FROM tbl_order 
  WHERE ";

  $query .=' order_customer_name LIKE "%'.$_POST["search"].'%" 
  OR order_item LIKE "%'.$_POST["search"].'% " 
  OR order_value LIKE "%'.$_POST["search"].'% "
  AND order_date >= '".$_POST["start_date"]."' 
  AND order_date <= '".$_POST["end_date"]."' 
  ORDER BY order_date DESC
  ';*/

  /*$query="SELECT * FROM tbl_order WHERE order_customer_name LIKE "%'.$_POST["search"].'%" OR order_item LIKE "%'.$_POST["search"].'%" OR order_value LIKE "%'.$_POST["search"].'%" AND order_date >= '".$_POST["start_date"]."' AND order_date <= '".$_POST["end_date"]."' ORDER BY order_date DESC
  ";*/

  $query = "
  SELECT * FROM tbl_order WHERE ";
 
 if(isset($_POST["search"]["value"]))
{
  $query .='
  (order_customer_name LIKE "%'.$_POST["search"]["value"].'%" 
  OR order_item LIKE "%'.$_POST["search"]["value"].'% " 
  OR order_value LIKE "%'.$_POST["search"]["value"].'% ")'; 
 }else{
  echo "error";
 } 
  $query .= 'OR order_date >= ".$_POST["start_date"]." 
  AND order_date <= ".$_POST["end_date"]."  
  ORDER BY order_date DESC)';


  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
   $data = array();
   $data[] = $row["order_id"];
   $data[] = $row["order_customer_name"];
   $data[] = $row["order_item"];
   $data[] = $row["order_value"];
   $data[] = $row["order_date"];
   fputcsv($file, $data);
  }
  fclose($file);
  exit;
 
}

$query = "
SELECT * FROM tbl_order 
ORDER BY order_date DESC;
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>