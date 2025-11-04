-- Kiptra Sri Lanka - Database Schema

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Admin','Vendor','Moderator','User') NOT NULL DEFAULT 'User',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `listings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category_id` int(11) unsigned NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `rating_avg` decimal(3,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `reviews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `rating` int(1) NOT NULL,
  `comment` text,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `listing_id` (`listing_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `vendors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `business_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `flags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `reason` text,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`id`),
  KEY `listing_id` (`listing_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
