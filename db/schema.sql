/*
Basic schema for testing
*/

drop database if exists `rm_db`;
create database `rm_db`;
use `rm_db`;

-- rm_db.user def
create table `users` (
	`id` int not null auto_increment,
	`userName` varchar(100) default null,
	`firstName` varchar(100) default null,
	`lastName` varchar(100) default null,
	`email` varchar(100) default null,
	`passwd` varchar(100) default null,
	primary key (`id`),
	constraint unique_user unique (`id`, `userName`)
) Engine=InnoDB;

-- rm_db.resumes def
create table `resumes` (
	`id` int not null auto_increment,
	`userId` varchar(100) default null,
	`name` varchar(100) default null,
	`pdf` blob default null,
	primary key (`id`),
	foreign key (`userId`) refrences users(`id`)
) Engine=InnoDB;
