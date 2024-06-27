<?php
/**
* @version        $Id: abmd_directores.php  
* @package        
* @copyright    
* 
* Version Para php 5.
*/

session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: login.php");
    exit();
}

$debug=0;
include 'config.php';
$filename = basename($_SERVER['PHP_SELF']);

$tabla1='directores';
$campo1='id_dir';
$campo2='nombre_dir';
$campo3='nacionalidad';
$campo4='orden';
$campo5='estado';

$cosa='el director';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('paises.json')
                .then(response => response.json())
                .then(data => {
                    let selects = document.querySelectorAll('.pais-select');
                    selects.forEach(select => {
                        let nacionalidadActual = select.getAttribute('data-nacionalidad');
                        data.forEach(pais => {
                            let option = document.createElement('option');
                            option.value = pais.codigo;
                            option.textContent = pais.nombre;
                            if (pais.codigo === nacionalidadActual) {
                                option.selected = true;
                            }
                            select.appendChild(option);
                        });
                    });
                })
                .catch(error => console.error('Error al cargar el archivo JSON:', error));
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></h2>
        <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p>
        <div class="links">
            <a href="admin_dashboard.php">Volver al dashboard</a>
        </div>
    </div>

<?php
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($debug) {
        echo "El valor de 'accion' es: " . $accion;
    }
} else {
    if ($debug) {
        echo "La variable 'accion' no se ha recibido.";
    }
    $accion = 0;
}

if ($accion == 1) { // alta
        /////    var_dump($_POST);
    echo "<br>";
    $valor2 = $_POST['valor2'];
    $valor3 = $_POST['valor3'];
    $valor4 = $_POST['valor4'];
    $valor5 = $_POST['valor5'];

    $my_query = "INSERT INTO `$tabla1` (`$campo2`, `$campo3`, `$campo4`, `$campo5`)   
    VALUES ('$valor2', '$valor3', '$valor4', '$valor5')";

    if ($conn->query($my_query) === TRUE) {
        ?>
        <img src='./imagenes/ok.jpg'>Se agregó <?php echo $cosa . " " . $valor2 ?><br>        
        <?php        
    } else {
        echo $conn->error;
        echo "<br><img src='./imagenes/oo.jpg'> Error, no se agregó $cosa, tome nota del error<br>";
    }
}

if ($accion == 2) { // modificacion
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $valor3 = $_POST['valor3'];
    $valor4 = $_POST['valor4'];
    $valor5 = $_POST['valor5'];

    $my_query = "UPDATE `$tabla1` SET `$campo2`='$valor2', `$campo3`='$valor3', `$campo4`='$valor4', `$campo5`='$valor5' WHERE `$campo1` = '$valor1' LIMIT 1";
    if ($conn->query($my_query) === TRUE) {
        ?>
        <img src='./imagenes/ok.jpg'>Se modificó <?php echo $cosa . " " . $valor2 ?><br>        
        <?php
    } else {
        echo $conn->error;
        echo "<br><img src='./imagenes/oo.jpg'> Error, no se modificó $cosa, tome nota del error<br>";
    }
}

if ($accion == 5) { // baja
    $valor1 = $_POST['valor1'];
    $my_query = "select * from peliculas where director =$valor1";
    $result = $conn->query($my_query);

    if ($result) {
        echo " hay peliculas que tienen asignado ese director, no se puede borrar hasta tanto modifique las pelis";
    } else {
        $my_query = "select * from $tabla1 where $campo1='$valor1'";
        $result = $conn->query($my_query);
        while ($arr = $result->fetch_assoc()) {
            $campot1 = $arr['id_dir'];
            $campot2 = $arr['nombre_dir'];
        }
        $my_query = "delete from `$tabla1` where `$campo1`='$valor1'";

        if ($conn->query($my_query) === TRUE) {
            echo "<img src='./imagenes/ok.jpg'>  Se borró $cosa siguiente....<br>";
            echo "Código:  $campot1 <br>
                  Nombre:  $campot2 <br><br>";
        } else {
            echo $conn->error;
            echo "<br><img src='./imagenes/oo.jpg'> Error, no se borró $cosa, tome nota del error <br>";
        }
    }
}

if ($accion == 3) { // trae datos para modificar
    $valor1 = $_POST['valor1'];

    $my_query = "select *  from $tabla1 where $campo1='$valor1'";
    $result = $conn->query($my_query);
    while ($arr = $result->fetch_assoc()) {
        $id_dir = $arr['id_dir'];
        $nombre_dir = $arr['nombre_dir'];
        $orden = $arr['orden'];
        $estado = $arr['estado'];
        $nacionalidad = $arr['nacionalidad'];
    }

    if ($estado == 0) {
        $muestroestado = "Inactivo";
    } else {
        $muestroestado = "Activo";
    }

    echo "Modifique los datos que desea corregir: ";
    echo "<form action='$filename' method='post'>";
    echo "<input type='hidden' name='accion'  value='2'>";
    echo "<input type='hidden' name='valor1'  value='$id_dir'>";
    echo "Codigo:<b> $id_dir</b><br>";
    echo "Nombre: <input type='text' name='valor2' value='$nombre_dir' size=60 maxlength=60><br>";

    echo "<label for='pais-select'>Selecciona un país:</label>";
    echo "<select id='pais-select' class='pais-select' data-nacionalidad='$nacionalidad' name='valor3'>";
    echo "<option value='$nacionalidad'>Seleccionar</option>";
    echo "</select><br>";

    echo "Orden: <input type='text' name='valor4' value='$orden' size=2 maxlength=2><br>";
    echo "Estado: <select name='valor5'><option value='$estado' selected >$muestroestado</option>
          <option value='1'>Activo</option><option value='0'>Inactivo</option></select><br>";
    echo "<input type='submit' value='Modificar'>";
    echo "</form>";
    echo "<br><br>";
}

// Formulario de alta
if ($accion == 0 || $accion == 5 || $accion == 2 || $accion == 1) {
    echo "<br>";
    echo "Alta de directores de pelis ";

    echo "<form name='form1' method='post' action='$filename'>";
    echo "Nombre: <input name='valor2' type='text' size='40' maxlength='40' value=''><br>";

    echo "<label for='pais-select'>Selecciona un país:</label>";
    echo "<select id='valor3' class='pais-select' name='valor3'>";
    echo "<option value=''>Seleccionar</option>";
    echo "</select><br>";

    echo "Orden: <input name='valor4' type='text' size='2' maxlength='2' value=''><br>";
    echo "Estado :<select name='valor5'><option value='1'>Activo</option><option value='0'>Inactivo</option> </select><br>";
    echo "<input type='hidden' name='accion' value='1'><br><input type='submit' value='Cargar'>";
    echo "</form>";
    echo "<br><br>";
}

// Muestra los directores cargados
$my_query = "select * from $tabla1 order by ORDEN";
$result = $conn->query($my_query);

if ($result) {
    echo "<br>";
    echo "<b>Directores cargados </b>:";
    echo "<table border=1>";
    echo "<tr><td align=center> Codigo</td>
                  <td align=center>Nombre</td>
                  <td align=center>Nacido en</td>
                  <td align=center>Orden</td>
                  <td align=center>Estado</td>
                  <td>-</td><td>-</td></tr>";

    while ($arr = $result->fetch_assoc()) {
        $id_dir = $arr['id_dir'];
        $nombre_dir = $arr['nombre_dir'];
        $orden = $arr['orden'];
        $estado = $arr['estado'];
        $nacionalidad = $arr['nacionalidad'];

        echo "<form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='3'>";
        echo "<input type='hidden' name='valor1'  value='$id_dir'>";

        $propio = $arr['estado'];

        if ($propio) {
            $bgcolor = '#99ccff';
        } else {
            $bgcolor = '#cccccc';
        }

        echo "<tr bgcolor='$bgcolor'>";
        echo "<td> $id_dir </td>";
        echo "<td> $nombre_dir </td>";
        echo "<td> $nacionalidad</td>";
        echo "<td> $orden</td>";
        echo "<td> $estado</td>";

        echo "<td><input type='submit' value='modificar'></td>";           
        echo "</form><form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='5'>";
        echo "<input type='hidden' name='valor1' value='$id_dir'>";
        echo "<td><input type='submit' value='borrar'></td></form>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<b>No hay directores cargados</b><br>";
}
?>
<div class="container">
    <div class="links">
        <a href="abm_peliculas.php">Gestionar Películas</a>
        <a href="abm_generos.php">Gestionar Géneros</a>
        <a href="abm_directores.php">Gestionar Directores</a>
        <a href="abm_nacionalidades.php">Gestionar Nacionalidades</a>
    </div>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
