<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=ows_inv.xls');

require_once('includes\config.php');
	$conn=new Conexion();
	$link = $conn->conectarse();

	$query="SELECT s.date,p.name,e.nom_emp,s.qty FROM sales s LEFT JOIN producto p ON s.product_id = p.id LEFT JOIN empleados e on s.id_emp = e.id_emp";
	$result=mysqli_query($link, $query);


?>
<table borer="1">
	<tr style="background-color:red;">
		<th>Fecha</th>
		<th>Nombre del Producto</th>
		<th>Empleado</th>
		<th>Cantidad</th>
	</tr>
	<?php
		while ($row=mysqli_fetch_assoc($result)) {
			?>
				<tr>
					<td><?php echo $row['date']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['nom_emp']; ?></td>
					<td><?php echo $row['qty']; ?></td>
				</tr>	

			<?php
		}

	?>
</table>