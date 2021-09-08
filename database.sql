# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.34)
# Datenbank: api_token
# Erstellt am: 2021-06-29 20:44:34 +0000
# ************************************************************


CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `thumbnail` varchar(250),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `login_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table orders (
	id int primary key auto_increment,
	fullname varchar(100),
	phone_number varchar(20),
	email varchar(150),
	address varchar(200),
	order_date datetime
);


create table order_details (
	id int primary key auto_increment,
	order_id int references orders (id),
	product_id int references products (id),
	num int,
	price float
)


INSERT INTO `categories` (`id`, `name`, `parent`, `created_at`, `updated_at`)
VALUES
	(1,'Angus Trantow','0','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(4,'Tracy Schiller PhD','0','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(5,'Mr. Mortimer Senger I','0','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(6,'Cathy Boyer','0','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(7,'Josie Lueilwitz Jr.','8','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(8,'Alvina Murphy','1','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(9,'Mr. Gayle Nitzsche II','7','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(10,'Bret Walker','7','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(11,'Marlene Buckridge DDS','3','2021-06-06 18:56:59','2021-06-09 21:50:09'),
	(12,'7-Dr. Patsy Smith','7','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(13,'Brisa Stiedemann','9','2021-06-06 18:56:59','2021-06-09 21:50:09'),
	(14,'Heber Mertz','4','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(15,'Mr. Lyric Sauer II','6','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(16,'Dr Kleine','3','2021-06-06 18:56:59','2021-06-09 21:50:09'),
	(17,'Mckayla Labadie','3','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(18,'Trent Waters','1','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(19,'Raoul Rowe','3','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(20,'Henry Aufderhar DDS','1','2021-06-06 18:56:59','2021-06-06 18:56:59'),
	(21,'Jolie Murazik','0','2021-06-11 11:52:51','2021-06-11 11:52:51'),
	(22,'Jolie Murazik','0','2021-06-11 11:52:51','2021-06-11 11:52:51'),


INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`, `price`, `category_id`, `img`)
VALUES
	(51,'Angeline Herzog Test','Facilis qui eveniet mollitia beatae velit iste quod qui. Commodi cumque enim similique rem explicabo. Tempora vel odio iure et ex ut.','2021-06-06 18:56:59','2021-06-06 18:56:59',567.00,1,'60db80828c090_7.png'),
	(52,'Jonatan Skiles','Quasi aperiam facere omnis qui inventore impedit. Consequatur fugiat in enim natus ut hic quia. Deserunt sequi ipsum ipsa harum quo quis mollitia.','2021-06-06 18:56:59','2021-06-06 18:56:59',17.00,6,'picture.png'),
	(53,'Prof. Coleman Dibbert','Eos sequi animi magni nobis aut ad est repellat. Aliquid veritatis et optio ducimus quia. Sed nihil est inventore numquam voluptate.','2021-06-06 18:56:59','2021-06-06 18:56:59',363.00,1,'60db80dc732eb_7.png'),
	(54,'Darius DAmore','Iure magni illum sunt dolorem fuga quos et porro. Qui modi odio et dicta at error soluta. Quidem aspernatur et placeat illo delectus nulla voluptas. Nostrum unde vel qui ut.','2021-06-06 18:56:59','2021-06-06 18:56:59',394.00,7,'picture.png'),
	(55,'Carolyne Jacobson Sr.','Occaecati aspernatur unde voluptates. Rerum dolor cupiditate quaerat tenetur nihil. Odio nihil rerum libero et quos praesentium sint.','2021-06-06 18:56:59','2021-06-06 18:56:59',830.00,10,'picture.png'),
	(56,'Prof. Krystina Bechtelar I','Similique dolore non ipsa nulla aperiam porro et. Dolor et sit aspernatur. Eos excepturi eveniet at nihil qui modi.','2021-06-06 18:56:59','2021-06-06 18:56:59',381.00,7,'picture.png'),
	(57,'Dr. Peyton Reynolds','Officiis laudantium sunt dolores aliquam ullam. Doloremque ullam ea et ut occaecati quis dolorum eveniet. Nulla animi distinctio ut asperiores aut quae ut.','2021-06-06 18:56:59','2021-06-06 18:56:59',73.00,7,'picture.png'),
	(58,'Thaddeus Bashirian I','Autem eum et minima rerum ipsum ut unde. In quibusdam maxime eos dolorem aut accusantium. Ad similique dolorem omnis aut doloremque deleniti sint.','2021-06-06 18:56:59','2021-06-06 18:56:59',161.00,1,'picture.png'),
	(59,'Larue Bashirian','Nisi deserunt nostrum animi et. Nam et corrupti quo suscipit. Ea qui nesciunt repellat sint. Quibusdam libero saepe ut. Est accusamus nobis autem est. Non nesciunt molestiae ducimus dolor.','2021-06-06 18:56:59','2021-06-06 18:56:59',1691.00,10,'picture.png'),
	(60,'Kenny Vandervort','Eum ipsum temporibus qui explicabo temporibus voluptatem. Adipisci veritatis nobis vero quia officia est ea.','2021-06-06 18:56:59','2021-06-06 18:56:59',739.00,4,'picture.png'),
	(61,'Heidi Skiles','Est nulla voluptas expedita nostrum fugiat dicta unde. Eligendi est maxime ut optio sint. Perspiciatis illo eligendi perspiciatis debitis sed sunt beatae. Tenetur pariatur vel enim.','2021-06-06 18:56:59','2021-06-06 18:56:59',336.00,6,'60db80af39706_7.png'),
	(62,'Willis Zemlak II','Culpa sed aut beatae rem dolorum. Fugit nihil amet asperiores aut. Molestiae possimus et nemo recusandae et non sed. Sed quis ipsa saepe. Voluptas non alias ipsam repudiandae.','2021-06-06 18:56:59','2021-06-06 18:56:59',775.00,4,'picture.png'),
	(63,'Prof. Angela Zieme','Laudantium nisi incidunt et aut accusantium. Provident delectus est voluptatem quia aspernatur et molestiae id. Rerum sed sit accusamus est id. Saepe illo rem praesentium et sapiente.','2021-06-06 18:56:59','2021-06-06 18:56:59',389.00,8,'picture.png'),
	(64,'Dr. Royal Hackett','Fugiat veritatis voluptates et voluptatem aliquam. Vel et nemo quam sed enim. Hic molestias et est voluptate. Quae quisquam corrupti dolorem at qui. Magni officia quo dicta eos.','2021-06-06 18:56:59','2021-06-06 18:56:59',1430.00,1,'picture.png'),
	(65,'Fannie Koss','Et aut velit ab maiores eum id dolorem. Quia ut quo eum sint officiis ullam sit quaerat. Rerum nam enim laborum mollitia maxime similique exercitationem similique.','2021-06-06 18:56:59','2021-06-06 18:56:59',1865.00,5,'picture.png'),
	(66,'Dr. Dejah Nicolas II','Cupiditate doloribus culpa vitae. Eaque maiores necessitatibus autem illum enim ipsa. Quisquam in officia voluptate impedit ut quos. Iusto necessitatibus commodi iure dolores non alias.','2021-06-06 18:56:59','2021-06-06 18:56:59',1113.00,1,'picture.png'),
	(67,'Brennon Gleichner','Deserunt vel eaque pariatur fuga. Repellendus excepturi reiciendis qui nobis similique quae quidem. Explicabo distinctio qui et soluta enim. Pariatur adipisci tenetur veniam enim fuga.','2021-06-06 18:56:59','2021-06-06 18:56:59',1362.00,5,'picture.png'),
	(68,'Maverick Quitzon','Ipsa vero natus ex sapiente sed nihil. Quod doloremque aut culpa repudiandae est. Dolor quos possimus repellat. Minus et labore rem aut odio ab.','2021-06-06 18:56:59','2021-06-06 18:56:59',650.00,4,'picture.png'),
	(69,'Miss Malika Friesen MD','Quia sed voluptas quis minus non repellendus voluptatum eaque. Et nemo itaque quos error consequatur.','2021-06-06 18:56:59','2021-06-06 18:56:59',895.00,6,'picture.png'),
	(70,'Dr. Lucie Fay','Veritatis et placeat ipsum dolores. Sed nihil minus aut recusandae rerum ut sequi. Fuga earum est perspiciatis.','2021-06-06 18:56:59','2021-06-06 18:56:59',1235.00,1,'picture.png'),
	(71,'Angus Romaguera','Consequatur qui sequi magni excepturi iure totam repellat. Commodi sed neque mollitia commodi praesentium magni. Sequi nostrum voluptatem autem consequatur voluptatum debitis.','2021-06-06 18:56:59','2021-06-06 18:56:59',1095.00,8,'60db80908cdf1_6.png'),
	(72,'Kyle Ryan','Rem voluptatibus odio consequuntur rerum modi et odit. Sit molestiae nemo voluptatem voluptas. Harum nobis ducimus nobis qui qui.','2021-06-06 18:56:59','2021-06-06 18:56:59',104.00,8,'picture.png'),
	(73,'Ms. Juanita Halvorson Jr.','Ab voluptatum ex et quo qui ea. Sed dolor accusamus corporis sit dolor. Dolor recusandae accusamus fugit suscipit.','2021-06-06 18:56:59','2021-06-06 18:56:59',71.00,6,'picture.png'),
	(74,'Dr. Ramon Turcotte Jr.','Id assumenda omnis omnis perspiciatis at. Dolores quae sed in et vero voluptas. Consequatur quos neque nemo quis. Accusamus consequatur quia beatae eum voluptates illo minima.','2021-06-06 18:56:59','2021-06-06 18:56:59',1515.00,5,'picture.png'),

