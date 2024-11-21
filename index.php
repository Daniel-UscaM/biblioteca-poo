

<?php
require_once('conexion.php');
require_once('../clases4biblioteca/Libro.php');

// Configuración de paginación
$limite = 5; // Número de libros por página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalLibros = mysqli_query($conexion, "SELECT COUNT(*) as total FROM libros");
$totalLibros = mysqli_fetch_assoc($totalLibros)['total'];
$totalPaginas = ceil($totalLibros / $limite);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
    <title>Lista de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* Fondo con imagen */
        body {
            background-image: url('https://images4.alphacoders.com/901/thumb-1920-901683.jpg'); /* Cambia esta ruta por la ubicación de tu imagen */
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
</head>
<body>
    <div class="container mt-4">
        <h1>Libros</h1>
        <a href="crear.php" class="btn btn-primary">Registrar nuevo libro</a>
        <a href="buscar.php" class="btn btn-secondary">Buscar libro</a>
        
        <h2 class="mt-4">Lista de Libros:</h2>

        <!-- Tabla de libros -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Año de Publicación</th>
                    <th>Género</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Llamamos al método de la clase Libro para mostrar los libros
                Libro::mostrarLibros($conexion, $pagina, $limite);
                ?>
            </tbody>
        </table>

        <!-- Paginación con diseño -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($pagina > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="page-item <?php echo $pagina == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina < $totalPaginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
