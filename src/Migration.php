<?php

use Alice\Animeland\Database\Database;

$connection = new Database();
$connection->connect();

$smt = $connection->getConn();
$sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

// Executar a consulta para criar a tabela
$smt->exec($sql);

//echo "Tables was created.\n";
