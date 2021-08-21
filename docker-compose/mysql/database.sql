CREATE TABLE `user_types` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `type` varchar(60),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_type_id` int DEFAULT 2,
  `photo` varchar(60),
  `name` varchar(60),
  `surname` varchar(60),
  `email` varchar(60),
  `password` varchar(60),
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `saints` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `photo` varchar(60),
  `name` varchar(60),
  `baptism_name` varchar(60),
  `birthdate` date,
  `feast_date` date,
  `nation` varchar(60),
  `city` varchar(60),
  `phrase` longtext,
  `bio` longtext,
  `prayer` longtext,
  `approved` tinyint DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `comments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `saint_id` int,
  `comment` longtext,
  `approved` tinyint DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `users_devotion_saints` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `saint_id` int,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE saints_db.users ADD CONSTRAINT users_FK FOREIGN KEY (user_type_id) REFERENCES saints_db.user_types(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE saints_db.users_devotion_saints ADD CONSTRAINT users_devotion_saints_FK FOREIGN KEY (saint_id) REFERENCES saints_db.saints(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE saints_db.users_devotion_saints ADD CONSTRAINT users_devotion_saints_FK_1 FOREIGN KEY (user_id) REFERENCES saints_db.users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE saints_db.saints ADD CONSTRAINT saints_FK FOREIGN KEY (user_id) REFERENCES saints_db.users(id) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE saints_db.comments ADD CONSTRAINT comments_FK FOREIGN KEY (user_id) REFERENCES saints_db.users(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE saints_db.comments ADD CONSTRAINT comments_FK_1 FOREIGN KEY (saint_id) REFERENCES saints_db.saints(id) ON UPDATE CASCADE;

INSERT INTO saints_db.user_types (`type`, created_at, updated_at) VALUES ('Admin', NULL, NULL),	 ('Normal', NULL, NULL);

INSERT INTO saints_db.user_types (type) VALUES ('Admin');
INSERT INTO saints_db.user_types (type) VALUES ('Normal');

INSERT INTO saints_db.users (user_type_id, photo, name, surname, email, password, created_at, updated_at) VALUES (1, NULL, 'Daniel', 'Pereira', 'daniel.per.s@hotmail.com', '$2y$10$qQjKC7g.YgX8jyDGVqxoBuf8i/zpDZo8oVSvdcgEzKhn62MDI60Zy', NULL, NULL);