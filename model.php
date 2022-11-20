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
                echo"<td><button onClick='clickMe()'>Eliminar</button></td>";
                echo
                "
                    <script type='text/javascript'>
                        function clickMe()
                        {
                            var result ='<?php
                                include('model.php');
                                eliminarReserva(".$row["idVuelo"].");
                            ?>';
                        }
                    </script>
                ";
            echo'</tr>';
        }
    echo
    '
        </table>
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

    echo '<script type="text/JavaScript">location.reload();</script>';
}
?>