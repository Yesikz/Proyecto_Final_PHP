<?php
/**
* @version      $Id: abm_peliculas.php  
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
$generos="";
$generoo="";
$nombre_generoo="";
$nombre_dirr="";
$nacionalidadd="";
$nombree="";
$id_pelicula="";
$lanzamiento="";
$duracion="";
$directorr="";
$nombre_pelicula ="";
$sinapsis="";
$clasificacion="";
$calificacion="";
$orden="";
$estado="";
$muestroestado="";
$esteanio=date("Y");

  if (isset($_POST['accion'])) {
        // La variable está presente, puedes realizar acciones con ella
        $accion = $_POST['accion'];
    if ($debug==1) {
            echo "El valor de 'accion' es: " . $accion;
        echo"<br>";
        }
    } else {
        // La variable no está presente, realiza alguna acción predeterminada o muestra un mensaje de error
        if ($debug==1) {
            echo "La variable 'accion' no se ha recibido.";
        echo"<br>";
        }
        $accion = 0;
    }



$directores="";
$paises="";
include 'config.php';
$filename = basename($_SERVER['PHP_SELF']);

$tabla1='peliculas';
$campo1='id_pelicula';
$campo2='nombre_pelicula';
$campo3='genero';
$campo4='lanzamiento';
$campo5='duracion';
$campo6='director';
$campo7='sinapsis';
$campo8='nacionalidad';
$campo9='clasificacion';
$campo10='calificacion';
$campo11='orden';
$campo12='estado';
$campo13='poster';



$cosa='la pelicula';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Administrador</title>
    <style>
 body {
    font-family: Arial, sans-serif;
    background-color: #1c1c22;
}
.container {
    width: 80%;
    margin: 0 auto;
    text-align: center;
}

.titulo-h1 {
    display: grid;
    place-items: center;
    color: white;
}
.titulo-h3{
    color: white;
    margin-top: 20px;
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
form input[type="number"],
form textarea,
form select {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #555;
    border-radius: 4px;
    background-color: #1c1c22;
    color: white;
}

form input[type="text"]::placeholder,
form input[type="number"]::placeholder,
form textarea::placeholder {
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

    </style>
</head>
<body>
    <div class="container">
        <!-- <h2>Bienvenido, <?php echo $_SESSION['admin_nombre']; ?></h2>
        <p>Has iniciado sesión como: <?php echo $_SESSION['admin_nombre']; ?></p> -->
      </div>

    <?php

if ($accion == 1) { // alta
        // var_dump($_POST);
       //  echo "<br>";
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $valor4 = $_POST['valor4'];
        $valor5 = $_POST['valor5'];
    $valor6 = $_POST['valor6'];
    $valor7 = $_POST['valor7'];
    $valor8 = $_POST['valor8'];
    $valor9 = $_POST['valor9'];
    $valor10 = $_POST['valor10'];
    $valor11= $_POST['valor11'];
    $valor12 = $_POST['valor12'];


    $my_query = "INSERT INTO `$tabla1` (`$campo2`, `$campo3`, `$campo4`, `$campo5`,
        `$campo6`, `$campo7`, `$campo8`, `$campo9`, `$campo10`, `$campo11`, `$campo12`)   
    VALUES ('$valor2', '$valor3', '$valor4', '$valor5','$valor6', '$valor7', '$valor8', '$valor9',
        '$valor10', '$valor11', '$valor12')";


        if ($conn->query($my_query) === TRUE) 
        {
        ?>
        <img src='./imagenes/icon-good.svg'>Se agregó <?php echo $cosa . " " . $valor2 ?><br>        
        <?php        
        } 
        else 
        {
            echo $conn->error;
            echo "<br><img src='./imagenes/icon-bad.svg'> Error, no se agregó $cosa, tome nota del error<br>";
        }
    }

//// modificacion
if ($accion == 2) { 

        $valor1 = $_POST['valor1'];
        $valor2 = $_POST['valor2'];
        $valor3 = $_POST['valor3'];
        $valor4 = $_POST['valor4'];
        $valor5 = $_POST['valor5'];
    $valor6 = $_POST['valor6'];
    $valor7 = $_POST['valor7'];
    $valor8 = $_POST['valor8'];
    $valor9 = $_POST['valor9'];
    $valor10 = $_POST['valor10'];
    $valor11 = $_POST['valor11'];
    $valor12 = $_POST['valor12'];


    $my_query = "UPDATE `$tabla1` SET `$campo2`='$valor2', `$campo3`='$valor3', `$campo4`='$valor4', `$campo5`='$valor5',
    `$campo6`='$valor6', `$campo7`='$valor7', `$campo8`='$valor8', `$campo9`='$valor9', `$campo10`='$valor10',
    `$campo11`='$valor11', `$campo12`='$valor12'       WHERE `$campo1` = '$valor1' LIMIT 1";

if($debug){
    echo " query : $my_query <br>";
}

        if ($conn->query($my_query) === TRUE) {
        ?>
        <img src='./imagenes/icon-good.svg'>Se modificó <?php echo $cosa . " " . $valor2 ?><br>        
        <?php
        } else {
            echo $conn->error;
            echo "<br><img src='./imagenes/icon-bad.svg'> Error, no se modificó $cosa, tome nota del error<br>";
        }
    }

// baja 

if ($accion == 5) 
{ 
        $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
   
   /*
            $my_query = "select * from peliculas where $campos1 =$valor1";
        $result = $conn->query($my_query);

    if ($result) {
        echo " hay peliculas que tienen asignado ese director, no se puede borrar hasta tanto modifique las pelis";
        } else {
            $my_query = "select * from $tabla1 where $campo1='$valor1'";
            $result = $conn->query($my_query);
            while ($arr = $result->fetch_assoc()) {
                $campot1 = $arr['id_dir'];
                $campot2 = $arr['nombre_dir'];
        } */

            $my_query = "delete from `$tabla1` where `$campo1`='$valor1'";

            if ($conn->query($my_query) === TRUE) {
            echo "<img src='./imagenes/icon-good.svg'>  Se borró $cosa siguiente....<br>";
            echo "Código:  $valor1 <br>
                  Nombre:  $valor2 <br><br>";
            } else {
                echo $conn->error;
                echo "<br><img src='./imagenes/icon-bad.svg'> Error, no se borró $cosa, tome nota del error <br>";
            }
        }
/////////////////////////////////////

if ($accion == 3) { // trae datos para modificar
        $valor1 = $_POST['valor1'];
    
    $esteanio=date("Y");

$my_query ="
select 
    t1.id_pelicula, t1.nombre_pelicula, t1.genero, t1.lanzamiento , t1.duracion  , t1.director ,
    t1.sinapsis ,  t1.nacionalidad , t1.clasificacion ,  t1.calificacion , t1.orden , t1.estado , t1.poster ,
    t2.id_genero, t2.nombre_genero , t3.id_dir, t3.nombre_dir, t4.id_nacio, t4.nombre  
   from peliculas as t1,  generos as t2, directores as t3, nacionalidades as t4
        where  t1.id_pelicula='$valor1'  AND 
               t1.genero=t2.id_genero AND 
               t1.director=t3.id_dir  AND 
               t1.nacionalidad=t4.id_nacio   order by t1.orden";

                            //// if($debug) {    echo "my_query $my_query <br>"; }

$result = $conn->query($my_query);

if ($result->num_rows > 0) {
    // Obtener el único registro
    $arr = $result->fetch_assoc();
    
    $id_pelicula = $arr['id_pelicula'];
    $nombre_pelicula = $arr['nombre_pelicula'];
    $generoo = $arr['genero'];
    $nombre_generoo = $arr['nombre_genero'];

    $lanzamiento = $arr['lanzamiento'];
    $duracion = $arr['duracion'];
    $directorr=$arr['director'];
    $nombre_dirr=$arr['nombre_dir'];

    $sinapsis = $arr['sinapsis'];
    $calificacion = $arr['calificacion'];
    $clasificacion = $arr['clasificacion'];
    $nombre_dir = $arr['nombre_dir'];

    $nacionalidadd = $arr['nacionalidad'];
    $nombree = $arr['nombre'];
    
    $orden = $arr['orden'];
    $estado = $arr['estado'];
     

    if ($estado == 0) {
        $muestroestado = "Inactivo";
    } else {
        $muestroestado = "Activo";
    }

} else {
    echo "No se encontró ningún registro.";
}

 $generos="<option value='$generoo'>$nombre_generoo</option>";
 $directores="<option value='$directorr'>$nombre_dirr</option>";
 $paises="<option value='$nacionalidadd'>$nombree</option>";


 // lo que traigo de las otra tablas
    // generos
    $my_query3= "select *  from generos  where estado=1 order by nombre_genero"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_genero=$arr['id_genero'];
        $nombre_genero=$arr['nombre_genero'];
        $generos =$generos."<option value='$id_genero'>$nombre_genero</option>";
        
    }

    // directores
    $my_query3= "select *  from directores  where estado=1 order by nombre_dir"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_dir=$arr['id_dir'];
        $nombre_dir=$arr['nombre_dir'];
        $directores =$directores."<option value='$id_dir'>$nombre_dir</option>";
        
    }

   // paises
    $my_query3= "select *  from nacionalidades  where estado=1 order by nombre"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_nacio=$arr['id_nacio'];
        $nombre=$arr['nombre'];
        $paises =$paises."<option value='$id_nacio'>$nombre</option>";
    }

    echo "Modifique los datos que desea corregir: ";
    echo "<form action='$filename' method='post'>";
    echo "<input type='hidden' name='accion'  value='2'>";
    echo "<input type='hidden' name='valor1'  value='$id_pelicula'>";
    echo "Codigo:<b> $id_pelicula</b><br>";
    echo "Nombre: <input type='text' name='valor2' value='$nombre_pelicula' size=60 maxlength=60><br>";
    ?>
         Genero: </strong></font> <select name='valor3' size='1'>
          <?php echo $generos ?> </select><br> 
    <?php

    echo "Lanzamiento: <input name='valor4' type='number' size='4' maxlength='4' value='$lanzamiento' min='1900' max='$esteanio'><br>";
    echo "Duracion: <input name='valor5' type='number' size='3' maxlength='3' value='$duracion'min='5'><br>";
    ?>
        <br> Director: </strong></font> <select name='valor6' size='1'>
          <?php echo $directores ?> </select> <br> 
    <?php 
      echo "Sinapsis: <br>
    <textarea name='valor7' rows='5' cols='50'>$sinapsis</textarea><br>";
    ?>

           Origen: </strong></font> <select name='valor8' size='1'>
          <?php echo $paises ?> </select> <br>
    <?php
        
    echo "Clasificacion: <input name='valor9' type='text' size='40' maxlength='40' value='$clasificacion'><br>";
   
    echo "Calificacion: 
    <select name='valor10' size='1'><option value='$calificacion'>$calificacion</option>
    <option value='1'>1</option>
    <option value='1,5'>1,5</option><option value='2'>2</option><option value='2,5'>2,5</option>
    <option value='3'>3</option><option value='3,5'>3,5</option><option value='4'>4</option>
    <option value='4,5'>4,5</option><option value='5'>5</option>
          </select> Estrellas<br>";


    echo "Orden: <input type='text' name='valor11' value='$orden' size=2 maxlength=2><br>";
    echo "Estado: <select name='valor12'><option value='$estado' selected >$muestroestado</option>
          <option value='1'>Activo</option><option value='0'>Inactivo</option></select><br>";
    echo "<input type='submit' value='Modificar'>";
    echo "</form>";
    echo "<br><br>";
}

// pone el poster 
if ($accion == 8)

{ 
    // Obtener el ID de la película desde el formulario
    $id_pelicula = $_POST['id_pelicula'];

    if($debug)
    {
        echo " id_peli: $id_pelicula<br>";
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Verificar que el archivo se haya cargado correctamente
    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        // Obtener el contenido del archivo
        $file = $_FILES['file']['tmp_name'];
        $fileData = file_get_contents($file);

        // Verificar que el contenido del archivo no esté vacío
        if ($fileData !== false && strlen($fileData) > 0) {
            // Construir la consulta para actualizar el campo poster
            $query = "UPDATE peliculas SET poster = ? WHERE id_pelicula = ?";

            // Preparar la consulta
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die("Error preparando la consulta: " . $conn->error);
            }

            // Vincular los parámetros y ejecutar la consulta
            $null = NULL;
            $stmt->bind_param("bi", $null, $id_pelicula);
            $stmt->send_long_data(0, $fileData);

            if ($stmt->execute()) {
                echo "La imagen se cargó correctamente.";
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }

            // Cerrar la consulta
            $stmt->close();
        } else {
            echo "El archivo está vacío o no se pudo leer.";
        }
    } else {
        echo "Error al cargar el archivo.";
    }
} else {
    echo "Método de solicitud no válido o falta de parámetros.";
}

// No cerramos la conexión $conn->close(); aquí para permitir otros queries posteriores
}

///////////////////////////////////////////
include 'config.php' ;

// Formulario de alta
if ($accion == 0 || $accion == 5 || $accion == 2 || $accion == 1) 

  $my_query3="";
    // lo que traigo de las otra tablas
    // generos
    $my_query3= "select *  from generos  where estado=1 order by nombre_genero"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_genero=$arr['id_genero'];
        $nombre_genero=$arr['nombre_genero'];
        $generos =$generos."<option value='$id_genero'>$nombre_genero</option>";
        
    }

    // directores
    $my_query3= "select *  from directores  where estado=1 order by nombre_dir"; 

    $result = $conn->query($my_query3);
    while($arr = $result->fetch_assoc())
    {
        $id_dir=$arr['id_dir'];
        $nombre_dir=$arr['nombre_dir'];
        $directores =$directores."<option value='$id_dir'>$nombre_dir</option>";
        
    }

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
    ?>
    <div class="container">
        <h1 class="titulo-h1">Alta de Películas</h1>
        <div class="links">
            <a href="admin_dashboard.php" class= "button button-blue">Volver al dashboard</a>
        </div>

        <?php
        echo "<form name='form1' method='post' action='$filename' enctype='multipart/form-data'>";
        echo "<input name='valor2' type='text' size='40' maxlength='40' placeholder='Nombre'><br>";
        ?>
        <select name='valor3' size='1'>
            <?php echo $generos ?> 
        </select><br>
        <?php
        echo "<input name='valor4' type='number' size='4' maxlength='4' placeholder='Lanzamiento' min='1900' max='$esteanio'><br>";
        echo "<input name='valor5' type='number' size='3' maxlength='3' placeholder='Duración' min='5'><br>";
        ?>
        <select name='valor6' size='1'>
            <?php echo $directores ?> 
        </select><br>
        <?php
        echo "<textarea name='valor7' rows='6' cols='50' placeholder='Sinopsis'>Escribe algo</textarea><br>";
        ?>
        <select name='valor8' size='1'>
            <?php echo $paises ?> 
        </select><br>
        <?php
        echo "<input name='valor9' type='text' size='40' maxlength='40' placeholder='Clasificación'><br>";
        ?>
         </select> <h3 class="titulo-h3">Estrellas</h3><br>
        <select name='valor10' size='1'>
            <option value='1'>1</option>
            <option value='1,5'>1,5</option>
            <option value='2'>2</option>
            <option value='2,5'>2,5</option>
            <option value='3'>3</option>
            <option value='3,5'>3,5</option>
            <option value='4'>4</option>
            <option value='4,5'>4,5</option>
            <option value='5'>5</option>
       
        <?php
        echo "<input name='valor11' type='text' size='2' maxlength='2' placeholder='Orden'><br>";
        ?>
        <select name='valor12'>
            <option value='1'>Activo</option>
            <option value='0'>Inactivo</option>
        </select><br>
        <div>
      <!--      <h3 class="titulo-h3">Subir archivo</h3>
            <input type='file' name='file'> -->
            <input type='hidden' name='accion' value='1'>
            <br> 
            <input type='submit' class='button button-green' value='Cargar'>
            </form>
        </div> 

    <?php
    //Muestra las peliculas cargadas
    $my_query = "select 
    t1.id_pelicula, t1.nombre_pelicula, t1.genero,t1.lanzamiento , t1.duracion  , t1.director ,
    t1.sinapsis ,  t1.nacionalidad , t1.clasificacion ,  t1.calificacion , t1.orden , t1.estado , t1.poster ,
    t2.id_genero, t2.nombre_genero , t3.id_dir, t3.nombre_dir, t4.id_nacio, t4.nombre  
   from peliculas as t1,  generos as t2, directores as t3, nacionalidades as t4
        where  t1.genero=t2.id_genero AND 
               t1.director=t3.id_dir  AND 
               t1.nacionalidad=t4.id_nacio   order by t1.orden";

    $result = $conn->query($my_query);

if ($result)
{   
        echo "<br>";
    ?><div class="container"><h1 class="titulo-h1">Alta de Películas</h1></div>
    <?php
        echo "<table border=1>";
    echo "<tr><td align=center> Codigo</td>
              <td align=center>Nombre</td>
              <td align=center>Genero</td>
              <td align=center>Año</td>
              <td align=center>Minutos</td>
              <td align=center>Director</td>
              <td align=center>Sinapsis</td>
              <td align=center>Calificacion</td>
              <td align=center>Clasificacion</td>
              <td align=center>Estado</td>
              <td>-</td><td>-</td>
              <td align=center>Poster</td>
              <td align=center>Cambiar Poster</td>
              </tr>";

        while ($arr = $result->fetch_assoc()) {
        $id_pelicula = $arr['id_pelicula'];
        $nombre_pelicula = $arr['nombre_pelicula'];
        $nombre_genero = $arr['nombre_genero'];
        $lanzamiento = $arr['lanzamiento'];
        $duracion = $arr['duracion'];
        $nombre_dir = $arr['nombre_dir'];
        $sinapsis = $arr['sinapsis'];
        $calificacion = $arr['calificacion'];
        $clasificacion = $arr['clasificacion'];
        $estado = $arr['estado'];

        echo "<form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='3'>";
        echo "<input type='hidden' name='valor1'  value='$id_pelicula'>";
            
        $propio = $arr['estado'];

        if ($propio) {
            $bgcolor = '#99ccff';
        } else {
            $bgcolor = '#cccccc';
        }

            echo "<tr bgcolor='$bgcolor'>";
        echo "<td> $id_pelicula </td>";
        echo "<td> $nombre_pelicula </td>";
        echo "<td> $nombre_genero</td>";
        echo "<td> $lanzamiento</td>";
        echo "<td> $duracion</td>";
        echo "<td> $nombre_dir</td>";
        echo "<td> $sinapsis</td>";
        echo "<td> $calificacion</td>";
        echo "<td> $clasificacion</td>";

        echo "<td> $estado</td>";
        echo "<td><input type='submit' value='modificar'></td>";           
            echo "</form><form action='$filename' method='post'>";
            echo "<input type='hidden' name='accion' value='5'>";
        echo "<input type='hidden' name='valor1' value='$id_pelicula'>";
        echo "<input type='hidden' name='valor2' value='$nombre_pelicula'>";
        echo "<td><input type='submit' value='borrar'></form></td>";
        echo "<td><img src='muestraimagen.php?id_pelicula=$id_pelicula' width='100' height='150'></td>";

       echo"
        <td>
        <form action=$filename method='post' enctype='multipart/form-data'>
        <input type='hidden' name='accion' value='8'>
        <input type='hidden' name='id_pelicula' id='id_pelicula' value='$id_pelicula'>
        Poster: <input type='file' name='file'><br>
        <input type='submit' value='Subir Foto' name='submit'>
        </form>
        </td>";
    

        echo "</tr>";
        }
        echo "</table>";
    } else {
    echo "<b>No hay Peliculas cargadas</b><br>";
    }
    

?>
 <div class="container">
    <div class="links">
        <a href="abm_directores.php" class="button button-blue">Gestionar Directores</a>
        <a href="abm_generos.php" class="button button-blue">Gestionar Géneros</a>
        <a href="abm_nacionalidades.php" class="button button-blue">Gestionar Nacionalidades</a>
    </div>
    <a href="logout.php" class="button button-red">Logout</a>
</div>
</body>
</html>