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
        <body>

        <button><a href="index.php?cmd=logout" class="btn">Logout</a></button>
        <button><a href="index.php?cmd=home" class="btn">Home</a></button>
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
            <button><a href="index.php?cmd=borrarUsuario" class="btn">Borrar vuelo</a></button>
        </div>
    ';
}


function showCrearReserva()
{
    echo
    '

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


function showEliminarUsuario()
{
    echo
    '

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