SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `krcms_agenda_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `krcms_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `krcms_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `uri` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

CREATE TABLE IF NOT EXISTS `krcms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_id_2` (`site_id`,`name`),
  KEY `name` (`name`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `krcms_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order_id` int(10) unsigned NOT NULL DEFAULT '0',
  `site_id` int(10) unsigned NOT NULL,
  `page_type_id` varchar(255) NOT NULL,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `publish_at` timestamp NULL DEFAULT NULL,
  `publish_till` timestamp NULL DEFAULT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `menu_title` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `order_id` (`order_id`),
  KEY `page_type_id` (`page_type_id`),
  KEY `menu_id` (`menu_id`),
  KEY `permalink` (`permalink`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

CREATE TABLE IF NOT EXISTS `krcms_pages_categories` (
  `page_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_pages_tags` (
  `page_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_page_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_meta_key` (`page_id`,`meta_key`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `krcms_page_types` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `page_handler` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `admin_form` varchar(255) DEFAULT NULL,
  `admin_template` varchar(255) DEFAULT NULL,
  `admin_form_handler` varchar(255) DEFAULT NULL,
  `is_child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `has_children` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `has_files` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `has_content` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_page_type_children` (
  `parent_page_type_id` varchar(255) NOT NULL,
  `child_page_type_id` varchar(255) NOT NULL,
  PRIMARY KEY (`parent_page_type_id`,`child_page_type_id`),
  KEY `child_page_type_id` (`child_page_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_page_type_privileges` (
  `page_type_id` varchar(255) NOT NULL,
  `privilege_id` varchar(255) NOT NULL,
  PRIMARY KEY (`page_type_id`,`privilege_id`),
  KEY `privilege_id` (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_privileges` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permalink` varchar(255) NOT NULL,
  `template` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `homepage_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `homepage_id` (`homepage_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `krcms_site_meta` (
  `id` int(10) unsigned NOT NULL,
  `site_id` int(10) unsigned NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_site_users` (
  `site_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`site_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `krcms_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `krcms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_ip_address` varchar(39) DEFAULT NULL,
  `login_count` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `krcms_users_privileges` (
  `user_id` int(10) unsigned NOT NULL,
  `privilege_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`,`privilege_id`),
  KEY `privilege_id` (`privilege_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `krcms_files`
  ADD CONSTRAINT `krcms_files_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_files_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_files_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `krcms_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_menus`
  ADD CONSTRAINT `krcms_menus_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `krcms_sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_pages`
  ADD CONSTRAINT `krcms_pages_ibfk_10` FOREIGN KEY (`menu_id`) REFERENCES `krcms_menus` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_ibfk_11` FOREIGN KEY (`site_id`) REFERENCES `krcms_sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_ibfk_7` FOREIGN KEY (`page_type_id`) REFERENCES `krcms_page_types` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_ibfk_9` FOREIGN KEY (`parent_id`) REFERENCES `krcms_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `krcms_pages_categories`
  ADD CONSTRAINT `krcms_pages_categories_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `krcms_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `krcms_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_pages_tags`
  ADD CONSTRAINT `krcms_pages_tags_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `krcms_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_pages_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `krcms_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_page_meta`
  ADD CONSTRAINT `krcms_page_meta_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `krcms_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_page_type_children`
  ADD CONSTRAINT `krcms_page_type_children_ibfk_1` FOREIGN KEY (`parent_page_type_id`) REFERENCES `krcms_page_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_page_type_children_ibfk_2` FOREIGN KEY (`child_page_type_id`) REFERENCES `krcms_page_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_page_type_privileges`
  ADD CONSTRAINT `krcms_page_type_privileges_ibfk_1` FOREIGN KEY (`page_type_id`) REFERENCES `krcms_page_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_page_type_privileges_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `krcms_privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_sites`
  ADD CONSTRAINT `krcms_sites_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_sites_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_sites_ibfk_3` FOREIGN KEY (`homepage_id`) REFERENCES `krcms_pages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `krcms_site_meta`
  ADD CONSTRAINT `krcms_site_meta_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `krcms_sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_site_users`
  ADD CONSTRAINT `krcms_site_users_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `krcms_sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_site_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `krcms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `krcms_users`
  ADD CONSTRAINT `krcms_users_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_users_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `krcms_users` (`id`) ON UPDATE CASCADE;

ALTER TABLE `krcms_users_privileges`
  ADD CONSTRAINT `krcms_users_privileges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `krcms_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krcms_users_privileges_ibfk_2` FOREIGN KEY (`privilege_id`) REFERENCES `krcms_privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

