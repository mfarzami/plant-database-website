-- TODO: create tables

 CREATE TABLE `plants` (
 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`file_name`	TEXT NOT NULL
 	`plant_name`	TEXT NOT NULL,
 	`species_name`	TEXT NOT NULL
 );

 CREATE TABLE `tags` (
 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
 	`tag`	TEXT NOT NULL UNIQUE
 );

 CREATE TABLE `users` (
 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
 	`username`	TEXT NOT NULL UNIQUE,
 	`password`	TEXT NOT NULL PRIMARY KEY UNIQUE
 );

 CREATE TABLE `relationships` (
 	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `plant_id`	INTEGER NOT NULL PRIMARY KEY UNIQUE,
 	`tag_id`	INTEGER NOT NULL PRIMARY KEY UNIQUE,
 );

-- TODO: initial seed data

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (1, 'GR_13', 'Lungwort', 'Pulmonaria lingifolia');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (2, 'GA_17', 'Yarrow', 'Achillea millefolium');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (3, 'FL_24', 'Black cohosh', 'Actaea racemosa');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (4, 'FE_05', 'Cinnamon Fern', 'Osmunda cinnamomea');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (5, 'FE_05', 'Astilbe', 'Astilbe spp.');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (6, 'VI_08', 'American Hogpeanut', 'Amphicarpea bracteata');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (7, 'SH_17', 'Dwarf Everbearing Mulberry', 'Morus nigra');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (8, 'GR_11', 'Sweet Woodruff', 'Galium odoratum');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (9, 'TR_13', 'Cornelian Cherry', 'Cornus mas');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (10, 'GR_01', 'Bigroot Geranium', 'Geranium macrorrhizum');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (11, 'TR_24', 'Eastern Hemlock', 'Tsuga canadensis');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (12, 'SH_26', 'Chokeberry', 'Aronia melanocarpa');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (13, 'GA_11', 'Purple lovegrass', 'Eragrostis spectabilis');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (14, 'GA_09', 'Little False Bluestem', 'Schizachyrum scoparium');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (15, 'GR_19', 'Jacob''s ladder', 'Polemonium retptans');

 INSERT INTO `plants` (id, file_name, plant_name, species_name) VALUES (16, 'GA_18', 'Prairie Dropseed', 'Sporobolus heterolepis');


 INSERT INTO `tags` (id, tag) VALUES (1, 'EC');
 INSERT INTO `tags` (id, tag) VALUES (2, 'ES');
 INSERT INTO `tags` (id, tag) VALUES (3, 'PHYS');
 INSERT INTO `tags` (id, tag) VALUES (4, 'IMAG');
 INSERT INTO `tags` (id, tag) VALUES (5, 'REST');
 INSERT INTO `tags` (id, tag) VALUES (6, 'EXP');
 INSERT INTO `tags` (id, tag) VALUES (7, 'WR');
 INSERT INTO `tags` (id, tag) VALUES (8, 'BP');
 INSERT INTO `tags` (id, tag) VALUES (9, 'PER');
 INSERT INTO `tags` (id, tag) VALUES (10, 'AN');
 INSERT INTO `tags` (id, tag) VALUES (11, 'SUN');
 INSERT INTO `tags` (id, tag) VALUES (12, 'PS');
 INSERT INTO `tags` (id, tag) VALUES (13, 'SHADE');
 INSERT INTO `tags` (id, tag) VALUES (14, 'SHR');
 INSERT INTO `tags` (id, tag) VALUES (15, 'GRASS');
 INSERT INTO `tags` (id, tag) VALUES (16, 'VINE');
 INSERT INTO `tags` (id, tag) VALUES (17, 'TREE');
 INSERT INTO `tags` (id, tag) VALUES (18, 'FLOW');
 INSERT INTO `tags` (id, tag) VALUES (19, 'GC');
 INSERT INTO `tags` (id, tag) VALUES (20, 'OTHER');

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (1, 1, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (2, 1, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (3, 1, 4); INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (4, 1, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (5, 1, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (6, 1, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (7, 1, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (8, 1, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (9, 2, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (10, 2, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (11, 2, 1); INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (12, 2, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (13, 2, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (14, 2, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (16, 2, 15);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (17, 3, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (18, 3, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (19, 3, 4); INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (20, 3, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (21, 3, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (22, 3, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (23, 3, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (24, 3, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (25, 4, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (26, 4, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (27, 4, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (27, 4, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (28, 4, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (29, 4, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (30, 4, 20);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (31, 5, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (32, 5, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (33, 5, 4); INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (34, 5, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (35, 5, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (36, 5, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (37, 5, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (38, 5, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (39, 6, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (40, 6, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (41, 6, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (42, 6, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (43, 6, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (44, 6, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (45, 6, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (46, 6, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (47, 6, 16);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (48, 7, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (49, 7, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (50, 7, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (51, 7, 7);INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (52, 7, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (53, 7, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (54, 7, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (55, 7, 14);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (56, 8, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (57, 8, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (58, 8, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (59, 8, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (60, 8, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (61, 8, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (62, 8, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (63, 8, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (64, 9, 1);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (65, 9, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (66, 9, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (67, 9, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (68, 9, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (69, 9, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (70, 9, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (71, 9, 17);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (72, 10, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (73, 10, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (74, 10, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (75, 10, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (76, 10, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (77, 10, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (78, 10, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (79, 10, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (80, 10, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (81, 10, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (82, 11, 1);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (83, 11, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (84, 11, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (85, 11, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (86, 11, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (87, 11, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (88, 11, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (89, 11, 13);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (90, 11, 17);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (91, 12, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (92, 12, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (93, 12, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (94, 12, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (95, 12, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (96, 12, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (97, 12, 14);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (98, 13, 1);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (99, 13, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (100, 13, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (101, 13, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (102, 13, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (103, 13, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (104, 13, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (105, 13, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (106, 13, 15);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (107, 14, 1);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (108, 14, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (109, 14, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (110, 14, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (111, 14, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (112, 14, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (113, 14, 15);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (114, 15, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (115, 15, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (116, 15, 4);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (117, 15, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (118, 15, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (119, 15, 12);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (120, 15, 19);

 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (121, 16, 1);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (122, 16, 2);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (123, 16, 3);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (124, 16, 5);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (125, 16, 8);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (126, 16, 9);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (127, 16, 11);
 INSERT INTO `relationships` (id, plant_id, tag_id) VALUES (128, 16, 15);
