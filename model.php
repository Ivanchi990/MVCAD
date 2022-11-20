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
    
}
?>