<?php

use Alice\Animeland\Database\Database;
use Alice\Animeland\Model\AnimeModel;

// Users table
$smt = Database::getConn();

//Drop all tables
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
  mal_id INTEGER PRIMARY KEY,
  url VARCHAR(100), 
  title VARCHAR(100) NOT NULL,
  title_japanese VARCHAR(200),
  synopsis TEXT,
  episodes INTEGER,
  duration VARCHAR(100),
  airing BOOLEAN,
  year INTEGER,
  rating VARCHAR(50),
  score NUMERIC,
  season VARCHAR(50),
  status VARCHAR(50),
  studios JSONB,
  images JSONB,
  type VARCHAR(20),
  cover_url VARCHAR(200),
  trailer_url VARCHAR(200),
  genres JSONB
)";

$smt->exec($sql);

// Epsisode Table
$sql = "CREATE TABLE IF NOT EXISTS episode (
  id SERIAL PRIMARY KEY,
  episode_number INTEGER NOT NULL,
  duration SMALLINT,
  title VARCHAR(150),
  synopsis TEXT,
  aired DATE,
  anime_id INTEGER NOT NULL,
  url JSONB,
  FOREIGN KEY (anime_id) REFERENCES anime(mal_id)
)";

$smt->exec($sql);
