create database agenciaautos;

use agenciaautos;


create table Autos(

	idAuto int not null auto_increment,

    	marca varchar(50) not null,
    
	modelo int not null,
    
	color varchar(50) not null,
	
	precio float not null,
    
	imagen varchar(200) not null,
    
	disponibilidad boolean not null,
    
    
	constraint pk_auto primary key(idAuto) 

);

alter table Autos add column imagen longblob not null

;
update autos set disponibilidad=0 where idAuto=2;

alter table Autos change column imagen imagen longblob;

select * from Autos;


insert into Autos(marca,modelo,color,precio,imagen,disponibilidad) values('ford',2015,'rojo',150000,'1.jpg',0);


create table usuarios(

	idUsuario int not null auto_increment,
    
	nombreus varchar(50) not null,
    
	contraseña varchar(8) not null,
    
	tipousuario varchar(30) not null,
    
    
	constraint pk_usuario primary key(idUsuario)

);

alter table usuarios change contraseña contrasena varchar(20) not null

insert into usuarios(nombreus,contrasena,tipousuario) values('sergio','1234','Administrador');

select * from usuarios

delete from usuarios where idUsuario=1

create table rentas(

	idRenta  int not null auto_increment,

	idAuto int not null,
    
	idUsuario int not null,
    
	fechasalida date not null,
    
	fechaentrega date not null,
    
	ndias int not null,
    
	total float not null,
    
	estadorenta varchar(50),
    
    
	constraint pk_renta primary key(idRenta),
    
	constraint fk_auto foreign key(idAuto) references Autos(idAuto),
    
	constraint fk_usuario2 foreign key(idUsuario) references Usuarios(idUsuario)

);

Drop table rentas;

insert into usuarios(nombreus,contraseña,tipousuario) values('sergio','1234','Administrador');

insert into usuarios(nombreus,contraseña,tipousuario) values('ele','1234','General');

select * from usuarios;

drop table ventas;


create table comentarios(

	idComentario int not null auto_increment,
    
	idUsuario int not null,
    
	comentario varchar(500) not null,
    
    
	constraint pk_comentario primary key(idComentario),
    
	constraint fk_usuario4 foreign key(idUsuario), 
	references usuarios(idUsuario)

);

create table ventas(
	
	idVenta int not null auto_increment,
    
	idAuto int not null,
    
	idUsuario int not null,
    
	fechaventa date not null,
    
	descuento float not null,
    
	total float not null,
    
	estadoventa varchar(50),
    
   
	constraint pk_venta primary key(idVenta),
    
	constraint fk_auto2 foreign key(idAuto) references Autos(idAuto),
    
	constraint fk_usuario3 foreign key(idUsuario) references Usuarios(idUsuario)

);
