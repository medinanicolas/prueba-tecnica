/**
* Plantilla de navegación con boostrap
*/
<nav class="navbar navbar-dark bg-dark navbar-expand-lg py-4 ">
        <a class="navbar-brand" href="{% url 'onboardwebsite:index' %}">Gestión de Bodegas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">PRODUCTOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{% url 'onboardwebsite:contacto' %}">BODEGAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{% url 'onboardwebsite:contacto' %}">USUARIOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{% url 'onboardwebsite:contacto' %}">ENTREGAS</a>
                </li>
                <li class="nav">
                    <a class="nav-link" href="../login/logout.php">CERRAR SESION</a>
                </li>'
            </ul>
        </div>
    </nav>