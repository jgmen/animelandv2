<?php

use Alice\Animeland\Database\Database;

$connection = new Database();
$connection->connect();


// Users table
$smt = $connection->getConn();

// Drop all tables
// $sql = "DO $$ DECLARE
//     r RECORD;
// BEGIN
//     PERFORM 'SET session_replication_role = replica';

//     FOR r IN (SELECT tablename FROM pg_tables WHERE schemaname = 'public') LOOP
//         EXECUTE 'DROP TABLE IF EXISTS ' || quote_ident(r.tablename) || ' CASCADE';
//     END LOOP;

//     PERFORM 'SET session_replication_role = DEFAULT';
// END $$;";

// $smt->query($sql);


$sql = "CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
$smt->exec($sql);

// Anime Table
$sql = "CREATE TABLE IF NOT EXISTS anime (
  id SERIAL PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  release_date DATE,
  studio VARCHAR(50),
  age_rating INTEGER CHECK (age_rating BETWEEN 0 AND 18),
  status VARCHAR(20),
  cover_url VARCHAR(200),
  trailer_url VARCHAR(200)
)";

$smt->exec($sql);

// Season Table
$sql = "CREATE TABLE IF NOT EXISTS season (
  id SERIAL PRIMARY KEY,
  season_number INTEGER NOT NULL,
  title VARCHAR(100),
  description TEXT,
  release_date DATE,
  id_anime INTEGER NOT NULL,
  FOREIGN KEY (id_anime) REFERENCES anime(id)
)";

$smt->exec($sql);

// Epsisode Table
$sql = "CREATE TABLE IF NOT EXISTS episode (
  id SERIAL PRIMARY KEY,
  episode_number INTEGER NOT NULL,
  title VARCHAR(100),
  description TEXT,
  release_date DATE,
  id_season INTEGER NOT NULL,
  FOREIGN KEY (id_season) REFERENCES season(id)
)";

$smt->exec($sql);

