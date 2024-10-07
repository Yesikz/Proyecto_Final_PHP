<p align="center">
  <img src="./img/cinemaacicey2.png" alt="Logo Acisey" width="300" height="200"/>
</p>
</p>

<div align="center">

![Estado del Proyecto](https://img.shields.io/badge/Estado-En%20proceso%20de%20modificaciones-yellow)
![PRs Welcome](https://img.shields.io/badge/PRs-welcome-green)
<br>

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-FEBE38?style=flat-square&logo=xampp&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)


</div>

# ACISEY

Proyecto desarrollado como parte del curso Full Stack PHP de la [Agencia de Habilidades para el Futuro](https://buenosaires.gob.ar/educacion/agencia-de-habilidades-para-el-futuro).

Acisey es una plataforma web que te permite disfrutar de películas y series de manera ilimitada, todo en un solo lugar. Para acceder al contenido, es necesario iniciar sesión como usuario registrado.

## Tabla de Contenidos

- [Descripción](#descripción)
- [Tecnologías](#tecnologías)
- [Instalación](#instalación)
- [Configuración de la Base de Datos](#configuración-de-la-base-de-datos)
- [Uso](#uso)
- [Contribución](#contribución)
- [Agradecimientos](#agradecimientos) 
- [Autores](#autores)

## Descripción
Esta plataforma ofrece las siguientes funcionalidades a los usuarios:

- **Administradores**: Administrar peliculas, generos, directores y nacionalidades.
- **Usuarios**: Iniciar sesión y gestionar sus peliculas.

#### Características
- **Administradores**: Control total sobre las peliculas, los generos, los directores y las nacionalidades dentro de la plataforma.
- **Usuarios**: Acceso a sus respectivas cuentas para gestionar información personal y peliculas.

## Tecnologías
- **Backend:**
  - PHP 
  - MySQL (base de datos)

- **Frontend:**
  - HTML
  - CSS 
  - JavaScript

- **Otros:**
  - XAMPP
  - API [The Movie DB](https://www.themoviedb.org/)

## Instalación
1. **Clona el repositorio**:
    ```bash
    git clone https://github.com/Yesikz/Proyecto_Final_PHP.git
    cd Proyecto_Final_PHP
    ```
2. **Configura XAMPP**:
   - Asegúrate de tener XAMPP instalado en tu computadora.
   - Inicia el panel de control de XAMPP y activa los módulos de Apache y MySQL.
3. **Configura la base de datos**:
   - Accede a phpMyAdmin a través de `http://localhost/phpmyadmin`.
   - Crea una nueva base de datos llamada `acisey`.
4. **Configura el archivo de conexión**:
   - Abre el archivo de configuración de la base de datos en `config/db.php` (o donde se encuentre) y ajusta las credenciales según tu configuración local.
5. **Accede a la aplicación**:
   - Abre tu navegador y dirígete a `http://localhost/Proyecto_Final_PHP` para comenzar a usar Acisey.

## Configuración de la Base de Datos
La conexión a la base de datos está definida en el archivo `config.php` con los siguientes parámetros:

```php
$servername = "localhost"; // Cambia esto si es necesario
$username = "tu_usuario"; // Cambia por tu nombre de usuario
$password = "tu_contraseña"; // Cambia por tu contraseña
$dbname = "tu_base_de_datos"; // Cambia por el nombre de tu base de datos
```
### Creación de Tablas
A continuación se presentan los scripts SQL necesarios para crear las tablas de la base de datos.

#### Tabla: Administradores
```SQL
CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```
Nota: Las contraseñas se almacenan de forma encriptada. Para encriptar una contraseña existente, utiliza un generador de contraseñas seguras, como [bcrypt](https://bcrypt-generator.com/).

#### Tabla: Películas
```SQL
CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `nombre_pelicula` varchar(30) NOT NULL, 
  `genero` int(11) NOT NULL,
  `lanzamiento` int(4) NOT NULL,
  `duracion` int(3) NOT NULL,
  `director` int(1) NOT NULL,
  `sinapsis` longtext NOT NULL,
  `nacionalidad` int(1) NOT NULL,
  `clasificacion` varchar(20) NOT NULL,
  `calificacion` varchar(4) NOT NULL,
  `orden` int(1) NOT NULL,
  `estado` int(1) NOT NULL,
  `poster` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

```

#### Tabla: Géneros
```SQL
CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(30) NOT NULL,
  `orden` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT;

```

#### Tabla: Directores
```SQL
CREATE TABLE `directores` (
  `id_dir` int(11) NOT NULL,
  `nombre_dir` varchar(40) NOT NULL,
  `nacionalidad` varchar(2) NOT NULL,
  `estado` int(11) NOT NULL,
  `orden` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `directores`
  ADD PRIMARY KEY (`id_dir`);
  MODIFY `id_dir` int(11) NOT NULL AUTO_INCREMENT;

```

#### Tabla: Nacionalidades
```SQL
CREATE TABLE `nacionalidades` (
  `id_nacio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `pais` varchar(40) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `nacionalidades`
  ADD PRIMARY KEY (`id_nacio`);
  MODIFY `id_nacio` int(11) NOT NULL AUTO_INCREMENT;
```

Para insertar datos iniciales en la tabla de nacionalidades, puedes usar el siguiente script:

```SQL
INSERT INTO `nacionalidades` (`id_nacio`, `nombre`, `pais`, `estado`) VALUES
(1, 'Argentina', 'Argentina', 1),
(2, 'Mexico', 'Mexico', 1),
(3, 'Italia', 'Italia', 1),
(4, 'España', 'España', 1),
(5, 'Francia', 'Francia', 1),
(6, 'Bolivia', 'Bolivia', 1),
(7, 'Chile', 'Chile', 1),
(8, 'Canada', 'Canada', 1),
(9, 'Colombia', 'Colombia', 1),
(10, 'Estados Unidos', 'Estados Unidos', 1);
```

#### Tabla: Usuarios
```SQL
CREATE TABLE `usuarios` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    pais VARCHAR(100) NOT NULL
);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```

#### Tabla: Compras
```SQL
CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `cliente` int(3) NOT NULL,
  `pelicula` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

// Establecer la zona horaria de Argentina
date_default_timezone_set('America/Argentina/Buenos_Aires');
```

## Uso
1. **Registro de Usuario**: 
   - Si eres un nuevo usuario, dirígete a la página de registro y completa el formulario para crear una cuenta.

2. **Iniciar Sesión**:
   - Después de registrarte, inicia sesión con tus credenciales para acceder al contenido.

3. **Explorar Contenido**:
   - Navega por la plataforma para ver películas y series disponibles.

4. **Gestión de Contenido** (solo para administradores):
   - Accede al panel de administración para agregar o modificar películas, géneros, directores y nacionalidades.

## Contribución

¡Las contribuciones son bienvenidas! Si deseas contribuir a este proyecto:

1. **Realiza un fork** del repositorio.
2. **Crea una rama** para tu característica (`git checkout -b feature/nueva-caracteristica`).
3. **Realiza los cambios** y haz commit (`git commit -m "Añadir nueva caracteristica"`).
4. **Envía un pull request** describiendo los cambios realizados y su propósito.

## Agradecimientos

- [Agencia de Habilidades para el Futuro](https://buenosaires.gob.ar/educacion/agencia-de-habilidades-para-el-futuro) por el curso de Full Stack PHP.
- [The Movie DB](https://www.themoviedb.org/) por proporcionar una API excelente para acceder a información sobre películas y series.


## Autores
Proyecto creado por:

<div style="display: flex; align-items: center;">
    <img src="https://github.com/Yesikz.png?size=50" alt="Yesica Morleo" style="border-radius: 50%; margin-right: 10px;">
    <p> <strong>Yesica Morleo</strong> </p>
</div>

[![GitHub](https://img.shields.io/badge/GitHub-Yesikz-blue)](https://github.com/Yesikz)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Yesica_Morleo-blue)](https://www.linkedin.com/in/yesica-morleo-533940256/)



<div style="display: flex; align-items: center;">
    <img src="https://github.com/Fica-Millan.png?size=50" alt="Yesica Fica Millán" style="border-radius: 50%; margin-right: 10px;">
    <p><strong>Yesica Fica Millán</strong> </p>
</div>

[![GitHub](https://img.shields.io/badge/GitHub-Fica_Millan-blue)](https://github.com/Fica-Millan)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Yesica_Fica_Millan-blue)](https://www.linkedin.com/in/yesica-fica-millan/)

<div style="display: flex; align-items: center;">
    <img src="https://github.com/AlejoColazurda.png?size=50" alt="Alejo Colazurda" style="border-radius: 50%; margin-right: 10px;">
    <p><strong>Alejo Colazurda</strong></p>
</div>

[![GitHub](https://img.shields.io/badge/GitHub-AlejoColazurda-blue)](https://github.com/AlejoColazurda)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Alejo_Colazurda-blue)](https://www.linkedin.com/in/alejo-colazurda/)

<div style="display: flex; align-items: center;">
    <img src="https://github.com/br1an17.png?size=50" alt="Brian Paez" style="border-radius: 50%; margin-right: 10px; width: 50px; height: 50px;">
    <p> <strong>Alejandro Perez</strong></p>
</div>

[![GitHub](https://img.shields.io/badge/GitHub-br1an17-blue)](https://github.com/br1an17)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Brian_Paez-blue)](https://www.linkedin.com/in/brian-paez/)

<div style="display: flex; align-items: center;">
    <img src="https://github.com/adrianstravitz.png?size=50" alt="Adrian Stravitz" style="border-radius: 50%; margin-right: 10px; width: 50px; height: 50px;">
    <p> <strong>Adriano_Stravitz</strong></p>
</div>

[![GitHub](https://img.shields.io/badge/GitHub-adrianstravitz-blue)](https://github.com/adrianstravitz)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Adriano_Stravitz-blue)](https://www.linkedin.com/in/adriano-stravitz-4886585/)