<?php
$conn = new mysqli("localhost","root","","doc_management");
	
	if($conn->connect_errno)
	{
		echo "No hay conexión: (" . $conn->connect_errno . ") " .$conn->connect_error;
	}
?>