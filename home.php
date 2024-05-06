<?php
// Inicia la sesión
session_start();


if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
// Destruye todas las variables de sesión
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('img/imagenhome.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 20px;
            color: #0d6efd; /* Color azul fluorescente */
        }

        /* Ajuste de estilo para centrar texto */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            height: 40vh;
        }

        .centered-image {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
            margin-bottom: 20px;
        }

        .centered-image img {
            max-width: 100%;
            max-height: 100%;
        }

        .d-flex {
            margin-top: 20px;
        }

        .d-flex a {
            margin-right: 2px;
        }

        .table-responsive {
            margin-left: -950px;
            margin-right:  0px;
            width: 600%;
            overflow-x: none; /* Agrega barras de desplazamiento horizontal si es necesario */
            margin-bottom:-70px;
            margin-top: 150px;
        } 

        .table td.transparent {
            background-color: rgba(255, 255, 255, 0); /* Fondo transparente */
            border: none; /* Sin bordes */
        } 

        .table td {
            background-color: rgba(255, 255, 255, 0); /* Fondo transparente */
            border: none; /* Sin bordes */  
            color:inherit; 
        }

        .table {
            width: 100%;
            white-space: normal;
            border-spacing: 40px; /* Ajusta este valor según necesites */
            font-size: 1.5em; /* Ajusta el tamaño de la fuente */
        }

        .label-column, .value-column {
            padding-top: 80px; /* Ajusta la altura de las filas */
            padding-bottom: 40px; /* Ajusta la altura de las filas */
        }

        td {
            text-align: center; /* Alinea el contenido horizontalmente */
            vertical-align: middle; /* Alinea el contenido verticalmente */
        }
         /* Estilo para hacer la barra de tareas transparente */
         .table th {
            background-color: rgba(255, 255, 255, 0); /* Fondo transparente */
            border: none; /* Sin bordes */
            color: inherit;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenido, <?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : "Usuario"; ?></h1>
        <br>
        <?php 
         $cod = null;
         $nom = null;
         $prc= null;
         $can = null;
         if(isset($_GET["cod"])){
            $cod = $_GET["cod"];
            $nom = $_GET["nom"] ;
            $prc= $_GET["prc"] ;
            $can = $_GET["can"];
         }
        ?>
        <div class="row">
            <div class="col">
                <?php
                include_once "./conexion.php";
                $sql = "SELECT * FROM producto";
                $res = $conn->query($sql);
                ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Tareas</th>
                        </tr>
                        <?php
                        while ($row = $res->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $row['codigo'] . '</td>';
                            echo '<td>' . $row['nombre'] . '</td>';
                            echo '<td>' . $row['precio'] . '</td>';
                            echo '<td>' . $row['cantidad'] . '</td>';
                            echo '<td><a href="home.php?cod=' . $row['codigo'] . '&nom=' . $row['nombre'] . '&can=' . $row['cantidad'] . '&prc=' . $row['precio'] . '">Actualizar</a> -- <a href="eliminar_producto.php?codigo=' . $row['codigo'] . '">Borrar</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Bienvenido, <?php echo isset($_SESSION["user"]) ? $_SESSION["user"] : "Usuario"; ?></h1>
        <p>Tu correo electrónico registrado es: <?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : "Correo electrónico"; ?></p>

        <div class="centered-image">
            <img src="img/juliofloresdeoz.jpg" alt="Imagen centrada">
        </div>

        <div class="d-flex justify-content-center">
            <button id="cerrarSesion" class="btn btn-danger me-3">Cerrar sesión</button>
            <div id="confirmacionCerrarSesion" style="display: none;">
                ¿Estás seguro?
                <button id="confirmarCerrarSesion" class="btn btn-danger">Confirmar</button>
                <button id="cancelarCerrarSesion" class="btn btn-primary">Cancelar</button>
            </div>
            <a href="comprar.php" class="btn btn-primary">Comprar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/react/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom/umd/react-dom.production.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>

    <script type="text/babel">
        const confirmarCerrarSesion = () => {
            const confirmacion = window.confirm("¿Estás seguro?");
            if (confirmacion) {
                // Aquí puedes redirigir a tu script de cerrar sesión
                window.location.href = "index.php";
            }
        }

        document.getElementById("cerrarSesion").addEventListener("click", () => {
            document.getElementById("confirmacionCerrarSesion").style.display = "block";
        });

        document.getElementById("confirmarCerrarSesion").addEventListener("click", confirmarCerrarSesion);
        document.getElementById("cancelarCerrarSesion").addEventListener("click", () => {
            document.getElementById("confirmacionCerrarSesion").style.display = "none";
        });
    </script>
</body>

</html>
