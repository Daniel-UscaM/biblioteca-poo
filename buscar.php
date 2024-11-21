<?php
require_once('conexion.php');
require_once('../clases4biblioteca/Libro.php');

$busqueda = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST['busqueda'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
        /* Fondo con imagen */
        body {
            background-image: url('https://images.hdqwalls.com/download/illustrator-planet-ai-art-4k-84-1920x1080.jpg'); /* Cambia esta ruta por la ubicación de tu imagen */
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
            color: #32CD32; /* Aseguramos que los títulos se vean bien en el fondo oscuro */
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
    <h1>Búsqueda de Libros</h1>
    <form method="POST">
        <input type="text" name="busqueda" placeholder="Buscar por título o autor" value="<?php echo htmlspecialchars($busqueda); ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <h2>Resultados de la búsqueda:</h2>
    <?php
    if ($busqueda) {
        Libro::buscarLibros($conexion, $busqueda);
    }
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
