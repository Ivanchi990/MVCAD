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

				case 'buscarAeropuertos':
					busquedaAeropuertos();
					break;

				case 'buscarCiudadFecha':
					showBusquedaCiudadFecha();
					break;

				case 'logout':
					showLogin();
					break;

				case 'home':
					showOpciones();
					break;

				case 'borrarUsuario':
					eliminarUsuario();
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
		elseif(isset($_POST['borrar']))
		{
			eliminarReserva($_POST['idVuelo']);
		}
		elseif(isset($_POST['crearReserva']))
		{
			crearReserva($_POST['idVuelo'], $_POST['plazas']);
		}
		elseif(isset($_POST['busquedaAeroFecha']))
		{
			buscarAeroFecha($_POST['ciudad1'], $_POST['ciudad2'], $_POST['fecha1'], $_POST['fecha2']);
		}
		elseif(isset($_POST['reservarVuelo']))
		{
			crearReserva($_POST['idVuelo'], $_POST['plazas']);
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