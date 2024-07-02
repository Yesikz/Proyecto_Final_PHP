<?php
/**
* @version		$Id: abm_nacionalidades.php  
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

$tabla1= 'nacionalidades' ;
$campo1='id_nacio' ;
$campo2='nombre' ;
$campo3='pais' ;
$campo4='estado' ;
$cosa='el pais';
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

		<style>
    .form-section {
        margin-top: 20px;
        padding: 20px;
        background-color: #333;
        border-radius: 8px;
    }

    .form-section h3 {
        color: #fff;
    }

    .form-section input[type='text'],
    .form-section select {
        width: calc(100% - 20px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #333;
        background-color: #fff;
    }

    .form-section input[type='text']::placeholder,
    .form-section select[data-placeholder=''] {
        color: #999;
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

    </style>
</head>
<body>
    <div class="container">
			<h1 class="titulo-h1">Nacionalidades</h1>
            <a href="admin_dashboard.php" class="button button-blue">Volver al dashboard</a>
            </div>
      </div>

<?php 

if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if($debug) {
    		echo "El valor de 'accion' es: " . $accion;
    		}
} else {
    if($debug) {
    	// La variable no está presente, realiza alguna acción predeterminada o muestra un mensaje de error
    	if($debug)
    	{
   			 echo "La variable 'accion' no se ha recibido.";
    	}
    $accion = 0;
}
}

	
	if ($accion==1)/// alta 
		{ 
			///// var_dump($_POST);
			echo "<br>";
			$valor2 = $_POST['valor2'];
			$valor3 = $_POST['valor3'];
			$valor4 = $_POST['valor4'];
		
			$my_query="INSERT INTO `$tabla1` ( `$campo2` , `$campo3`, `$campo4`  )   VALUES ( '$valor2','$valor3','$valor4' )";

			if ($conn->query($my_query)=== TRUE)
			{
				?>
				<img src='./imagenes/ok.jpg'>Se agregó <?php echo $cosa." ".  $valor2 ?> <br>		
				<?php 		
			}
			else
			{
				echo $conn->error;
				echo "<br><img src='./imagenes/oo.jpg'> Error, no se agregó $cosa, tome nota del error<br>";
			}
	  }	
	
	if ($accion==2) /// modificacion
		 {
		 	
		 	$valor1 = $_POST['valor1'];
			$valor2 = $_POST['valor2'];
			$valor3 = $_POST['valor3'];
			$valor4 = $_POST['valor4'];
		
		 	
		 	
	 			$my_query=" UPDATE `$tabla1` SET	`$campo2`='$valor2',`$campo3`='$valor3',`$campo4`='$valor4' WHERE `$campo1` = '$valor1' LIMIT 1 ";
	 			
			if ($conn->query($my_query)=== TRUE)
				{
					?>
				<img src='./imagenes/ok.jpg'>Se modificó <?php echo $cosa." ".  $valor2 ?> <br>		
				<?php 
				}
				else
				{
					echo $conn->error;
					echo "<br><img src='./imagenes/oo.jpg'> Error, no se modificó $cosa, tome nota del error<br>";
				}
			}


if ($accion==5) /// baja

  {
 	  	$valor1 = $_POST['valor1'];
 	  	$valor2 = $_POST['valor2'];
 	  	

/* 			$query="select * from peliculas where genero=$valor1";
			$result = $conn->query($my_query);
			
			if($result){
				echo" hay peliculas que tienen asigando ese pais, no se puede borrar hasta tanto modifique las pelis";
				}  
 	  
 	  	else{   */
		 	   /* 	$my_query= "select * from $tabla1 where $campo1='$valor1'  ";     
						$result = $conn->query($my_query);
						while($arr = $result->fetch_assoc())			
						{
								$campot1=$arr['id_genero'];
								$campot2=$arr['nombre_genero'];	
						}   */ 

			 			$my_query=" delete from `$tabla1` where `$campo1`='$valor1' ";
					
						if( $conn->query($my_query) ===TRUE)
						{
								echo "<img src='./imagenes/ok.jpg'>  Se borró $cosa siguiente....<br>";
								echo "Código:  $valor1 <br>
								      Nombre:  $valor2 <br><br>";
						}
						else
						{
							echo $conn->error;
							echo "<br><img src='./imagenes/oo.jpg'> Error, no se borró $cosa, tome nota del error <br>";
						}
					}
	




if ($accion==3) /// trae datos para modificar
		{
			$valor1 = $_POST['valor1'];	
			
			$my_query="select *  from $tabla1 where $campo1='$valor1'";

			
			$result = $conn->query($my_query);
			while($arr = $result->fetch_assoc())
			{
					$id_nacio=$arr['id_nacio'];
					$nombre=$arr['nombre'];
					$pais=$arr['pais'];	
					$estado=$arr['estado'];
			}
			
	if ($estado==0)
		{ $muestroestado="Inactivo" ;
		}
  else
		{	$muestroestado="Activo" ;
		}						
			
			
			echo "Modifique los datos que desea corregir: ";
    echo "<form action='$filename' method='post' class='form-section'>";
    echo "<input type='hidden' name='accion' value='2'>";
    echo "<input type='hidden' name='valor1' value='$id_nacio'>";
    echo "Codigo:<b> $id_nacio</b><br>";
			echo "Nombre: <input type='text' name='valor2' value='$nombre' size=60 maxlength=60><br>";
			echo "País: <input type='text' name='valor3' value='$pais' size=2 maxlength=2><br>";
			echo "Estado: <select name='valor4'><option value='$estado' selected >$muestroestado</option>
     <option value='1'>Activo</option><option value='0'>Inactivo</option></select><br>";
    echo "<button type='submit' class='button button-blue'>Modificar</button>";
			echo "</form>";
		echo "<br><br>";
	}

		if ($accion == 0 || $accion == 5 || $accion == 2 || $accion == 1) { // form de alta
			echo "<br>";
			echo "<div class='form-section'>";
			echo "<h3>Alta de países para pelis y directores</h3>";
			echo "<form name='form1' method='post' action='$filename'>";
			echo "<input name='valor2' type='text' size='40' maxlength='40' placeholder='Nombre'><br>";
			echo "<input name='valor3' type='text' size='40' maxlength='40' placeholder='País'><br>";
			echo "<select name='valor4' onchange=\"this.setAttribute('data-placeholder', '');\">";
			echo "<option value='' selected disabled hidden>Estado</option>";
			echo "<option value='1'>Activo</option>";
			echo "<option value='0'>Inactivo</option>";
			echo "</select><br>";
			echo "<input type='hidden' name='accion' value='1'><br><input type='submit' class='button button-green' value='Cargar'>";
			echo "<input type='hidden' name='accion' value='1'>";
			echo "</form>";
			echo "</div>";
			echo "<br><br>";
		}
		


/////////////////////////////////////////////////
//////// muestra lo cargado /////////////

	$my_query= "select * from $tabla1 order by 3";  
	$result = $conn->query($my_query);		

if ($result) {
		echo "<br>";
		echo "<b>Paises cargados </b>:";
    echo "<div class='table-container'>";
    echo "<table>";
    echo "<tr><th align=center>Código</th><th align=center>Nombre</th><th align=center>País</th><th align=center>Estado</th><th>-</th><th>-</th></tr>";
		
    while ($arr = $result->fetch_assoc()) {
        $id_nacio = $arr['id_nacio'];
        $nombre = $arr['nombre'];
        $pais = $arr['pais'];
        $estado = $arr['estado'];

        $bgcolor = ($arr['estado']) ? '#1c1c22' : '#cccccc';

        echo "<form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='3'>";
        echo "<input type='hidden' name='valor1' value='$id_nacio'>";
        echo "<tr bgcolor='$bgcolor'>";
        echo "<td>$id_nacio</td>";
        echo "<td>$nombre</td>";
        echo "<td>$pais</td>";
        echo "<td>$estado</td>";
        echo "<td><button type='submit' class='button button-blue'>Modificar</button></td>";
        echo "</form><form action='$filename' method='post'>";
        echo "<input type='hidden' name='accion' value='5'>";
        echo "<input type='hidden' name='valor1' value='$id_nacio'>";
        echo "<input type='hidden' name='valor2' value='$pais'>";
        echo "<td><button type='submit' class='button button-red'>Borrar</button></td></form>";
        echo "</tr>";
			}
		echo "</table>";
    echo "</div>";
} else {
    echo "<b>No hay paises cargados</b><br>";
	}
	

?>
 <div class="container">
        <div class="links">
			<a href="abm_peliculas.php" class="button button-blue">Gestionar Películas</a>
            <a href="abm_directores.php" class="button button-blue">Gestionar Directores</a>
            <a href="abm_nacionalidades.php" class="button button-blue">Gestionar Nacionalidades</a>
    </div>
	<a href="logout.php" class="button button-red">Logout</a>
    </div>
</body>
</html>