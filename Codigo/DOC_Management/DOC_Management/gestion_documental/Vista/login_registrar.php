<?php

include('../Controlador/conexion.php');

$nombre = $_POST["txtusuario"];
$pass 	= $_POST["txtpassword"];

//Para iniciar sesión
if(isset($_POST["btnloginx"])) {

	$queryusuario = mysqli_query($conn,"SELECT * FROM persona WHERE usuario = '$nombre'");
	$nr 		= mysqli_num_rows($queryusuario); 
	$mostrar	= mysqli_fetch_array($queryusuario); 
	
	if (($nr == 1) && (password_verify($pass,$mostrar['password'])) ) { 
			
			session_start();
			$_SESSION['doc_management']=$nombre;
			if ($mostrar['puesto'] == 'Administrador' ) {
				header("Location: ../Modelo/dashboard.php");
			} 
	
			if($mostrar['puesto'] == 'Gestionador' ) {
				header("Location: ../Modelo/dashboard_gest.php");
			} 

			if($mostrar['puesto'] == 'Radicador' ) {
				header("Location: ../Modelo/dashboard_radi.php");
			}

			// header("Location: ../Modelo/dashboard.php");
	} else {
		echo "<script> alert('Usuario o contraseña incorrecto.');window.location= 'index.html' </script>";
	}
}

//Para registrar
if(isset($_POST["btnregistrarx"])) {



	$nombre  = $_POST["txtnombre"];
	$apellido = $_POST["txtapellido"];
	$email  = $_POST["txtcorreo"];
	$celular = $_POST["txtcelular"];
	$usuario = $_POST["txtusuario"];
	$pass = $_POST["txtpassword"];

	
	
	

	$queryusuario 	= mysqli_query($conn,"SELECT * FROM persona WHERE usuario = '$nombre'");
	$nr 			= mysqli_num_rows($queryusuario); 

	if ($nr == 0) {

		$pass_fuerte = password_hash($pass, PASSWORD_BCRYPT);
		$queryregistrar = "INSERT INTO persona(nombre,apellido,correo,celular,usuario,password)
			values ('$nombre','$apellido','$email','$celular','$usuario','$pass_fuerte')";
		

		if(mysqli_query($conn,$queryregistrar)) {
			echo "<script> alert('Usuario registrado: $nombre');window.location= 'index.html' </script>";
		} else {
			echo "Error: " .$queryregistrar."<br>".mysqli_errno($conn);
		}

	} else {
		echo "<script> alert('No puedes registrar a este usuario: $nombre');window.location= 'index.html' </script>";
	}
} 

?>

