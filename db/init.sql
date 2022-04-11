-- TODO: create tables

-- CREATE TABLE `plants` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`file_name`	TEXT NOT NULL
-- 	`plant_name`	TEXT NOT NULL,
-- 	`species_name`	TEXT NOT NULL,
-- 	`is_exploratoryconstructive`	INTEGER NOT NULL,
-- 	`is_exploratorysensory`	INTEGER NOT NULL,
-- 	`is_physical`	INTEGER NOT NULL,
-- 	`is_imaginative`	INTEGER NOT NULL,
-- 	`is_restorative`	INTEGER NOT NULL,
-- 	`is_expressive`	INTEGER NOT NULL,
-- 	`is_withrules`	INTEGER NOT NULL,
-- 	`is_bioplay`	INTEGER NOT NULL
-- );

-- CREATE TABLE `tags` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`is_perennial`	INTEGER NOT NULL,
-- 	`is_annual`	INTEGER NOT NULL,
-- 	`is_fullsun`	INTEGER NOT NULL,
-- 	`is_partialshade`	INTEGER NOT NULL,
-- 	`is_fullshade`	INTEGER NOT NULL,
-- 	`is_shrub`	INTEGER NOT NULL,
-- 	`is_grass`	INTEGER NOT NULL,
-- 	`is_vine`	INTEGER NOT NULL,
-- 	`is_tree`	INTEGER NOT NULL,
-- 	`is_flower`	INTEGER NOT NULL,
-- 	`is_groundcovers`	INTEGER NOT NULL,
-- 	`is_other`	INTEGER NOT NULL
-- );

-- CREATE TABLE `users` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
-- 	`username`	TEXT NOT NULL UNIQUE,
-- 	`password`	TEXT NOT NULL PRIMARY KEY UNIQUE
-- );

-- CREATE TABLE `relationships` (
-- 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
--  `plant_id`	INTEGER NOT NULL PRIMARY KEY UNIQUE,
-- 	`tag_id`	INTEGER NOT NULL PRIMARY KEY UNIQUE,
-- 	`image_id`	INTEGER NOT NULL PRIMARY KEY UNIQUE
-- );

-- TODO: initial seed data

-- INSERT INTO `plants` (id, plant_name, species_name, is_exploratoryconstructive, is_exploratorysensory, is_physical, is_imaginative, is_restorative, is_expressive, is_withrules, is_bioplay) VALUES ('example-1');

-- INSERT INTO `tags` (id, is_perennial, is_annual, is_fullsun, is_partialshade, is_fullshade, is_shrub, is_grass, is_vine, is_tree, is_flower, is_groundcovers, is_other) VALUES ('example-1');

-- INSERT INTO `images` (id, file_name) VALUES ('example-1');
