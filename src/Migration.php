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
//$smt->query($sql);


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
  title_japanese VARCHAR(200) NOT NULL,
  synopsis TEXT,
  episodes INTEGER NOT NULL,
  duration VARCHAR(100) NOT NULL,
  airing BOOLEAN NOT NULL,
  year INTEGER NOT NULL,
  rating VARCHAR(20) NOT NULL,
  score NUMERIC NOT NULL,
  season VARCHAR(20) NOT NULL,
  status VARCHAR(20) NOT NULL,
  studios JSONB,
  images JSONB,
  type VARCHAR(20),
  cover_url VARCHAR(200),
  trailer_url VARCHAR(200)
)";

$smt->exec($sql);

// Epsisode Table
$sql = "CREATE TABLE IF NOT EXISTS episode (
  id SERIAL PRIMARY KEY,
  episode_number INTEGER NOT NULL,
  title VARCHAR(100),
  description TEXT,
  release_date DATE,
  mal_id INTEGER NOT NULL,
  FOREIGN KEY (mal_id) REFERENCES anime(mal_id)
)";

$smt->exec($sql);

// $sql = <<<EOD
// INSERT INTO anime (mal_id, url, title, title_japanese, synopsis, episodes, duration, airing, year, rating, studios, score, season, status, images, type, cover_url, trailer_url)
// VALUES (9181, 'https://myanimelist.net/anime/9181/Motto_To_LOVE-Ru', 'Motto To LOVE-Ru', 'もっと To LOVEる -とらぶる-', 'Rito Yuuki never gets a break—he''s always finding himself in lewd accidents with girls around him. Although his heart still yearns for Haruna, his childhood love, Rito can''t help but question his feelings for Lala, the alien princess who appeared in front of him and declared she would marry him. But now, it''s not just Lala he has to deal with: her younger twin sisters, Momo and Nana, have also traveled to Earth, wanting to meet their older sister''s fiancé, and just as luck would have it, they end up staying at Rito''s home.
// Meanwhile, amidst the bustle of his new family members, Yami, the human weapon girl, begins her pursuit for Rito. It''s not an easy life for Rito as he deals with uncertain love, punishment for being a pervert, and a girl dead set on murdering him.
// [Written by MAL Rewrite]', 12, '24 min per ep', false, 2010, 'R+ - Mild Nudity', '["Geneon Universal Entertainment", "TBS", "Magic Capsule", "PRA"]', 7.27, 'fall', 'Finished Airing', '{"jpg": {"image_url": "https://cdn.myanimelist.net/images/anime/4/59875.jpg", "small_image_url": "https://cdn.myanimelist.net/images/anime/4/59875t.jpg", "large_image_url": "https://cdn.myanimelist.net/images/anime/4/59875l.jpg"}, "webp": {"image_url": "https://cdn.myanimelist.net/images/anime/4/59875.webp", "small_image_url": "https://cdn.myanimelist.net/images/anime/4/59875t.webp", "large_image_url": "https://cdn.myanimelist.net/images/anime/4/59875l.webp"}}', 'TV', 'https://cdn.myanimelist.net/images/anime/4/59875l.jpg', 'https://www.youtube.com/watch?v=TZlnXHWCnsE');
// EOD;

// $smt->exec($sql);
