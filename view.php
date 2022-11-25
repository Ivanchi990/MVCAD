<?php

function showHeader()
{
	echo
	'
        <!DOCTYPE html>
        <html>
            <head>
                <title>Vuelos</title>
                <link rel="stylesheet" type="text/css" href="estilos.css">
                <meta charset= "utf-8">
            </head>
        <body style="background-color:orange;">
        <style>
            button{
            background-color: green;
            }
        </style>
        <button><a href="index.php?cmd=logout" class="btn">Logout</a></button>
        <button><a href="index.php?cmd=home" class="btn">Home</a></button>
        <h1>Vuelos PHP</h1>
    ';
}

function showLogin()
{
    echo
    '
        <form action="index.php" method="post" role="form">
				<h2>Iniciar sesión</h2>
                <br>
				<label>Nombre de usuario</label>
                <input id="user" type="text" name="user" placeholder="Nombre de usuario" required="" >
                <br><br>
                <label>Contraseña</label>
				<input id="pass" type="password" name="pass" placeholder="Contraseña" required="" >
                <br><br>
				<button type="submit" name="login">Acceder</button>
                <br><br>
		</form>
    ';
}

function showOpciones()
{
    echo
    '
        <div id="botones">
            <label>Crear reserva</label>
            <button><a href="index.php?cmd=crearReserva" class="btn">Crear reserva</a></button>
            <br>
            <label>Mostrar reservas</label>
            <button><a href="index.php?cmd=mostrarReservas" class="btn">Mostrar reserva</a></button>
            <br>
            <label>Listar vuelos</label>
            <button><a href="index.php?cmd=listarVuelos" class="btn">Listar vuelos</a></button>
            <br>
            <label>Borrar usuario</label>
            <button><a href="index.php?cmd=borrarUsuario" class="btn">Borrar usuario</a></button>
        </div>
    ';
}


function showCrearReserva()
{
    echo
    '
        <h1>Crear reserva</h1>
        <form action="index.php" method="post" role="form">
            <label>ID vuelo: </label>
            <input type="text" name="idVuelo" placeholder="Introduce la id del vuelo">
            <br>
            <label>Número de plazas: </label>
            <input type="number" name="plazas">
            <br>
            <button name="crearReserva" type="submit">Crear</button>
        </form>
    ';
}


function showMostrarVuelos()
{
    echo
    '
        <h1>Vuelos</h1>
        <h2>Como quieres buscar el vuelo</h2>
        <div>
            <label>Buscar vuelos segun aeropuetos</label>
            <button><a href="index.php?cmd=buscarAeropuertos" class="btn">Buscar vuelos</a></button>
            <br>
            <label>Buscar vuelos segun ciudad origen y destino y fecha</label>
            <button><a href="index.php?cmd=buscarCiudadFecha" class="btn">Buscar vuelos</a></button>
            <br>
        </div>
    ';
}

function showFooter()
{
    echo
    '
        </body>
        <footer>
            <h3>Super web PHP </h3>
        </footer>
        </html>
    ';
}

function showMsg($msg)
{
	echo
	"<script type='text/javascript'>alert('".$msg."');</script>";
}
?>