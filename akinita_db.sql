
drop DATABASE if exists akinita;
create DATABASE akinita;

use akinita;

create table users
(
	username char(20) not null,
	password char(16) not null,
	email char(50) not null,
	name varchar(100),
	surname varchar(100),
	user_type enum('A','U'),
	unique(email),
	primary key(username)
)engine=innoDB default character set utf8 collate utf8_general_ci;

create table telephone
(
	tel_id int auto_increment,
	home char(10),
	mobile1 char(10) not null,
	mobile2 char(10),
	other char(10),
	user_id char(20) not null,
	primary key(tel_id),
	constraint phones_constr
	foreign key(user_id) references users(username)
	on delete cascade on update cascade
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table property
(
	prop_id int not null auto_increment,
	address char(100) not null,
	price int(15) not null,
	offer_type ENUM('S','L'),   -- <-----
	area int(10) not null,
	constr_date int(4),
	/*coordinates */
	photos mediumblob,
	views int(10) default '0',
	comments text,
	modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	propState ENUM('T','F'),
	user_id char(20),
	primary key(prop_id),
	foreign key(user_id) references users(username)
	on delete cascade on update cascade
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table fav_prop
(
	user_id char(20) not null,
	prop_id int not null,
	primary key(user_id,prop_id),
	constraint favProp_c1
	foreign key(user_id) references users(username)
	on delete cascade on update cascade,
	constraint favProp_c2
	foreign key(prop_id) references property(prop_id)
	on delete cascade on update cascade
)engine=innoDB default character set utf8 collate utf8_general_ci;

create table facilities
(
	fac_id int not null auto_increment,
	facility varchar(100) not null,
	primary key(fac_id)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table fac_prop
(
	prop_id int not null,
	fac_id int not null,
	primary key(fac_id,prop_id),
	constraint facProp_constr1
	foreign key(prop_id) references property(prop_id)
	on delete cascade on update cascade,
	constraint facProp_constr2
	foreign key(fac_id) references facilities(fac_id)
	on delete cascade on update cascade
)engine=innoDB default character set utf8 collate utf8_general_ci;

create table categories
(
	cat_id int not null auto_increment,
	category varchar(100) not null,
	primary key(cat_id)
)engine=innoDB default character set utf8 collate utf8_general_ci auto_increment=1;

create table cat_prop
(
	prop_id int not null,
	cat_id int not null,
	constraint catProp_constr1
	foreign key(prop_id) references property(prop_id)
	on delete cascade on update cascade,
	constraint catProp_constr2
	foreign key(cat_id) references categories(cat_id)
	on delete cascade on update cascade	,
	primary key(cat_id,prop_id)
)engine=innoDB default character set utf8 collate utf8_general_ci;


grant select, insert, update, delete on akinita.* to akinauth identified by 'password';
flush privileges;