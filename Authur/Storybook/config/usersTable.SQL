DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `firstname` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `lastname` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `email` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `factors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `link` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `gatekeeper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `is_active` enum('0','1') NOT NULL,
	  `date_time` date NOT NULL,
	  `created` datetime NOT NULL,
	  `modified` datetime NOT NULL,
	  `views` int(11) NOT NULL DEFAULT 0,
	  `posts` int(11) NOT NULL DEFAULT 0
	) COLLATE=utf8mb4_unicode_ci;
