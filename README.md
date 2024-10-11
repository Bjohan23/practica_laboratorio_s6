# Proyecto de Gestión de Riesgos

Este proyecto es una aplicación PHP para gestionar riesgos. Incluye una clase `Riesgo` que permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) en una base de datos MySQL.

## Requisitos

- PHP 8.2 o superior
- MySQL
- Composer

## Configuración del entorno

1. Clona el repositorio:

    ```sh
    git clone https://github.com/Bjohan23/practica_laboratorio_s6
    cd practica_laboratorio_s6
    ```

2. Instala las dependencias de Composer:

    ```sh
    composer install
    ```

3. Crea la base de datos y la tabla en MySQL:

    ```sql
    CREATE DATABASE riesgo;
    USE riesgo;

    CREATE TABLE riesgo (
        id INT AUTO_INCREMENT PRIMARY KEY,
        propietario VARCHAR(255) NOT NULL,
        valor_impacto INT NOT NULL,
        valor_probabilidad INT NOT NULL,
        valor_riesgo INT NOT NULL,
        id_unidad_organizacional INT NOT NULL
    );
    ```

4. Configura las credenciales de la base de datos en el archivo `test/RiesgoTest.php`:

    ```php
    protected function setUp(): void
    {
        $this->conn = new \mysqli("localhost", "root", "tu_contraseña", "riesgo");

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    ```

## Ejecutar las pruebas

Para ejecutar las pruebas, usa el siguiente comando:

```sh
composer test