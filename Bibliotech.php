<?php

// Clase Libro
class Libro {
    private $id;
    private $titulo;
    private $autor;
    private $categoria;
    private $estado; // Disponible o Prestado

    public function __construct($id, $titulo, $autor, $categoria, $estado = 'disponible') {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }

    public function mostrarDetalles() {
        return [
            'ID' => $this->id,
            'Título' => $this->titulo,
            'Autor' => $this->autor,
            'Categoría' => $this->categoria,
            'Estado' => $this->estado
        ];
    }

    public function cambiarEstado($nuevoEstado) {
        $this->estado = $nuevoEstado;
    }
}

// Clase Autor
class Autor {
    private $nombre;
    private $biografia;

    public function __construct($nombre, $biografia = "") {
        $this->nombre = $nombre;
        $this->biografia = $biografia;
    }

    public function mostrarAutor() {
        return [
            'Nombre' => $this->nombre,
            'Biografía' => $this->biografia
        ];
    }
}

// Clase Categoria
class Categoria {
    private $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function mostrarCategoria() {
        return $this->nombre;
    }
}

// Clase Biblioteca
class Biblioteca {
    private $libros = [];
    private $autores = [];
    private $categorias = [];

    public function agregarLibro(Libro $libro) {
        $this->libros[$libro->mostrarDetalles()['ID']] = $libro;
    }

    public function buscarLibroPorTitulo($titulo) {
        foreach ($this->libros as $libro) {
            if (stripos($libro->mostrarDetalles()['Título'], $titulo) !== false) {
                return $libro->mostrarDetalles();
            }
        }
        return "No se encontró el libro.";
    }

    public function prestarLibro($id) {
        if (isset($this->libros[$id])) {
            $libro = $this->libros[$id];
            if ($libro->mostrarDetalles()['Estado'] === 'disponible') {
                $libro->cambiarEstado('prestado');
                return "Libro prestado exitosamente.";
            }
            return "El libro ya está prestado.";
        }
        return "El libro no existe.";
    }
}

// Ejemplo de uso
$biblioteca = new Biblioteca();

// Crear objetos
$autor1 = new Autor("Gabriel García Márquez", "Escritor colombiano, autor de 'Cien años de soledad'.");
$categoria1 = new Categoria("Novela");
$libro1 = new Libro(1, "Cien años de soledad", $autor1->mostrarAutor()['Nombre'], $categoria1->mostrarCategoria());

// Agregar libro a la biblioteca
$biblioteca->agregarLibro($libro1);

// Buscar libro
echo "Buscar libro:\n";
print_r($biblioteca->buscarLibroPorTitulo("Cien años"));

// Prestar libro
echo "Prestar libro:\n";
echo $biblioteca->prestarLibro(1);

?>
