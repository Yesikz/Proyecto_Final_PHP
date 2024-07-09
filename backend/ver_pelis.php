
<?php

include "config.php";  

if (isset($_GET['id_pelicula'])) {
    $id_pelicula = $_GET['id_pelicula'];


    $sql = "SELECT 
    t1.id_pelicula, 
    t1.nombre_pelicula, 
    t1.genero, 
    t1.lanzamiento, 
    t1.duracion, 
    t1.director, 
    t1.sinapsis, 
    t1.nacionalidad, 
    t1.clasificacion, 
    t1.calificacion, 
    t1.orden, 
    t2.nombre_genero, 
    t3.nombre_dir, 
    t4.nombre AS nombre_nacionalidad
FROM 
    peliculas AS t1
JOIN 
    generos AS t2 ON t1.genero = t2.id_genero
JOIN 
    directores AS t3 ON t1.director = t3.id_dir
JOIN 
    nacionalidades AS t4 ON t1.nacionalidad = t4.id_nacio
WHERE 
    t1.id_pelicula = ?
ORDER BY 
    t1.orden";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pelicula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró la película.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/img/logoY.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Biryani:wght@200;300;400;600;700;800;900&family=Carrois+Gothic&family=Noto+Sans+Khojki&display=swap" rel="stylesheet">
        <!-- ESTILOS CSS -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/ver_pelis.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <title>
            <?php
                echo $row['nombre_pelicula'];
                ?></title>
    </head>
</head>

<body>
    <header>
        <div class="logo-container">
            <h1><img id="logo" src="../img/cinemaacicey2.png" width="100 px" alt="logo"></h1>
        </div>
        <nav id="navbar">
            <div class="menu">
                <ul>
                    <li>
                        <button class="boton-2" type="submit"><a href="./sesion_user.php">Elegir otra Pelicula</a></button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="mainDetalle">
        <section class="detalle" style="background-image: linear-gradient(to right top, rgba(109, 105, 105, 0.65), rgba(109, 105, 105, 0.65)), url('muestraimagen.php?id_pelicula=<?php echo $row['id_pelicula']; ?>');">
            <div class="contenedorDetalle">
                <div class="imgDetalle">
                    <img src="muestraimagen.php?id_pelicula=<?php echo $row['id_pelicula']; ?>" alt="<?php echo $row['nombre_pelicula']; ?>">
                </div>
                <div class="textoDetalle">
                    <h1><?php echo $row['nombre_pelicula']; ?> </h1>
                    <p>(<?php echo $row['lanzamiento']; ?>) - <?php echo $row['nombre_genero']; ?></p>
                    <h2>Resumen</h2>
                    <p><?php echo $row['sinapsis']; ?></p>
                    <div class="contenedorBoton">
                        <button class="boton-1" onclick="mostrarMensaje()">Ver Película</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="trailer" data-aos="fade-up" data-aos-offset="400" data-aos-delay="50" data-aos-duration="1000">
            <div class="contenedorTrailer">
                <h2>Trailer</h2>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/7RYpJAUMo2M" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <div class="contenedorInfo">
                <div class="info">
                    <table>
                        <thead>
                            <tr>
                                <th>Informacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Duracion:</strong></td>
                                <td> <?php echo $row['duracion']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Director:</strong></td>
                                <td><?php echo $row['nombre_dir']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Genero:</strong></td>
                                <td> <?php echo $row['nombre_genero']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Calificacion</strong></td>
                                <td><?php echo $row['calificacion']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

    </main>
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
    <script>
        function mostrarMensaje() {
            Swal.fire({
                icon: 'success',
                title: '¡Disfrute la película!',
                text: 'Esperamos que disfrute de esta gran película.',
                confirmButtonText: 'OK'
            });
        }
    </script>
</body>

</html>