<?php
require_once('conexion.php');
require_once('../clases4biblioteca/Libro.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar el libro actual
    $sql = "SELECT * FROM libros WHERE id = $id";
    $resultado = mysqli_query($conexion, $sql);
    $libroData = mysqli_fetch_assoc($resultado);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $ano_publicacion = $_POST['ano_publicacion'];
    $genero = $_POST['genero'];
    $categoria = $_POST['categoria'];

    // Crear instancia y actualizar libro
    $libro = new Libro($conexion, $titulo, $autor, $editorial, $ano_publicacion, $genero, $categoria);
    $libro->actualizarLibro($id);

    header("Location: index.php"); // Redirige al índice después de editar
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
        /* Fondo con imagen */
        body {
            background-image: url('https://www.pixground.com/wp-content/uploads/2023/02/Mountain-Lake-Reflection-in-Nature-Scenery-4K-Wallpaper.jpg'); /* Cambia esta ruta por la ubicación de tu imagen */
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
    <h1>Editar Libro</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $libroData['id']; ?>">
        <input type="text" name="titulo" placeholder="Título" value="<?php echo $libroData['titulo']; ?>" required>
        <input type="text" name="autor" placeholder="Autor" value="<?php echo $libroData['autor']; ?>" required>
        <input type="text" name="editorial" placeholder="Editorial" value="<?php echo $libroData['editorial']; ?>" required>
        <input type="number" name="ano_publicacion" placeholder="Año de publicación" value="<?php echo $libroData['ano_publicacion']; ?>" required>
        <input type="text" name="genero" placeholder="Género" value="<?php echo $libroData['genero']; ?>" required>
        <input type="text" name="categoria" placeholder="Categoría" value="<?php echo $libroData['categoria']; ?>" required>
        <button type="submit">Actualizar</button>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
