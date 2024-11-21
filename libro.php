<?php

require_once('conexion.php');

class Libro {
    public $titulo, $autor, $editorial, $ano_publicacion, $genero, $categoria;
    public $conexion;

    public function __construct($conexion, $titulo = null, $autor = null, $editorial = null, $ano_publicacion = null, $genero = null, $categoria = null) {
        $this->conexion = $conexion;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->ano_publicacion = $ano_publicacion;
        $this->genero = $genero;
        $this->categoria = $categoria;
    }

    public function registrarLibro() {
        $sql = "INSERT INTO libros (titulo, autor, editorial, ano_publicacion, genero, categoria) VALUES ('$this->titulo', '$this->autor', '$this->editorial', $this->ano_publicacion, '$this->genero', '$this->categoria')";
        if (mysqli_query($this->conexion, $sql)) {
            echo "Libro registrado correctamente";
        } else {
            echo "Error al registrar el libros: " . mysqli_error($this->conexion);
        }
    }

    public static function mostrarLibros($conexion, $pagina, $limite) {
        $inicio = ($pagina - 1) * $limite;
        $sql = "SELECT * FROM libros LIMIT $inicio, $limite";
        $resultado = mysqli_query($conexion, $sql);
    
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila["id"] . "</td>";
                echo "<td>" . $fila["titulo"] . "</td>";
                echo "<td>" . $fila["autor"] . "</td>";
                echo "<td>" . $fila["editorial"] . "</td>";
                echo "<td>" . $fila["ano_publicacion"] . "</td>";
                echo "<td>" . $fila["genero"] . "</td>";
                echo "<td>" . $fila["categoria"] . "</td>";
                echo "<td>
                        <a href='editar.php?id=" . $fila['id'] . "' class='btn btn-warning btn-sm'>Editar</a> | 
                        <a href='eliminar.php?id=" . $fila['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('¿Estás seguro de eliminar este libro?')\">Eliminar</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            // Si no se encuentran libros, mostrar un mensaje en la tabla
            echo "<tr><td colspan='8' class='text-center'>No se encontraron libros.</td></tr>";
        }
    }
    

    public function actualizarLibro($id) {
        $sql = "UPDATE libros SET titulo='$this->titulo', autor='$this->autor', editorial='$this->editorial', ano_publicacion=$this->ano_publicacion, genero='$this->genero', categoria='$this->categoria' WHERE id=$id";
        if (mysqli_query($this->conexion, $sql)) {
            echo "Libro actualizado correctamente";
        } else {
            echo "Error al actualizar el libros: " . mysqli_error($this->conexion);
        }
    }

    public function eliminarLibro($id) {
        $sql = "DELETE FROM libros WHERE id=$id";
        if (mysqli_query($this->conexion, $sql)) {
            echo "Libro eliminado correctamente";
        } else {
            echo "Error al eliminar el libros: " . mysqli_error($this->conexion);
        }
    }

    public static function buscarLibros($conexion, $busqueda) {
        $sql = "SELECT * FROM libros WHERE titulo LIKE '%$busqueda%' OR autor LIKE '%$busqueda%'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "ID: " . $fila["id"] . " - Título: " . $fila["titulo"] . " - Autor: " . $fila["autor"] . " - Editorial: " . $fila["editorial"] . " - Año: " . $fila["ano_publicacion"] . " - Género: " . $fila["genero"] . " - Categoría: " . $fila["categoria"] . "<br>";
            }
        } else {
            echo "0 resultados";
        }
    }
}
?>
