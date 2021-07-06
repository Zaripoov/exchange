-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `balance`;
CREATE TABLE `balance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `balance` int NOT NULL,
  `user_id` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_balance` (`user_id`),
  CONSTRAINT `user_balance` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `balance` (`id`, `balance`, `user_id`, `updated_at`) VALUES
(1,	989,	1,	1625601524),
(2,	58,	2,	1625601211),
(3,	559,	3,	1625600647),
(4,	785,	4,	1625601524);

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `balance` int NOT NULL,
  `to_user_id` int NOT NULL,
  `whom_user_id` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `to_user` (`to_user_id`),
  KEY `whom_user` (`whom_user_id`),
  CONSTRAINT `to_user` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `whom_user` FOREIGN KEY (`whom_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `history` (`id`, `balance`, `to_user_id`, `whom_user_id`, `created_at`) VALUES
(1,	1,	1,	2,	1625576078),
(2,	5,	1,	4,	1625576124),
(3,	5,	4,	3,	1625576372),
(4,	20,	1,	2,	1625588041),
(5,	5,	4,	3,	1625591000),
(6,	14,	1,	4,	1625596518),
(24,	1,	1,	2,	1625601040),
(25,	1,	1,	2,	1625601121),
(26,	1,	1,	2,	1625601136),
(27,	1,	1,	2,	1625601191),
(28,	1,	1,	2,	1625601211),
(29,	5,	1,	4,	1625601524);

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1625564752),
('m130524_201442_init',	1625564754),
('m190124_110200_add_verification_token_column_to_user_table',	1625564754),
('m210706_200002_create_user_item_table',	1625601818),
('m210706_200442_create_balance_table',	1625602301),
('m210706_200625_create_history_table',	1625602301);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1,	'admin',	'-ZQKEO1yh9ZMmqGFaGG_3jUvNlTS1Orq',	'$2y$13$eCR3eVoDeFRxYT9oqDhIF./zkLp5ebwMHmH7N5MPA2CnKkY802/1u',	NULL,	'admin@yandex.ru',	10,	1625565258,	1625565258,	'LnGH8hMKi92HazLWyqPRE_fNzpSmEce9_1625565258'),
(2,	'user',	'QAX9oZjCfkY-oxLBsJUbR6BqMIukGO27',	'$2y$13$dY8YxMjZCN/uAq2KGOke4unaa0Vz2.FKWV5AoUEGdUfmyx8.5He8O',	NULL,	'user@yandex.ru',	10,	1625565277,	1625565277,	'7uDxApNiQKJeCdNpZjcP_PrI6C834BcH_1625565277'),
(3,	'maxsim',	'1-W3NI9FCGlRmvh_Ylc3Gw7F3YNonxhP',	'$2y$13$WhK9rNx5RcxHWDNgy6AF2uAOobrveyi4BXl/QYtMgUB7dNtyIs6lu',	NULL,	'maxsim@yandex.ru',	10,	1625566074,	1625566074,	'dEL9Atzspn0F-EfuGuFgFVB7qimMZPV2_1625566074'),
(4,	'maks',	'H1YVFnGomfwiPDYZ4uf4wfgXdwYGd1U1',	'$2y$13$27I/eszTQZ/wKmyASDdZnOe95CEnbZhhBbOoxlmZqumgXB4LT6vb.',	NULL,	'maks@yandex.ru',	10,	1625566097,	1625566097,	'gmT6cKmir5MzVXd6Tjb5dof-i3kSQN5h_1625566097');

DROP TABLE IF EXISTS `user_item`;
CREATE TABLE `user_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user_item` (`id`, `name`, `surname`, `middle_name`, `user_id`) VALUES
(1,	'Андрей',	'Андреев',	'Андреевич',	1),
(2,	'Иван',	'Иванов',	'Иванович',	2),
(3,	'Максим',	'Звягинцев',	'Дмитриевич',	3),
(4,	'Макс',	'Ицикович',	'Райкин',	4);

-- 2021-07-06 20:14:37
