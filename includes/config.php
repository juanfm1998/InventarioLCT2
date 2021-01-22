<?php
/*
|--------------------------------------------------------------------------
| OWSA-INV V2
|--------------------------------------------------------------------------
| Author: Siamon Hasan
| Project Name: OSWA-INV
| Version: v2
| Offcial page: http://oswapp.com/
| facebook Page: https://www.facebook.com/oswapp
|
|
|
*/
  define( 'DB_HOST', 'localhost' );          // Set database host
  define( 'DB_USER', 'root' );             // Set database user
  define( 'DB_PASS', '' );             // Set database password
  define( 'DB_NAME', 'lct_inv' );        // Set database name

  class Conexion{
			var $ruta;
			var $usuario;
			var $contrasena;
			var $baseDatos;

			function Conexion(){
				$this->ruta       ="localhost"; //
				$this->usuario    ="root"; //usuario que tengas definido
				$this->contrasena =""; //contraseña que tengas definidad
				$this->baseDatos  ="oswa_inv"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala
			}

			function conectarse(){
				//---------------------------TIPO DE CONEXION 1-----------------------------------
				/*$conectarse= mysql_connect($this->ruta,$this->usuario, $this->contrasena) or die(mysql_error()); //conexion al BD
				if($conectarse){
					mysql_select_db($this->baseDatos);
					return($conectarse);
				}else{
					return ("Error");
					}*/
				//------------------------TIPO DE CONEXION 2 - RECOMENDADA---------------------------------------------
				$enlace = mysqli_connect($this->ruta, $this->usuario, $this->contrasena, $this->baseDatos);
				if($enlace){
					//echo "Conexion exitosa";	//si la conexion fue exitosa nos muestra este mensaje como prueba, despues lo puedes poner comentarios de nuevo: //
				}else{
					die('Error de Conexión (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
				}
				return($enlace);
				// mysqli_close($enlace); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
			}
		}
?>
