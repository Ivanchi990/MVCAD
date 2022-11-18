<?php

function showContent() 
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') 
	{
		if (!isset($_GET['cmd']))
		{
			showLogin();
		}
		else 
		{
			switch ($_GET['cmd']) 
			{
				case 'crearReserva':
					showCrearReserva();
					break;

				case 'mostrarReservas':
					showReservas();
					break;

				case 'listarVuelos':
					showMostrarVuelos();
					break;

				case 'borrarUsuario';
					showEliminarUsuario();
					break;

				case 'logout':
					showLogin();
					break;

				default:
					showMsg("Error, operación no permitida");
					break;
			}
		}
	}
	else 
	{	
		if (isset($_POST['login'])) 
		{
			if (isset($_SESSION['user'])) 
			{								
                showOpciones();
			}   
			else 
			{
				showLogin();
			}
		}
	}
}

function actualizar_sesion() 
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		if (isset($_POST['login'])) 
		{
			if (loginValido()) 
			{
				$_SESSION['user'] = $_POST['user'];					
			}
		}
	}
	if (isset($_GET['cmd'])) 
		{
			if  ($_GET['cmd'] == 'logout') 
			{
				unset($_SESSION);
				session_destroy();
			}
		}
}
?>