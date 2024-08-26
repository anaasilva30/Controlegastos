<?php
	//Inicia a sessão
	session_start();
 
	//Verifica se há dados ativos na sessão
	if(empty($_SESSION["cpf_usuario"]))
	{
		//Caso não exista dados registrados, exige login
		header("Location:indexg.php");
	}
?>