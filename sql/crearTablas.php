<?php

$servername = "localhost:8080";
$username = "root";
$password = "";
$dbname = "horizonte_azul";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table viaje
$sql = "CREATE TABLE viaje (
    id_viaje INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    destacado BOOLEAN NOT NULL DEFAULT FALSE,
    tipo_viaje VARCHAR(100),
    plazas INT NOT NULL,
    imagen VARCHAR(255)
);
";

if ($conn->query($sql) === TRUE) {
    echo "Table viaje created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// sql to create table usuario
$sql2 = "CREATE TABLE usuario (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
);
";

if ($conn->query($sql2) === TRUE) {
    echo "Table usuario created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>