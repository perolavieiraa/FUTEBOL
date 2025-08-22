<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "futebol_db";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}
?>