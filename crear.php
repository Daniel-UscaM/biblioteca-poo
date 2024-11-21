<?php
require_once('conexion.php');
require_once('../clases4biblioteca/Libro.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $ano_publicacion = $_POST['ano_publicacion'];
    $genero = $_POST['genero'];
    $categoria = $_POST['categoria'];

    // Validación básica
    if (empty($titulo) || empty($autor) || empty($editorial) || empty($ano_publicacion) || empty($genero) || empty($categoria)) {
        echo "Todos los campos son obligatorios.";
    } else {
        $libro = new Libro($conexion, $titulo, $autor, $editorial, $ano_publicacion, $genero, $categoria);
        $libro->registrarLibro();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Libro</title>
    <script>
        function validarFormulario() {
            const fields = ['titulo', 'autor', 'editorial', 'ano_publicacion', 'genero', 'categoria'];
            for (const field of fields) {
                if (document.forms[0][field].value === "") {
                    alert("Todos los campos son obligatorios.");
                    return false;
                }
            }
            return true;
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
        /* Fondo con imagen */
        body {
            background-image: url('https://www.starfieldguide.com/wp-content/uploads/2021/08/5-kHLvRSe-2048x1152.jpg'); /* Cambia esta ruta por la ubicación de tu imagen */
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            height: 100vh;
            color: white; /* Cambié el color del texto para que se vea mejor con el fondo */
        }

        /* Estilo para los contenedores */
        .container {
            background: rgba(0, 0, 0, 0.5); /* Fondo oscuro semitransparente */
            padding: 30px;
            border-radius: 10px;
        }

        h1, h2 {
            color: #fff; /* Aseguramos que los títulos se vean bien en el fondo oscuro */
        }

        .table th, .table td {
            color: #007bff; /* Color de texto blanco en la tabla */
        }

        .pagination .page-item .page-link {
            color: #007bff; /* Color blanco para los enlaces de paginación */
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff; /* Color azul para el enlace activo */
        }
    </style>
<body>
    <h1>Registrar Libro</h1>
    <form method="POST" onsubmit="return validarFormulario()">
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="text" name="editorial" placeholder="Editorial" required>
        <input type="number" name="ano_publicacion" placeholder="Año de publicación" required>
        <input type="text" name="genero" placeholder="Género" required>
        <input type="text" name="categoria" placeholder="Categoría" required>
        <button type="submit">Registrar</button>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
