<?php
  require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Function for find all database table rows by table name
/*--------------------------------------------------------------*/
function find_all($table) {
   global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table));
   }
}

function find_all_emp($table){
  global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." ORDER BY nom_emp");
   }
}
/*--------------------------------------------------------------*/
/* Function for Perform queries
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
 return $result_set;
}
/*--------------------------------------------------------------*/
/*  Function for Find data from table by id
/*--------------------------------------------------------------*/
function find_by_id($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function find_by_id_factura($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_factura='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function find_by_id_entrada($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_entrada='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function find_by_id_emp($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_emp='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
/*--------------------------------------------------------------*/
/* Function for Delete data from table by id
/*--------------------------------------------------------------*/
function delete_by_id($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_emp=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function delete_by_id_media($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function delete_by_id_factura($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_factura=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

function delete_by_id_salida($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }

}

function delete_by_id_entrada($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_entrada=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }

}


/*function update_salida_qty($qty,$p_id){
  global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $sql = "UPDATE producto SET quantity=quantity +'{$qty}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);
}*/


function delete_by_id_produc($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}

/*--------------------------------------------------------------*/
/* Function for Count id  By table name
/*--------------------------------------------------------------*/

function count_by_id($table){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(id) AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
     return($db->fetch_assoc($result));
  }
}
/*--------------------------------------------------------------*/
/* Determine if database table exists
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM '.DB_NAME.' LIKE "'.$db->escape($table).'"');
      if($table_exit) {
        if($db->num_rows($table_exit) > 0)
              return true;
         else
              return false;
      }
  }
 /*--------------------------------------------------------------*/
 /* Login with the data provided in $_POST,
 /* coming from the login form.
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
  /*--------------------------------------------------------------*/
  /* Login with the data provided in $_POST,
  /* coming from the login_v2.php form.
  /* If you used this method then remove authenticate function.
 /*--------------------------------------------------------------*/
   function authenticate_v2($username='', $password='') {
     global $db;
     $username = $db->escape($username);
     $password = $db->escape($password);
     $sql  = sprintf("SELECT id,username,password,user_level FROM users WHERE username ='%s' LIMIT 1", $username);
     $result = $db->query($sql);
     if($db->num_rows($result)){
       $user = $db->fetch_assoc($result);
       $password_request = sha1($password);
       if($password_request === $user['password'] ){
         return $user;
       }
     }
    return false;
   }


  /*--------------------------------------------------------------*/
  /* Find current log in user by session id
  /*--------------------------------------------------------------*/
  function current_user(){
      static $current_user;
      global $db;
      if(!$current_user){
         if(isset($_SESSION['user_id'])):
             $user_id = intval($_SESSION['user_id']);
             $current_user = find_by_id('users',$user_id);
        endif;
      }
    return $current_user;
  }

  function getallemp(){
    global $db;
    $sql="SELECT  id_emp, nom_emp from empleados";
    return find_by_sql($sql); 
  }
  /*--------------------------------------------------------------*/
  /* Find all user by
  /* Joining users table and user gropus table
  /*--------------------------------------------------------------*/
  function find_all_user(){
      global $db;
      $results = array();
      $sql = "SELECT u.id,u.name,u.username,u.user_level,u.status,u.last_login,";
      $sql .="g.group_name ";
      $sql .="FROM users u ";
      $sql .="LEFT JOIN user_groups g ";
      $sql .="ON g.group_level=u.user_level ORDER BY u.name ASC";
      $result = find_by_sql($sql);
      return $result;
  }
  /*--------------------------------------------------------------*/
  /* Function to update the last log in of a user
  /*--------------------------------------------------------------*/

 function updateLastLogIn($user_id)
	{
		global $db;
    $date = make_date();
    $sql = "UPDATE users SET last_login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
	}

  /*--------------------------------------------------------------*/
  /* Find all Group name
  /*--------------------------------------------------------------*/
  function find_by_groupName($val)
  {
    global $db;
    $sql = "SELECT group_name FROM user_groups WHERE group_name = '{$db->escape($val)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Find group level
  /*--------------------------------------------------------------*/
  function find_by_groupLevel($level)
  {
    global $db;
    $sql = "SELECT group_level FROM user_groups WHERE group_level = '{$db->escape($level)}' LIMIT 1 ";
    $result = $db->query($sql);
    return($db->num_rows($result) === 0 ? true : false);
  }
  /*--------------------------------------------------------------*/
  /* Function for cheaking which user level has access to page
  /*--------------------------------------------------------------*/
   function page_require_level($require_level){
     global $session;
     $current_user = current_user();
     $login_level = find_by_groupLevel($current_user['user_level']);
     //if user not login
     if (!$session->isUserLoggedIn(true)):
            $session->msg('d','Por favor Iniciar sesión...');
            redirect('index.php', false);
      //if Group status Deactive
     
      //cheackin log in User level and Require level is Less than or equal to
     elseif($current_user['user_level'] <= (int)$require_level):
              return true;
      else:
            $session->msg("d", "¡Lo siento!  no tienes permiso para ver la página.");
            redirect('home.php', false);
        endif;

     }
   /*--------------------------------------------------------------*/
   /* Function for Finding all product name
   /* JOIN with categorie  and media database table
   /*--------------------------------------------------------------*/
  function join_product_table(){
     global $db;
     $sql  =" SELECT p.id,p.name,p.paqt,p.quantity,p.media_id,p.date,c.name";
    $sql  .=" AS categorie,m.file_name AS image";
    $sql  .=" FROM producto p";
    $sql  .=" LEFT JOIN categories c ON c.id = p.categorie_id";
    $sql  .=" LEFT JOIN media m ON m.id = p.media_id";
    $sql  .=" ORDER BY p.name ASC";
    return find_by_sql($sql);

   }

   function show_factura(){
     global $db;
     $sql  =" SELECT f.id_factura,f.id_proveedor,f.nro_factura,f.descripcion_factura,f.fecha_factura,f.imagen_factura";
    $sql  .=" FROM factura f";
    $sql  .=" ORDER BY f.id_factura ASC";
    return find_by_sql($sql);

   }

   function find_by_id_proveedor($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id_proveedor='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}

function find_by_id_categoria($table,$id)
{
  global $db;
  $id = (int)$id;
    if(tableExists($table)){
          $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
          if($result = $db->fetch_assoc($sql))
            return $result;
          else
            return null;
     }
}
function delete_by_id_pro($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id_proveedor=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
function find_all_pro($table){
  global $db;
   if(tableExists($table))
   {
     return find_by_sql("SELECT * FROM ".$db->escape($table)." ORDER BY nom_pro");
   }
}

function delete_by_id_categoria($table,$id)
{
  global $db;
  if(tableExists($table))
   {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE id=". $db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
   }
}
  /*--------------------------------------------------------------*/
  /* Function for Finding all product name
  /* Request coming from ajax.php for auto suggest
  /*--------------------------------------------------------------*/

   function find_product_by_title($product_name){
     global $db;
     $p_name = remove_junk($db->escape($product_name));
     $sql = "SELECT name FROM producto WHERE name like '%$p_name%' LIMIT 5";
     $result = find_by_sql($sql);
     return $result;
   }

  /*--------------------------------------------------------------*/
  /* Function for Finding all product info by product title
  /* Request coming from ajax.php
  /*--------------------------------------------------------------*/
  function find_all_product_info_by_title($title){
    global $db;
     $sql  = "SELECT * FROM producto ";
    $sql .= " WHERE name ='{$title}'";
    $sql .=" LIMIT 1";
    return find_by_sql($sql);
  }

  /*--------------------------------------------------------------*/
  /* Function for Update product quantity
  /*--------------------------------------------------------------*/
  function update_product_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $validar=true;

    $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
    $resultado = $db -> query($consulta);
    $fila = $resultado->fetch_assoc();
    $cantidad_inicial = $fila['quantity'];

    $RESTA = $cantidad_inicial-$qty;


    if($RESTA<0){

        $sql1 = "UPDATE producto SET quantity = 0 WHERE id = '{$id}'";
        $result = $db->query($sql1);

          //$sql2 = "UPDATE producto SET quantity = '{$_qty}' WHERE id = '{$id}'";
          //$result = $db->query($sql2);

        if($cantidad_inicial==0){
          $validar=false;
        }
    }else{
      $sql3 = "UPDATE producto SET quantity=quantity -'{$qty}' WHERE id = '{$id}'";
      $result = $db->query($sql3);
    }

           

    
    return $validar;

  }

  function update_salida_add_qty($qty,$p_id,$s_id){
      global $db;
      $qty = (int) $qty;
      $id  = (int)$p_id;
      $id_salida  = (int)$s_id;
      $cantidad=(int) $qty;

      $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
      $resultado = $db -> query($consulta);
      $fila = $resultado->fetch_assoc();
      $cantidad_inicial = $fila['quantity'];

      $consulta2 = "SELECT qty FROM sales WHERE id = '{$id_salida}'";
      $resultado2 = $db -> query($consulta2);
      $fila2 = $resultado2->fetch_assoc();
      $salida = $fila2['qty'];

      //$cant_update = ($cantidad_inicial+$entrada)-$qty;

      $sql = "UPDATE producto SET quantity=($cantidad_inicial+ $salida)-$qty WHERE id = '{$id}'";
      $result = $db->query($sql);
      return($db->affected_rows() === 1 ? true : false);
  }

  function update_entrada_add_qty($qty,$p_id,$s_id){
      global $db;
      $qty = (int) $qty;
      $id  = (int)$p_id;
      $id_entrada  = (int)$s_id;
      //$cantidad=(int) $qty;

      $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
      $resultado = $db -> query($consulta);
      $fila = $resultado->fetch_assoc();
      $cantidad_inicial = $fila['quantity'];

      $consulta2 = "SELECT cantidad FROM entrada WHERE id_entrada = '{$id_entrada}'";
      $resultado2 = $db -> query($consulta2);
      $fila2 = $resultado2->fetch_assoc();
      $entrada = $fila2['cantidad'];

      //$cant_update = ($cantidad_inicial+$entrada)-$qty;

      $sql = "UPDATE producto SET quantity=($cantidad_inicial- $entrada)+$qty WHERE id = '{$id}'";
      $result = $db->query($sql);
      return($db->affected_rows() === 1 ? true : false);
  }

  function update_entrada_product($qty,$paqt,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $paqt= (int)$paqt;

    $total=$paqt*$qty;

    $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
    $resultado = $db -> query($consulta);
    $fila = $resultado->fetch_assoc();
    $cantidad_inicial = $fila['quantity'];

    $suma=(int)$cantidad_inicial+$total;

    $sql = "UPDATE producto SET quantity='{$suma}' WHERE id = '{$id}'";
    $result = $db->query($sql);


    //actualizando la cantidad de paquetes 
    $consulta2 = "SELECT paqt FROM producto WHERE id = '{$id}'";
    $resultado2 = $db -> query($consulta2);
    $fila2 = $resultado2->fetch_assoc();
    $paquetes = $fila2['paqt'];

    $suma_paquetes=(int)$paquetes+$paqt;
    $sql2 = "UPDATE producto SET paqt={$suma_paquetes} WHERE id = '{$id}'";
    $result2 = $db->query($sql2);
    return($db->affected_rows() === 1 ? true : false);
  }

function update_salida_qty($qty,$p_id,$salida,$id_sal){
  global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;
    $salida= (int)$salida;
    $s_id=(int)$id_sal;

    $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
    $resultado = $db -> query($consulta);
    $fila = $resultado->fetch_assoc();
    $cantidad_inicial = $fila['quantity'];

    /*$consulta2 = "SELECT qty FROM sales WHERE id = '{$s_id}'";
    $resultado = $db -> query($consulta2);
    $fila = $resultado->fetch_assoc();
    $salida = $fila['qty'];*/

    $suma=(int)$cantidad_inicial+$qty;


    $update2 = "UPDATE sales SET cantidad_inicial=cantidad_inicial+$salida,stock_final=stock_final+$salida  WHERE product_id = '$id' and id>$s_id ";

    $sql = "UPDATE producto SET quantity='{$suma}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    $result2= $db->query($update2);

    return($db->affected_rows() === 1 ? true : false);
}

function update_entrada_qty($qty,$p_id){
    global $db;
    $qty = (int) $qty;
    $id  = (int)$p_id;

    $consulta = "SELECT quantity FROM producto WHERE id = '{$id}'";
    $resultado = $db -> query($consulta);
    $fila = $resultado->fetch_assoc();
    $cantidad_inicial = $fila['quantity'];

    $resta=(int)$cantidad_inicial-$qty;

    $sql = "UPDATE producto SET quantity='{$resta}' WHERE id = '{$id}'";
    $result = $db->query($sql);
    return($db->affected_rows() === 1 ? true : false);

} 

  /*--------------------------------------------------------------*/
  /* Function for Display Recent product Added
  /*--------------------------------------------------------------*/
 function find_recent_product_added($limit){
   global $db;
   $sql   = " SELECT p.id,p.name,p.media_id,c.name AS categorie,";
   $sql  .= "m.file_name AS image FROM producto p";
   $sql  .= " LEFT JOIN categories c ON c.id = p.categorie_id";
   $sql  .= " LEFT JOIN media m ON m.id = p.media_id";
   $sql  .= " ORDER BY p.id DESC LIMIT ".$db->escape((int)$limit);
   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Find Highest saleing Product
 /*--------------------------------------------------------------*/
 function find_higest_saleing_product($limit){
   global $db;
   $sql  = "SELECT p.name, COUNT(s.product_id) AS totalSold, SUM(s.qty) AS totalQty";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN producto p ON p.id = s.product_id ";
   $sql .= " GROUP BY s.product_id";
   $sql .= " ORDER BY SUM(s.qty) DESC LIMIT ".$db->escape((int)$limit);
   return $db->query($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for find all sales
 /*--------------------------------------------------------------*/
 function find_all_sale($inicio,$postPorPagina){
   global $db;
   $sql  = "SELECT s.id,s.product_id, e.nom_emp,s.qty,s.date,p.name,p.quantity";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN producto p ON s.product_id = p.id";   
   $sql .= " LEFT JOIN empleados e on s.id_emp = e.id_emp";
   $sql .= " ORDER BY s.date DESC, e.nom_emp asc  LIMIT $inicio,$postPorPagina";

   return find_by_sql($sql);
 }

 function find_all_sale2(){
   global $db;
   $sql  = "SELECT s.id,s.product_id, e.nom_emp,s.qty,s.date,p.name,p.quantity";
   $sql .= " FROM sales s";
   $sql .= " LEFT JOIN producto p ON s.product_id = p.id";   
   $sql .= " LEFT JOIN empleados e on s.id_emp = e.id_emp";
   $sql .= " ORDER BY s.date DESC";

   return find_by_sql($sql);
 }

 function find_all_entrada(){
   global $db;
   $sql  = "SELECT e.id_entrada,e.id_producto,p.name,pd.nom_pro,e.paqt,e.cantidad,e.fecha_entrada";
   $sql .= " FROM entrada e";
   $sql .= " LEFT JOIN producto p ON e.id_producto = p.id";   
   $sql .= " LEFT JOIN proveedor pd on pd.id_proveedor=p.id_proveedor";
   $sql .= " ORDER BY e.fecha_entrada DESC, pd.nom_pro asc";

   return find_by_sql($sql);
 }
 /*--------------------------------------------------------------*/
 /* Function for Display Recent sale
 /*--------------------------------------------------------------*/
function find_recent_sale_added($limit){
  global $db;
  $sql  = "SELECT s.id,s.qty,s.date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN producto p ON s.product_id = p.id";
  $sql .= " ORDER BY s.date desc LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate sales report by two dates
/*--------------------------------------------------------------*/
function find_sale_by_dates($start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
  $sql  = "SELECT s.date, p.name,p.buy_price,";
  $sql .= "COUNT(s.product_id) AS total_records,";
  $sql .= "SUM(s.qty) AS total_sales,";
  $sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price,";
  $sql .= "SUM(p.buy_price * s.qty) AS total_buying_price ";
  $sql .= "FROM sales s ";
  $sql .= "LEFT JOIN producto p ON s.product_id = p.id";
  $sql .= " WHERE s.date BETWEEN '{$start_date}' AND '{$end_date}'";
  $sql .= " GROUP BY DATE(s.date),p.name";
  $sql .= " ORDER BY DATE(s.date) DESC";
  return $db->query($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Daily sales report
/*--------------------------------------------------------------*/
function  dailySales($year,$month){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name";
  //$sql .= "SUM(p.sale_price * s.qty) AS total_saleing_price";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN producto p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y-%m' ) = '{$year}-{$month}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%e' ),s.product_id";
  return find_by_sql($sql);
}
/*--------------------------------------------------------------*/
/* Function for Generate Monthly sales report
/*--------------------------------------------------------------*/
function  monthlySales($year){
  global $db;
  $sql  = "SELECT s.qty,";
  $sql .= " DATE_FORMAT(s.date, '%Y-%m-%e') AS date,p.name";
  $sql .= " FROM sales s";
  $sql .= " LEFT JOIN producto p ON s.product_id = p.id";
  $sql .= " WHERE DATE_FORMAT(s.date, '%Y' ) = '{$year}'";
  $sql .= " GROUP BY DATE_FORMAT( s.date,  '%c' ),s.product_id";
  $sql .= " ORDER BY date_format(s.date, '%c' ) ASC";
  return find_by_sql($sql);
}

?>
