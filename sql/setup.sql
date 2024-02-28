create table users (
	idUser bigint(19) unsigned primary key auto_increment,
	name varchar(255) not null,
	email varchar(255) not null,
	cpf varchar(11) null,
	password varchar(32) comment 'hash MD5' null,
    status tinyint(1) default 1 not null,
	phone varchar(11) null
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

