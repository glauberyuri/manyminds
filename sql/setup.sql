create table users (
	idUser bigint(19) unsigned primary key auto_increment,
	name varchar(255) not null,
	email varchar(255) not null,
	cpf varchar(11) null,
	password varchar(32) comment 'hash MD5' null,
    status tinyint(1) default 1 not null,
	phone varchar(11) null,
	add constraint users_uk
		unique (email)
);

create table address (
	idAddress bigint(19) unsigned primary key auto_increment,
	cep varchar(8) not null,
	street varchar(255) not null ,
	number varchar(20) not null,
	block varchar(255) not null,
	city varchar(255) null,
	state varchar(255) null,
    country  varchar(255) null,
    idUser bigint(19) unsigned not null,
    constraint fk_address_users
    	foreign key  (idUser) references users (idUser)
        on delete cascade
);

CREATE TABLE `auth_tokens` ( `id` INT NOT NULL AUTO_INCREMENT ,
							 `user_id` INT(11) NOT NULL , `token` VARCHAR(255) NOT NULL ,
							 `expiry_date` VARCHAR(50) NOT NULL ,
							 `created_at` VARCHAR(50) NOT NULL ,
							 PRIMARY KEY (`id`)) ENGINE = InnoDB;
