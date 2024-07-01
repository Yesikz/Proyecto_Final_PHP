<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí se manejarán las operaciones de alta, baja y modificación
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ABM Películas</title>
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

        .gestion-h2 {
            margin-bottom: 20px;
            text-align: center;
            position: relative;
            display: inline-block;
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="gestion-h2">Gestionar Películas</h2>
        <form action="abm_peliculas.php" method="post">
            <!-- Aquí van los campos del formulario para alta, baja y modificación -->
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Género</th>
                <th>Director</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
            </tr>
            <!-- Aquí se mostrará la lista de películas -->
        </table>
    </div>
</body>
</html>




<?php
/**
* @version      $Id: abmd_directores.php  
* @package      
* @copyright    
* 
* Version Para php 5.
*/







if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

$debug = 0;
include 'config.php';
$filename = basename($_SERVER['PHP_SELF']);

$tabla1 = 'directores';
$campo1 = 'id_dir';
$campo2 = 'nombre_dir';
$campo3 = 'nacionalidad';
$campo4 = 'orden';
$campo5 = 'estado';

$cosa = 'el director';

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

        /* Estilos para formularios */
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

/* Contenedor general */
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
                    let select = document.getElementById('valor3');
                    data.forEach(pais => {
                        let option = document.createElement('option');
                        option.value = pais.codigo;
                        option.textContent = pais.nombre;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar el archivo JSON:', error));
        });
    </script>
</head>
<body>
    <div class="container">
        <!-- <h2>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></h2>
        <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p> -->
        <div class="links">
            <a href="admin_dashboard.php">Volver al dashboard</a>
        </div>
    </div>

    <?php
    if (isset($_POST['accion'])) {
        // La variable está presente, puedes realizar acciones con ella
        $accion = $_POST['accion'];
        if ($debug) {
            echo "El valor de 'accion' es: " . $accion;
        }
    } else {
        // La variable no está presente, realiza alguna acción predeterminada o muestra un mensaje de error
        if ($debug) {
            echo "La variable 'accion' no se ha recibido.";
        }
        $accion = 0;
    }

    if ($accion == 1) {/// alta 
        var_dump($_POST);
        echo "<br>";
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $valor4 = $_POST['valor4'];
        $valor5 = $_POST['valor5'];

        $my_query = "INSERT INTO `$tabla1` ( `$campo2` , `$campo3`, `$campo4`,`$campo5` ) VALUES ( '$valor2','$valor3','$valor4','$valor5' )";

        if ($conn->query($my_query) === TRUE) {
            echo "<img src='./imagenes/ok.jpg'>Se agregó $cosa $valor2 <br>";
        } else {
            echo $conn->error;
            echo "<br><img src='./imagenes/oo.jpg'> Error, no se agregó $cosa, tome nota del error<br>";
        }
    }

    if ($accion == 2) {/// modificacion
        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $valor4 = $_POST['valor4'];
        $valor5 = $_POST['valor5'];

        $my_query = "UPDATE `$tabla1` SET `$campo2`='$valor2',`$campo3`='$valor3',`$campo4`='$valor4',`$campo5`='$valor5' WHERE `$campo1` = '$valor1' LIMIT 1";

        if ($conn->query($my_query) === TRUE) {
            echo "<img src='./imagenes/ok.jpg'>Se modificó $cosa $valor2 <br>";
        } else {
            echo $conn->error;
            echo "<br><img src='./imagenes/oo.jpg'> Error, no se modificó $cosa, tome nota del error<br>";
        }
    }

    if ($accion == 5) {/// baja
        $valor1 = $_POST['valor1'];
        $my_query = "select * from peliculas where director = $valor1";
        $result = $conn->query($my_query);

        if ($result && $result->num_rows > 0) {
            echo "Hay películas que tienen asignado ese director, no se puede borrar hasta tanto modifique las películas.";
        } else {
            $my_query = "select * from $tabla1 where $campo1='$valor1'";
            $result = $conn->query($my_query);
            while ($arr = $result->fetch_assoc()) {
                $campot1 = $arr['id_dir'];
                $campot2 = $arr['nombre_dir'];
            }
            $my_query = "delete from `$tabla1` where `$campo1`='$valor1'";

            if ($conn->query($my_query) === TRUE) {
                echo "<img src='./imagenes/ok.jpg'> Se borró $cosa siguiente....<br>";
                echo "Código:  $campot1 <br>Nombre:  $campot2 <br><br>";
            } else {
                echo $conn->error;
                echo "<br><img src='./imagenes/oo.jpg'> Error, no se borró $cosa, tome nota del error <br>";
            }
        }
    }


    if ($accion == 3) {/// trae datos para modificar
        $valor1 = $_POST['valor1'];
    
        $my_query = "select * from $tabla1 where $campo1='$valor1'";
        $result = $conn->query($my_query);
        while ($arr = $result->fetch_assoc()) {
            $id_dir = $arr['id_dir'];
            $nombre_dir = $arr['nombre_dir'];
            $orden = $arr['orden'];
            $estado = $arr['estado'];
            $nacionalidad = $arr['nacionalidad'];
        }
        $muestroestado = ($estado == 0) ? "Inactivo" : "Activo";
    ?>
    
        <div class="container">
            <h3>Modifique los datos que desea corregir:</h3>
            <form action="<?php echo $filename; ?>" method="post">
                <input type="hidden" name="accion" value="2">
                <input type="hidden" name="valor1" value="<?php echo $id_dir; ?>">
                <label for="codigo">Código:</label>
                <b><?php echo $id_dir; ?></b><br>
                <label for="nombre">Nombre:</label>
                <input type="text" name="valor2" id="nombre" value="<?php echo $nombre_dir; ?>" size="60" maxlength="60"><br>
                <label for="pais-select">Selecciona un país:</label>
                <select id="pais-select" name="pais">
                    <option value=''>Seleccionar</option>
                    <!-- Aquí se deben llenar las opciones con los datos de los países -->
                </select>
                <label for="orden">Orden:</label>
                <input type="text" name="valor3" id="orden" value="<?php echo $orden; ?>" size="2" maxlength="2"><br>
                <label for="estado">Estado:</label>
                <select name="valor4" id="estado">
                    <option value="<?php echo $estado; ?>" selected><?php echo $muestroestado; ?></option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select><br>
                <input type="submit" class="button button-blue" value="Modificar">
            </form>
        </div>
    
    <?php
    }
    /////////////////form de alta////////////////////////
    if ($accion == 0 || $accion == 5 || $accion == 2 || $accion == 1) {
    ?>
    
        <div class="container">
            <h3>Alta de directores de pelis</h3>
            <form name="form1" method="post" action="<?php echo $filename; ?>">
                <label for="nombre">Nombre:</label>
                <input name="valor2" id="nombre" type="text" size="40" maxlength="40" value=""><br>
                <label for="pais-select">Selecciona un país:</label>
                <select id="valor3" name="valor3">
                    <option value=''>Seleccionar</option>
                    <!-- Aquí se deben llenar las opciones con los datos de los países -->
                </select>
                <label for="orden">Orden:</label>
                <input name="valor4" id="orden" type="text" size="2" maxlength="2" value=""><br>
                <label for="estado">Estado:</label>
                <select name="valor5" id="estado">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select><br>
                <input type="hidden" name="accion" value="1">
                <input type="submit" class="button button-green" value="Cargar">
            </form>
        </div>
    
    <?php
    }

    

    /////////////////////////////////////////////////
    //////// muestra lo cargado /////////////

    $my_query = "select * from $tabla1 order by 3";
    $result = $conn->query($my_query);

    if ($result) {
        echo "<br>";
        echo "<b>Directores cargados </b>:";
        echo "<table border=1>";
        echo "<tr><th>Código</th><th>Nombre</th><th>Nacido en</th><th>Orden</th><th>Estado</th><th>-</th><th>-</th></tr>";

        while ($arr = $result->fetch_assoc()) {
            $id_dir = $arr['id_dir'];
            $nombre_dir = $arr['nombre_dir'];
            $orden = $arr['orden'];
            $estado = $arr['estado'];
            $nacionalidad = $arr['nacionalidad'];

            echo "<form action='$filename' method='post'>";
            echo "<input type='hidden' name='accion' value='3'>";
            echo "<input type='hidden' name='valor1' value='$id_dir'>";
            
            //otro condicional que lo hice un poco mas corto.
            $bgcolor = ($arr['estado']) ? '#1c1c22' : '#cccccc';

            echo "<tr bgcolor='$bgcolor'>";
            echo "<td>$id_dir</td>";
            echo "<td>$nombre_dir</td>";
            echo "<td>$nacionalidad</td>";
            echo "<td>$orden</td>";
            echo "<td>$estado</td>";
            echo "<td><input type='submit' class='button button-green' value='Modificar'></td>";
            echo "</form><form action='$filename' method='post'>";
            echo "<input type='hidden' name='accion' value='5'>";
            echo "<input type='hidden' name='valor1' value='$id_dir'>";
            echo "<td><input type='submit' class='button button-red' value='Borrar'></td>";
            echo "</form></tr>";
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
            <a href="abm_directores.php" class="button button-blue">Gestionar Directores</a>
            <a href="abm_nacionalidades.php" class="button button-blue">Gestionar Nacionalidades</a>
        </div>
        <a href="logout.php" class="button button-red">Logout</a>
    </div>
</body>
</html>
