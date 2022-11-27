<?php

function loginValido()
{
    require("conexion.php");

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    $query = "SELECT * FROM usuarios WHERE nombre = '$user' and contraseña = '$pass'";

    $resultado = $mysqli->query($query);

    if(($resultado->num_rows) == 1)
    {
        return true;
    }

    return false;
}

function busquedaAeropuertos()
{
    require("conexion.php");

    $query = "SELECT distinct(aeropuertoOrigen) FROM vuelos";

    $result = $mysqli->query($query);

    echo
    '
    <form action="index.php" method="post" role="form">
        <h2>Busqueda según aeropuertos</h2>
        <br>
        <label>Aeropuerto origen</label>
        <select name="aero1">
    ';
        while($row = $result->fetch_assoc())
        {
            echo "<option value='" .$row["aeropuertoOrigen"]. "'>" .$row["aeropuertoOrigen"]. "</option>";
        }
    echo
    '
        </select>
        <br><br>
        <label>Aeropuerto destino</label>
        <select name="aero2">
    ';
        $query = "SELECT distinct(aeropuertoOrigen) FROM vuelos";

        $result = $mysqli->query($query);
        while($row = $result->fetch_assoc())
        {
            echo "<option value='" .$row["aeropuertoOrigen"]. "'>" .$row["aeropuertoOrigen"]. "</option>";
        }
    echo
    '
        </select>
        <br><br>
        <button type="submit" name="busquedaAero">Buscar</button>
        <br><br>
    </form>
    ';
}


function buscarAero($aero1, $aero2)
{
    require("conexion.php");

    $query = "SELECT * FROM vuelos WHERE aeropuertoOrigen = '$aero1' and aeropuertoDestino = '$aero2'";

    $result = $mysqli->query($query);

    echo
    '
    <h1>Vuelos</h1>
    <table border="1">
        <tr>
            <td>Id vuelo</td>
            <td>Ciudad origen</td>
            <td>Aeropuerto origen</td>
            <td>Fecha salida</td>
            <td>Ciudad destino</td>
            <td>Aeropuerto destino</td>
            <td>Fecha llegada</td>
            <td>Plazas disponibles</td>
        </tr>
    ';
        while($row = $result->fetch_assoc())
        {
            echo'<tr>';
                echo"<td>" .$row["idVuelo"]. "</td>";
                echo"<td>" .$row["ciudadOrigen"]. "</td>";
                echo"<td>" .$row["aeropuertoOrigen"]. "</td>";
                echo"<td>" .$row["fechaSalida"]. "</td>";
                echo"<td>" .$row["ciudadDestino"]. "</td>";
                echo"<td>" .$row["aeropuertoDestino"]. "</td>";
                echo"<td>" .$row["fechaLlegada"]. "</td>";
                echo"<td>" .$row["plazas"]. "</td>";
            echo'</tr>';
        }
    echo
    '
        </table>
    ';
}


function showReservas()
{
    require("conexion.php");

    $user = $_SESSION["user"];

    $query = "select concat(u.nombre) as Usuario, concat(v.ciudadOrigen, '-',v.aeropuertoOrigen) as Origen,
    v.fechaSalida as FechaSalida, concat(v.ciudadDestino, '-', v.aeropuertoDestino) as Destino, v.fechaLlegada as FechaLlegada,
    r.plazas as PlazasReservadas, v.idVuelo as idVuelo from reservas r join usuarios u join vuelos v on r.idUsuario = u.dni and r.idVuelo = v.idVuelo
    where r.idUsuario = (SELECT dni FROM usuarios WHERE nombre = '$user')";

    $result = $mysqli->query($query);

    echo
    '
    <h1>Reservas</h1>
    <table border="1">
        <tr>
            <td>Usuario reserva</td>
            <td>Ciudad salida</td>
            <td>Fecha salida</td>
            <td>Ciudad llegada</td>
            <td>Fecha llegada</td>
            <td>Plazas reservadas</td>
            <td>Ver mas</td>
        </tr>
    ';
        while($row = $result->fetch_assoc())
        {
            echo'<tr>';
                echo"<td>" .$row["Usuario"]. "</td>";
                echo"<td>" .$row["Origen"]. "</td>";
                echo"<td>" .$row["FechaSalida"]. "</td>";
                echo"<td>" .$row["Destino"]. "</td>";
                echo"<td>" .$row["FechaLlegada"]. "</td>";
                echo"<td>" .$row["PlazasReservadas"]. "</td>";
                echo"<td>
                    <form action='index.php' method='post' role='form'>
                        <input type='text' name='idVuelo' value='".$row["idVuelo"]."' style='visibility: hidden;'>
                        <button type='submit' name='borrar'>Borrar</button>
                    </form>
                </td>";
            echo'</tr>';
        }
    echo
    '
        </table>
    ';
}

function buscarAeroFecha($ciudad1, $ciudad2, $fecha1, $fecha2)
{
    require("conexion.php");

    $query = "SELECT * FROM vuelos WHERE ciudadOrigen = '$ciudad1' and ciudadDestino = '$ciudad2' and time(fechaSalida) between '$fecha1' and '$fecha2'";

    $result = $mysqli->query($query);

    echo
    '
    <h1>Vuelos</h1>
    <table border="1">
        <tr>
            <td>Ciudad salida</td>
            <td>Fecha salida</td>
            <td>Ciudad llegada</td>
            <td>Fecha llegada</td>
            <td>Plazas Disponibles</td>
            <td>Reservar</td>
        </tr>
    ';
        while($row = $result->fetch_assoc())
        {
            echo'<tr>';
                echo"<td>" .$row["ciudadOrigen"]. "</td>";
                echo"<td>" .$row["fechaSalida"]. "</td>";
                echo"<td>" .$row["ciudadDestino"]. "</td>";
                echo"<td>" .$row["fechaLlegada"]. "</td>";
                echo"<td>" .$row["plazas"]. "</td>";
                echo"<td>
                    <form action='index.php' method='post' role='form'>
                        <label></label>
                        <input type='number' name='plazas' required='required'>
                        <input type='text' name='idVuelo' value='".$row["idVuelo"]."' style='visibility: hidden;'>
                        <button type='submit' name='reservarVuelo'>Reservar</button>
                    </form>
                </td>";
            echo'</tr>';
        }
    echo
    '
        </table>
    ';
}

function showBusquedaCiudadFecha()
{
    require("conexion.php");

    $query = "SELECT distinct(ciudadOrigen) FROM vuelos";

    $result = $mysqli->query($query);

    echo
    '
        <form action="index.php" method="post" role="form">
            <h2>Busqueda según ciudades y fechas</h2>
            <br>
            <label>Ciudad origen</label>
            <select name="ciudad1">
    ';

        while($row = $result->fetch_assoc())
        {
            echo "<option value='" .$row["ciudadOrigen"]. "'>" .$row["ciudadOrigen"]. "</option>";
        }

    echo
    '
        </select>
        <br><br>
        <label>Ciudad destino</label>
        <select name="ciudad2">
    ';
        $query = "SELECT distinct(ciudadDestino) FROM vuelos";

        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc())
        {
            echo "<option value='" .$row["ciudadDestino"]. "'>" .$row["ciudadDestino"]. "</option>";
        }

    echo
    '
        </select>
        <br><br>
        <label>Fecha salida</label>
        <input type="time" name="fecha1">
        <br><br>
        <label>Fecha llegada</label>
        <input type="time" name="fecha2">
        <br><br>
        <button type="submit" name="busquedaAeroFecha">Buscar</button>
        <br><br>
    </form>
    ';
}

function eliminarReserva($idVuelo)
{
    require("conexion.php");

    $user = $_SESSION["user"];

    $queryP = "SELECT plazas FROM reservas WHERE idUsuario = (SELECT dni FROM usuarios WHERE nombre = '$user') and idVuelo = '$idVuelo'";

    $resultP = $mysqli->query($queryP);

    $row = $resultP->fetch_assoc();

    $antiguo = "SELECT plazas FROM vuelos where idVuelo = '$idVuelo'";

    $resultA = $mysqli->query($antiguo);

    $ro2 = $resultA->fetch_assoc();

    $plazas = $row["plazas"] + $ro2["plazas"];

    $update = "UPDATE vuelos SET plazas = '$plazas' WHERE idVuelo = '$idVuelo'";

    $mysqli->query($update);

    $delete = "DELETE FROM reservas WHERE idVuelo = '$idVuelo' and idUsuario = (SELECT dni FROM usuarios WHERE nombre = '$user')";

    $mysqli->query($delete);
}


function crearReserva($idVuelo, $plazas)
{
    require("conexion.php");

    $com = "SELECT * FROM vuelos WHERE idVuelo = '$idVuelo'";

    $res = $mysqli->query($com);

    $reso = $res->fetch_assoc();

    if($reso['plazas'] >= $plazas)
    {
        $user = $_SESSION["user"];

        $d = "SELECT dni FROM usuarios WHERE nombre = '$user'";

        $r = $mysqli->query($d);

        $re = $r->fetch_assoc();

        $dni = $re['dni'];

        $antiguo = "SELECT plazas FROM vuelos where idVuelo = '$idVuelo'";

        $resultA = $mysqli->query($antiguo);

        $ro2 = $resultA->fetch_assoc();

        $p = (int)$ro2["plazas"] - (int)$plazas;

        $update = "UPDATE vuelos SET plazas = '$p' WHERE idVuelo = '$idVuelo'";

        $mysqli->query($update);

        $insert = "INSERT INTO reservas VALUES('$dni', '$idVuelo', '$plazas')";

        $mysqli->query($insert);

		header('Location: http://localhost/MVCAD/index.php?cmd=mostrarReservas');
        }
    else
    {
        header('Location: http://localhost/MVCAD/index.php?cmd=home');
        showMsg("Vaya, parece que no hay plazas disponibles en el vuelo.");
    }
}


function eliminarUsuario()
{
    require("conexion.php");

    $user = $_SESSION["user"];

    $query = "SELECT * FROM reservas WHERE idUsuario = (SELECT dni FROM usuarios WHERE nombre = '$user')";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc())
    {
        eliminarReserva($row['idVuelo']);
    }

    $eliminar = "DELETE FROM usuarios WHERE nombre = '$user'";

    $mysqli->query($eliminar);

    actualizar_sesion();
    header('Location: http://localhost/MVCAD/index.php?cmd=logout');
}
?>