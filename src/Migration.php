<?php

use Alice\Animeland\Database\Database;

$connection = new Database();
$connection->connect();


// Users table
$smt = $connection->getConn();

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

// Anime Table inserts

// $sql = "INSERT INTO anime (title, description, release_date, studio, age_rating, status, cover_url, trailer_url) VALUES
// ('Naruto', 'A young ninja strives to be the best in his village.', '2002-10-03', 'Studio Pierrot', 12, 'Completed', 'https://example.com/naruto-cover.jpg', 'https://example.com/naruto-trailer.mp4'),
// ('Attack on Titan', 'Humans fight for survival against giant humanoid Titans.', '2013-04-06', 'Wit Studio', 16, 'Ongoing', 'https://example.com/aot-cover.jpg', 'https://example.com/aot-trailer.mp4'),
// ('My Hero Academia', 'A boy born without superpowers in a world where they are common.', '2016-04-03', 'Bones', 13, 'Ongoing', 'https://example.com/mha-cover.jpg', 'https://example.com/mha-trailer.mp4'),
// ('One Piece', 'A pirate''s journey to find the greatest treasure.', '1999-10-20', 'Toei Animation', 12, 'Ongoing', 'https://example.com/onepiece-cover.jpg', 'https://example.com/onepiece-trailer.mp4'),
// ('Death Note', 'A high school student discovers a notebook that kills anyone whose name is written in it.', '2006-10-04', 'Madhouse', 16, 'Completed', 'https://example.com/deathnote-cover.jpg', 'https://example.com/deathnote-trailer.mp4'),
// ('Demon Slayer', 'A brother and sister fight demons after their family is slaughtered.', '2019-04-06', 'ufotable', 15, 'Ongoing', 'https://example.com/demonslayer-cover.jpg', 'https://example.com/demonslayer-trailer.mp4'),
// ('Fullmetal Alchemist: Brotherhood', 'Two brothers use alchemy in search of a way to restore their bodies.', '2009-04-05', 'Bones', 13, 'Completed', 'https://example.com/fma-cover.jpg', 'https://example.com/fma-trailer.mp4'),
// ('Sword Art Online', 'Players are trapped in a virtual reality MMORPG where dying in the game means dying in real life.', '2012-07-08', 'A-1 Pictures', 14, 'Ongoing', 'https://example.com/sao-cover.jpg', 'https://example.com/sao-trailer.mp4'),
// ('Tokyo Ghoul', 'A college student becomes a half-ghoul after a near-fatal encounter.', '2014-07-04', 'Pierrot', 17, 'Completed', 'https://example.com/tokyoghoul-cover.jpg', 'https://example.com/tokyoghoul-trailer.mp4'),
// ('One Punch Man', 'A superhero who can defeat any opponent with a single punch.', '2015-10-04', 'Madhouse', 13, 'Ongoing', 'https://example.com/onepunchman-cover.jpg', 'https://example.com/onepunchman-trailer.mp4');";

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

