create table users (
	idUser bigint(19) unsigned primary key auto_increment,
	name varchar(255) not null,
	email varchar(255) not null,
	cpf varchar(11) null,
	password varchar(32) comment 'hash MD5' null,
    status tinyint(1) default 1 not null,
	phone varchar(11) null,
	constraint users_uk
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
							 constraint fk_address_users
								 foreign key  (user_id) references users (idUser)
									 on delete cascade,
							 PRIMARY KEY (`id`)) ENGINE = InnoDB
;



INSERT INTO users (name, email, password) VALUES ('administrator', 'admin@manyminds.com', '25d55ad283aa400af464c76d713c07ad');
#Senha : 12345678


create table ipsblock (
	 idIpsBlock bigint(19) unsigned primary key auto_increment,
	 ip varchar(15) not null,
	 count int default 1 not null,
	 idUser bigint(19) unsigned not null,
	 dateBlock datetime default null null,
	constraint uk_ipsblock
		  unique(ip,idUser),
	 constraint fk_ipsblock_users
		 foreign key  (idUser) references users (idUser)
			 on delete cascade
);
