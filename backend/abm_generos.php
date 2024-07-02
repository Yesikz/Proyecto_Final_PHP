<?php
/**
* @version		$Id: abmgeneros.php  
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

$debug = 0;
include 'config.php';
$filename = basename($_SERVER['PHP_SELF']);

$tabla1 = 'generos';
$campo1 = 'id_genero';
$campo2 = 'nombre_genero';
$campo3 = 'orden';
$campo4 = 'estado';
$cosa = 'el género';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administrador</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background-color: #1c1c22;
    color: white;
    margin: 0;
    padding: 0;
}
.gestion-h2 {
margin-bottom: 20px;
text-align: center;
position: relative;
display: inline-block;
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
}
.button-blue:hover {
    background-color: #0056b3; /* Cambia el color al pasar el mouse */
    border-color: #0056b3; /* Cambia el color del borde al pasar el mouse */
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

.table-container {
    margin-top: 20px;
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #333;
    color: white;
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

.form-section {
    margin-top: 20px;
    padding: 20px;
    background-color: #333;
    border-radius: 8px;
}

.form-section label {
    display: inline-block;
    width: 120px;
    margin-bottom: 10px;
}

.form-section input[type='text'],
.form-section select {
    width: calc(100% - 130px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #333;
    background-color: #fff;
}

.form-section button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    border: none;
    color: white;
    background-color: #007BFF;
}
    </style>
</head>

<body>
    <div class="container">
		<h2 class="gestion-h2">Gestión de Géneros</h2>
        <!-- <h2>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></h2>
        <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p> -->
        <div class="links">
            <a href="admin_dashboard.php" class="button button-blue">Volver al dashboard</a>
        </div>
    </div>

    <?php
    if (isset($_POST['accion'])) {
    // La variable está presente, puedes realizar acciones con ella
        $accion = $_POST['accion'];
        if ($debug) {
            echo "El valor de 'accion' es: " . $accion;
        }

    } else
     {
    	// La variable no está presente, realiza alguna acción predeterminada o muestra un mensaje de error
    	if($debug)
    	{
   			 echo "La variable 'accion' no se ha recibido.";
    	}
    $accion=0;
}

if ($accion == 1) { // alta 
    // var_dump($_POST);
    echo "<br>";
    $valor2 = $_POST['valor2'];
    $valor3 = $_POST['valor3'];
    $valor4 = $_POST['valor4'];

    $my_query = "INSERT INTO `$tabla1` ( `$campo2` , `$campo3`, `$campo4`  ) VALUES ( '$valor2','$valor3','$valor4' )";

    if ($conn->query($my_query) === TRUE) {
        ?>
        <div class="container">
            <img src='./imagenes/icon-good.svg'>Se agregó <?php echo $cosa . " " .  $valor2 ?><br>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <?php
            echo $conn->error;
            ?>
            <br><img src='./imagenes/icon-bad.svg'> Error, no se agregó <?php echo $cosa; ?>, tome nota del error<br>
        </div>
        <?php
    }
}


    if ($accion == 2) /// modificacion
    {
        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $valor4 = $_POST['valor4'];

        $my_query = " UPDATE `$tabla1` SET `$campo2`='$valor2',`$campo3`='$valor3',`$campo4`='$valor4' WHERE `$campo1` = '$valor1' LIMIT 1 ";

        if ($conn->query($my_query) === TRUE) {
        ?>
            <div class="container">
                <img src='./imagenes/icon-good.svg'>Se modificó <?php echo $cosa . " " .  $valor2 ?><br>
            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <?php
                echo $conn->error;
                ?>
                <br><img src='./imagenes/icon-bad.svg'> Error, no se modificó <?php echo $cosa; ?>, tome nota del error<br>
            </div>
        <?php
        }
    }

    if ($accion == 5) /// baja
    {
        $valor1 = $_POST['valor1'];
			$query="select * from peliculas where genero=$valor1";
			$result = $conn->query($my_query);

        if($result){
        ?>
            <div class="container">
                Hay películas que tienen asignado ese género. No se puede borrar hasta tanto modifique las películas.<br>
            </div>
        <?php
        } else {
            $my_query = "SELECT * FROM $tabla1 WHERE $campo1='$valor1'";
            $result = $conn->query($my_query);
            while ($arr = $result->fetch_assoc()) {
                $campot1 = $arr['id_genero'];
                $campot2 = $arr['nombre_genero'];
            }
            $my_query = " DELETE FROM `$tabla1` WHERE `$campo1`='$valor1' ";

            if ($conn->query($my_query) === TRUE) {
            ?>
                <div class="container">
                    <img src='./imagenes/icon-good.svg'> Se borró <?php echo $cosa; ?> siguiente....<br>
                    Código: <?php echo $campot1; ?><br>
                    Nombre: <?php echo $campot2; ?><br><br>
                </div>
            <?php
            } else {
            ?>
                <div class="container">
                    <?php
                    echo $conn->error;
                    ?>
                    <br><img src='./imagenes/icon-bad.svg'> Error, no se borró <?php echo $cosa; ?>, tome nota del error <br>
                </div>
            <?php
            }
        }
    }

    if ($accion == 3) /// trae datos para modificar
    {
        $valor1 = $_POST['valor1'];

        $my_query = "SELECT *  FROM $tabla1 WHERE $campo1='$valor1'";
        $result = $conn->query($my_query);
        while ($arr = $result->fetch_assoc()) {
            $id_genero = $arr['id_genero'];
            $nombre_genero = $arr['nombre_genero'];
            $orden = $arr['orden'];
            $estado = $arr['estado'];
        }

        $muestroestado = $estado == 0 ? "Inactivo" : "Activo";

    ?>
        <div class="form-section">
            <h3>Modificar datos de género</h3>
            <form action='<?php echo $filename; ?>' method='post'>
                <input type='hidden' name='accion' value='2'>
                <input type='hidden' name='valor1' value='<?php echo $id_genero; ?>'>
                <label>Código:</label><b><?php echo $id_genero; ?></b><br>
                <label>Nombre:</label><input type='text' name='valor2' value='<?php echo $nombre_genero; ?>' size='60' maxlength='60'><br>
                <label>Orden:</label><input type='text' name='valor3' value='<?php echo $orden; ?>' size='2' maxlength='2'><br>
                <label>Estado:</label>
                <select name='valor4'>
                    <option value='<?php echo $estado; ?>' selected><?php echo $muestroestado; ?></option>
                    <option value='1'>Activo</option>
                    <option value='0'>Inactivo</option>
                </select><br>
                <button type='submit' class='button button-green'>Modificar</button>
            </form>
        </div>
    <?php
    }

    if ($accion == 0 || $accion == 5 || $accion == 2) {
        // formulario de alta
    ?>
        <div class="form-section">
    <h3>Alta de géneros de películas</h3>
    <form name='form1' method='post' action=''>
        <input name='valor2' type='text' size='60' maxlength='60' placeholder='Nombre'><br>
        <input name='valor3' type='text' size='2' maxlength='2' placeholder='Orden'><br>
        <select name='valor4' onchange="this.setAttribute('data-placeholder', '');">
            <option value='' selected disabled hidden>Estado</option>
            <option value='1'>Activo</option>
            <option value='0'>Inactivo</option>
        </select><br>
        <button type='submit' class='button button-blue'>Agregar</button>
        <input type='hidden' name='accion' value='1'>
    </form>
</div>

    <?php
    }
    ?>
    
    <div class="container">
        <!-- muestra lo cargado -->
        <div class="table-container">
            <?php
            $my_query = "SELECT * FROM $tabla1 ORDER BY 3";
            $result = $conn->query($my_query);

            if ($result->num_rows > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Orden</th>
                            <th>Estado</th>
                            <th>Modificar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($arr = $result->fetch_assoc()) {
                            $id_genero = $arr['id_genero'];
                            $nombre_genero = $arr['nombre_genero'];
                            $orden = $arr['orden'];
                            $estado = $arr['estado'];

                            $muestroestado = $estado == 0 ? "Inactivo" : "Activo";
                        ?>
                            <tr>
                                <td><?php echo $id_genero; ?></td>
                                <td><?php echo $nombre_genero; ?></td>
                                <td><?php echo $orden; ?></td>
                                <td><?php echo $muestroestado; ?></td>
                                <td>
                                    <form action='<?php echo $filename; ?>' method='post'>
                                        <input type='hidden' name='accion' value='3'>
                                        <input type='hidden' name='valor1' value='<?php echo $id_genero; ?>'>
                                        <button type='submit' class='button button-green'>Modificar</button>
                                    </form>
                                </td>
                                <td>
                                    <form action='<?php echo $filename; ?>' method='post'>
                                        <input type='hidden' name='accion' value='5'>
                                        <input type='hidden' name='valor1' value='<?php echo $id_genero; ?>'>
                                        <button type='submit' class='button button-red'>Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<p>No hay géneros cargados</p>";
            }
            ?>
        </div>
        <div class="links">
            <a href="abm_peliculas.php" class="button button-blue">Gestionar Películas</a>
            <a href="abm_directores.php" class="button button-blue">Gestionar Directores</a>
            <a href="abm_nacionalidades.php" class="button button-blue">Gestionar Nacionalidades</a>
        </div>
        <a href="logout.php" class="button button-red">Logout</a>
    </div>

	<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selects = document.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
            var select = selects[i];
            select.addEventListener('change', function() {
                this.setAttribute('data-placeholder', '');
            });
        }
    });
</script>

</body>

</html>
