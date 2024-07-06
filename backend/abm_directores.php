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
    header("Location: index.php");
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
            background-color: #1c1c22;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
        }
        .titulo-h1 {
            display: grid;
            place-items: center;
            color: white;
        }

        .links {
            margin-top: 20px;
        }

        .links a {
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 16px;
            border: 2px solid #007BFF;
            border-radius: 4px;
        }

        .links a:hover {
            background-color: #007BFF;
            color: white;
            border-color: #007BFF;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007BFF;
        }

        table tr:nth-child(even) {
            background-color: #1c1c22;
        }

        table tr:hover {
            background-color: #555;
        }

        .button {
            padding: 5px 10px;
            border: none;
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .button-blue {
            color: #ffffff;
            border: 2px solid #007BFF;
            background-color: transparent;
        }

        .button-blue:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .button-red {
            background-color: transparent;
            color: #FF0000;
            border: 2px solid #FF0000;
        }

        .button-red:hover {
            background-color: #FF0000;
            color: #ffffff;
        }

        .button-green {
            background-color: transparent;
            color: #28a745;
            border: 2px solid #28a745;
        }

        .button-green:hover {
            background-color: #28a745;
            color: #ffffff;
        }

        form {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"],
        form select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: #1c1c22;
            color: white;
        }

        form input[type="text"]::placeholder {
            color: #aaa;
        }

        form select {
            cursor: pointer;
        }

        form input[type="submit"] {
            width: auto;
            margin-top: 10px;
        }

        form .button-blue {
            background-color: transparent;
            border: 2px solid #007BFF;
            color: #007BFF;
        }

        form .button-blue:hover {
            background-color: #007BFF;
            color: white;
            border-color: #007BFF;
        }

        form .button-green {
            background-color: transparent;
            border: 2px solid #28a745;
            color: #28a745;
        }

        form .button-green:hover {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        form .button-red {
            background-color: transparent;
            border: 2px solid #FF0000;
            color: #FF0000;
        }

        form .button-red:hover {
            background-color: #FF0000;
            color: white;
            border-color: #FF0000;
        }

        .container {
            background-color: #1c1c22;
            padding: 20px;
            border-radius: 5px;
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
        <h1 class="titulo-h1">Directores</h1>
        <div class="links">
            <a href="admin_dashboard.php" class= "button button-blue">Volver al dashboard</a>
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

// baja
if ($accion == 5) 
{ 
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    
    /*

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
        }   */
  
        $my_query = "delete from `$tabla1` where `$campo1`='$valor1'";

        if ($conn->query($my_query) === TRUE) {
            echo "<img src='./imagenes/ok.jpg'>  Se borró $cosa siguiente....<br>";
            echo "Código:  $valor1 <br>
                  Nombre:  $valor2 <br><br>";
        } else {
            echo $conn->error;
            echo "<br><img src='./imagenes/oo.jpg'> Error, no se borró $cosa, tome nota del error <br>";
        }
    }


// trae datos para modificar
if ($accion == 3) 
{
  /// traigo de otras tablas
 // paises
     $paises ="";
    $my_query3= "select *  from nacionalidades  where estado=1 order by nombre"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_nacio=$arr['id_nacio'];
        $nombre=$arr['nombre'];
        $paises =$paises."<option value='$id_nacio'>$nombre</option>";
    } 


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

     ?>

           Origen: </strong></font> <select name='valor3' size='1'>
          <?php echo $paises ?> </select> <br>
    <?php

    echo "Orden: <input type='text' name='valor4' value='$orden' size=2 maxlength=2><br>";
    echo "Estado: <select name='valor5'><option value='$estado' selected >$muestroestado</option>
          <option value='1'>Activo</option><option value='0'>Inactivo</option></select><br>";
    echo "<input type='submit' class='button button-blue' value='Modificar'>";
    echo "</form>";
    echo "<br><br>";

/* del JSON 
    echo "<label for='pais-select'>Selecciona un país:</label>";
    echo "<select id='pais-select' class='pais-select' data-nacionalidad='$nacionalidad' name='valor3'>";
    echo "<option value='$nacionalidad'>Seleccionar</option>";
    echo "</select><br>";   */ 
}

// Formulario de alta
if ($accion == 0 || $accion == 5 || $accion == 2 || $accion == 1) 
{
 $paises ="";
    /// traigo de otras tablas
 // paises
    $my_query3= "select *  from nacionalidades  where estado=1 order by nombre"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_nacio=$arr['id_nacio'];
        $nombre=$arr['nombre'];
        $paises =$paises."<option value='$id_nacio'>$nombre</option>";
    } 


    echo "<br>";
    echo "Alta de directores de pelis ";

    echo "<form name='form1' method='post' action='$filename'>";
    echo "Nombre: <input name='valor2' type='text' size='40' maxlength='40' value=''><br>";
       ?>
           Origen: </strong></font> <select name='valor3' size='1'>
          <?php echo $paises ?> </select> <br>
    <?php

/*  del JSON
    echo "<label for='pais-select'>Selecciona un país:</label>";
    echo "<select id='valor3' class='pais-select' name='valor3'>";
    echo "<option value=''>Seleccionar</option>";
    echo "</select><br>";    */

    echo "Orden: <input name='valor4' type='text' size='2' maxlength='2' value=''><br>";
    echo "Estado :<select name='valor5'><option value='1'>Activo</option><option value='0'>Inactivo</option> </select><br>";
    echo "<input type='hidden' name='accion' value='1'><br><input type='submit' class='button button-green' value='Cargar'>";
    echo "</form>";
    echo "<br><br>";
}

// Muestra los directores cargados
$my_query = "select t1.id_dir, t1.nombre_dir, t1.nacionalidad, t1.estado, t2.id_nacio, t2.pais, t2.nombre
 from 
directores AS t1, nacionalidades AS t2 
where t1.nacionalidad = t2.id_nacio order by ORDEN";

$result = $conn->query($my_query);

if ($result) {
    echo "<br>";
    echo "<b>Directores cargados </b>:";
    echo "<table border=1>";
    echo "<tr><td align=center> Codigo</td>
                  <td align=center>Nombre</td>
                  <td align=center>Nacido en</td>
                  <td align=center>Estado</td>
                  <td>-</td><td>-</td></tr>";

    while ($arr = $result->fetch_assoc()) {
        $id_dir = $arr['id_dir'];
        $nombre_dir = $arr['nombre_dir'];
        $estado = $arr['estado'];
        $nacionalidad = $arr['nacionalidad'];
        $pais = $arr['pais'];
        

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
        echo "<td> $pais</td>";
        echo "<td> $estado</td>";

        echo "<td><input type='submit' class='button button-blue' value='Modificar'></td>";           
        echo "</form><form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='5'>";
        echo "<input type='hidden' name='valor1' value='$id_dir'>";
        echo "<input type='hidden' name='valor2' value='$nombre_dir'>";
        
        echo "<td><input type='submit' class='button button-red' value='Borrar'></td></form>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<b>No hay directores cargados</b><br>";
}
?>
<div class="container">
    <div class="links">
        <a href="abm_peliculas.php" class="button button-blue">Gestionar Películas</a>
        <a href="abm_generos.php" class="button button-blue">Gestionar Géneros</a>
        <a href="abm_nacionalidades.php" class="button button-blue">Gestionar Nacionalidades</a>
    </div>
    <a href="logout.php" class="button button-red">Logout</a>
</div>
</body>
</html>
