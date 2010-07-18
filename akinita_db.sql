


drop DATABASE if exists `akinita`;
create DATABASE `akinita`;

use `akinita`;

create table `users`
(
	`username` char(20) not null,
	`password` char(16) not null,
	`email` char(20) not null,
	`name` char(16),
	`surname` char(16),
	`user_type` enum('Adminstrator','user'),
	unique(`email`),
	primary key(`username`)
)engine=innoDB default character set utf8 collate utf8_general_ci;

create table `telephone`
(
	`tel_id` int(10) auto_increment,
	`home` char(10),
	`mobile1` char(10) not null,
	`mobile2` char(10),
	`other` char(10),
	`user_id` char(20),
	primary key (`tel_id`),
	foreign key(`user_id`) references `users` (`username`)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table `property`
(
	`prop_id` int not null auto_increment primary key,
	`address` char(100) not null,
	`price` int(15) not null,
	`offer_type` ENUM('P','L'),   -- <-----
	`area` int(10) not null,
	`constr_date` date,
	/*coordinates */
	`photos` mediumblob,
	`comments` text,
	`user_id` varchar(20),
	foreign key(`user_id`) references `users` (`username`)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table `facilities`
(
	`fac_id` int not null auto_increment,
	`facility` varchar(20) not null,
	primary key(`fac_id`)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table `fac_prop`
(
	`fac_id` int,
	`prop_id` int,
	primary key(`fac_id`,`prop_id`)	
)engine=innoDB default character set utf8 collate utf8_general_ci;

create table `categories`
(
	`cat_id` int not null auto_increment,
	`category` char(20) not null,
	primary key(`cat_id`)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table `cat_prop`
(
	`cat_id` int,
	`prop_id` int,
	primary key(`cat_id`,`prop_id`)
);