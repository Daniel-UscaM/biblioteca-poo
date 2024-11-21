<?php
require_once('conexion.php');
require_once('../clases4biblioteca/Libro.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia y eliminar libro
    $libro = new Libro($conexion);
    $libro->eliminarLibro($id);

    header("Location: index.php"); // Redirige al índice después de eliminar
}
?>