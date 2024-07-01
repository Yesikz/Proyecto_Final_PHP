const header=document.querySelector("header");
const footer=document.querySelector("footer");

header.innerHTML = `
<div class="logo-container">
            <h1><img id="logo" src="./img/cinemaacicey2.png" width="100 px" alt="logo"></h1>
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
                    <!-- <li><a href="index.html">Inicio</a></li>-->
                    <li class><a href="./pages/tendencias.html">(API)</a></li>
                    <!--<li><a href="registro.html">Registrarse</a></li>-->
                    <li class="peli-adm"><a href="../backend/index.php">Administrar</a></li>
                    <li class="menu-1"><a href="./pages/inicio_sesion_user.html">Inicia Sesión</a></li>
                </ul>
            </div>
        </nav>

`;



footer.innerHTML= `
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
            <a href="https://www.facebook.com/" target="_blank"><img src="./img/facebook.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/" target="_blank"><img src="./img/instagram.png" alt="Instagram"></a>
            <a href="https://twitter.com/" target="_blank"><img src="./img/twitter.png" alt="Twitter"></a>
        </div>

`;


