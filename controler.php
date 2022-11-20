<?php

include_once("model.php");

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

				case 'borrarUsuario':
					showEliminarUsuario();
					break;

				case 'buscarAeropuertos':
					busquedaAeropuertos();
					break;

				case 'logout':
					showLogin();
					break;

				case 'home':
					showOpciones();
					break;

				default:
					showMsg("Lo siento, esa operación no estaba contemplada.");
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
		elseif(isset($_POST['busquedaAero']))
		{
			buscarAero($_POST["aero1"], $_POST["aero2"]);
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
			else
			{
				showMsg("Vaya, parece que el usuario no esta registrado");
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