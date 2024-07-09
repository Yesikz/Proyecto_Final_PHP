<?php session_start(); 
include 'config.php';

$sql = "SELECT nombre_pelicula, id_pelicula FROM peliculas LIMIT 12";
$result = $conn->query($sql);
?>




    <!DOCTYPE php>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logoY.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Biryani:wght@200;300;400;600;700;800;900&family=Carrois+Gothic&family=Noto+Sans+Khojki&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/menu-hamburguesa.css">

        <title>Acisey Movies</title>
        
    </head>

    <body>
        <header>
            <div class="logo-container">
                <h1><img id="logo" src="../img/cinemaacicey2.png" width="100 px" alt="logo"></h1>
            </div>

            <div class="mobile-menu-toggle">
                <button class="hamburger" onclick="toggleMenu()">
                    <span class="hamburger-box">
                        <span class="hamburger-inner">&#9776;</span>
                    </span>
                </button>
            </div>

            <nav id="navbar">
                <div class="menu">
                    <ul>
                        <li><a href="../index.html">Inicio</a></li>
                    </ul>
                </div>
            </nav>
        </header>


        <main>
            



            <section>
                <br>
                <h1>Tendencias de Hoy</h1>
                <div class="contenedor">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            echo '<div class="card">';
                            echo "<a href=ver_pelis.php?id_pelicula=$id_pelicula>";
                            echo '<figure>';
                            echo "<img src='muestraimagen.php?id_pelicula=$id_pelicula'. alt= . $row[nombre_pelicula] . >";
                            echo '</figure>';
                            echo '<div class="info">';
                            echo '<h2>' . $row["nombre_pelicula"] . '</h2>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<h1 >No hay películas disponibles.</h1>";
                    }
                    ?>


                </div>
                <div class="boton-direc">
                    <button type="submit">Anterior</button>
                    <button type="submit">Siguiente</button>
                </div>
            </section>
            <br>
            <hr>

            <section>
                

        


            <footer class="footer">
                <div class="texto-footer">
                    <div>
                        <ul>
                            <li class="term-1">Términos y Condiciones</li>
                            <li class="term-1">Preguntas Frecuentes</li>
                            <li class="term-1">Ayuda</li>
                        </ul>
                    </div>
                </div>
                <div class="redes-sociales">
                    <a href="https://www.facebook.com/" target="_blank"><img src="../img/facebook.png" alt="Facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="../img/instagram.png" alt="Instagram"></a>
                    <a href="https://twitter.com/" target="_blank"><img src="../img/twitter.png" alt="Twitter"></a>
                </div>
            </footer>

            <!--Scrips-->

            <script src="./js/menu-hamburguesa.js"></script>
    </body>

    </html>