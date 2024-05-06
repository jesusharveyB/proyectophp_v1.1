<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar?</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Estilos CSS integrados aquí */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('img/imagencomprar.jpg');
            background-size: cover;
        }

        .box {
            position: relative;
            width: 200px;
            height: 300px;
            transform-style: preserve-3d;
            animation: animate 20s linear infinite;
        }

        @keyframes animate {
            10% {
                transform: perspective(1500px) rotateY(0deg);
            }
            100% {
                transform: perspective(1500px) rotateY(360deg);
            }
        }

        .box span {
            position: absolute;
            top: 40%;
            left: 50%;
            width: 150px; /* Ancho de la imagen */
            height: 255px; /* Alto de la imagen */
            margin-top: -75px; /* Mitad del alto de la imagen */
            margin-left: -65px; /* Mitad del ancho de la imagen */
            transform-origin: center;
            transform: rotateY(calc(var(--i) * 45deg)) translateZ(200px); /* Ajusta el valor de translateZ y el ángulo de rotación */
            -webkit-box-reflect: below 0px linear-gradient(transparent, transparent, #0004);
        }

        .box span img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0; /* Para que la imagen sea circular */
        }

        .box span button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background-color: #007bff; /* Color azul */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos de la lista */
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            background-color: #02372e;
        }

        ul {
            position: absolute;
            top: 10%; /* Ajusta la posición vertical de la lista */
            left: 50%;
            transform: translate( -50%, -50% );
            display: flex;
        }

        ul li {
            list-style: none;
        }

        ul li a {
            position: relative;
            display: block;
            text-transform: uppercase;
            margin: 10px 0;
            padding: 10px 30px;
            text-decoration: none;
            color: #fde907;
            font-family: sans-serif;
            font-size: 18px;
            font-weight: 600;
            transition: 0.5s;
            z-index: 1;
        }

        ul li a:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100;
            border-top: 2px solid #fde907;
            border-bottom: 0px solid #fde907;
            transform: scaleY(2); /* Corregi error de typo en 'escaleY' a 'scaleY' */
            opacity: 0;
            transition: 0.3s;
        }

        ul li a:after {
            content: "";
            position: absolute;
            top: 2px;
            left: 0;
            width: -100%;
            height: -100px;
            background-color: #fde907;
            transform: scale(100);
            opacity: 0;
            transition: 0.3s;
            z-index: -1;
        }

        ul li a:hover {
            color: #012822;
        }

        ul li a:hover::before {
            transform: scaleY(1);
            opacity: 1;
        }

        ul li a:hover::after {
            transform: scaleY(1);
            opacity: 1;
        }
        form {
    position: absolute;
    left: 60px; /* Ajusta la distancia desde el borde izquierdo */
    top: 50%; /* Centra verticalmente el formulario */
    transform: translateY(-50%);
}form label {
    color: #fde907; /* Color amarillo */
}



    </style>
</head>

<body>

    <ul>
        <li><a href="#">Ingresar</a></li>
        <li><a href="#">Borrar</a></li>
        <li><a href="#">Administrador</a></li>
        <li><a href="#">vendedor</a></li>
        <li><a href="#">actualizar</a></li>
    </ul>

    <?php
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="alert alert-success" role="alert">Producto agregado correctamente.</div>';
    }
    ?>

    <form id="formProducto" action="agregar_producto.php" method="POST" onsubmit="event.preventDefault(); submitForm();">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" required>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="number" class="form-control" id="precio" name="precio" required>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
        
    </form>

    <div class="box">
        <span style="--i:1;">
            <img src="img/imagen1.jpg" alt="">
            <button id="button1">Bueno</button>
        </span>
        <span style="--i:2;">
            <img src="img/imagen2.jpg" alt="">
            <button id="button2">Bonito</button>
        </span>
        <span style="--i:3;">
            <img src="img/imagen3.jpg" alt="">
            <button id="button3">Barato</button>
        </span>
        <span style="--i:4;">
            <img src="img/imagen4.jpg" alt="">
            <button id="button4">Llevame</button>
        </span>
        <span style="--i:5;">
            <img src="img/imagen5.jpg" alt="">
            <button id="button5">Bueno</button>
        </span>
        <span style="--i:6;">
            <img src="img/imagen6.jpg" alt="">
            <button id="button6">Bonito</button>
        </span>
        <span style="--i:7;">
            <img src="img/imagen7.jpg" alt="">
            <button id="button7">Barato</button>
        </span>
        <span style="--i:8;">
            <img src="img/imagen8.jpg" alt="">
            <button id="button8">Llevame</button>
        </span>
    </div>

    <script>
        // Manejadores de eventos para los botones
        document.getElementById('button1').addEventListener('click', function() {
            alert('No hay nada agonia 1');
        });
        document.getElementById('button2').addEventListener('click', function() {
            alert('Se agoto mi pitbull 2');
        });
        document.getElementById('button3').addEventListener('click', function() {
            alert('Acabe de vender el ultimo 3');
        });
        document.getElementById('button4').addEventListener('click', function() {
            alert('Ese lo tengo para mi 4');
        });
        document.getElementById('button5').addEventListener('click', function() {
            alert('Como es el ultimo vale mas 5');
        });
        document.getElementById('button6').addEventListener('click', function() {
            alert('Pailas ya no hay 6');
        });
        document.getElementById('button7').addEventListener('click', function() {
            alert('Ya no hay papi 7');
        });
        document.getElementById('button8').addEventListener('click', function() {
            alert('No se vende 8');
        });

        function submitForm() {
            let form = document.getElementById('formProducto');
            let formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = window.location.pathname + '?status=success';
                    form.reset();
                } else {
                    alert('Hubo un error al agregar el producto.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al agregar el producto.');
            });
        }
    </script>
</body>

</html>
