-- Se elimina si existe la base de datos para hacer una nueva
drop schema if exists proyectoNRP;

-- Se crea la bd
create schema proyectoNRP;
use proyectoNRP;

-- Creamos la tabla de cliente
drop table if exists cliente;
CREATE TABLE cliente(
	id int(11) Primary Key auto_increment,
	username varchar(10) unique,
	nombre varchar(20),
	apellidos varchar(30),
	email varchar(20),
	telefono int(9),
	password varchar(10)
);

-- Creamos la tabla jefe, un proyecto tiene un jefe
drop table if exists jefe;
CREATE TABLE jefe(
	id int(11) Primary Key auto_increment,
	nombre varchar(20),
	apellidos varchar(30),
	email varchar(20),
	telefono int(9)
);

-- Creamos la tabla proyecto
drop table if exists proyecto;
CREATE TABLE proyecto(
	id int(11) auto_increment,
	id_jefe int (11),
	nombre varchar(20) unique,
	descripcion varchar(500),
	esfuerzoMax int(4),
  primary key(id, id_jefe),
	foreign key (id_jefe) references jefe(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creamos la tabla requisito
drop table if exists requisito;
CREATE TABLE requisito(
	id int(11) Primary Key auto_increment,
	nombre varchar(20) unique,
	descripcion varchar(500)
);

-- Creamos la tabla importancia, un cliente
-- tiene un peso en un proyecto (W)
drop table if exists importancia;
CREATE TABLE importancia(
	id_pro int(11),
	id_cli int(11),
	peso int(2),
  primary key(id_pro, id_cli),
  foreign key (id_pro) references proyecto(id) ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (id_cli) references cliente(id) ON DELETE CASCADE ON UPDATE CASCADE
);


drop table if exists valor;
CREATE TABLE valor(
	id_pro int(11),
	id_req int(11),
	id_cli int(11),
	valor int(30),
  primary key(id_pro, id_req, id_cli),
  foreign key (id_pro) references proyecto(id) ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (id_req) references requisito(id) ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (id_cli) references cliente(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creamos la tabla esfuerzo, un requisito tiene un esfuerzo
-- en un proyecto
drop table if exists esfuerzo;
CREATE TABLE esfuerzo(
	id_pro int(11),
	id_req int(11),
	peso int(5),
	todo bit,
  primary key(id_pro, id_req),
  foreign key (id_pro) references proyecto(id) ON DELETE CASCADE ON UPDATE CASCADE,
  foreign key (id_req) references requisito(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- INTRODUCCIÓN DE DATOS

Insert into cliente values (1, "ssg", "Santiago", "Soriano", "santi@gmail.com", 666666666, "1234a");
Insert into cliente values (2, "rl", "Razvan", "Lismanu", "razvan@gmail.com", 696969699, "1234a");
Insert into cliente values (3, "gm", "Gabi", "Morales", "gabi@gmail.com", 666666666, "1234a");
Insert into cliente values (4, "sn", "Salim ", "Najjary", "salim@gmail.com", 666666666, "1234a");
Insert into cliente values (5, "jtv", "Jefferson ", "Tomala", "jefferson@gmail.com", 666666666, "1234a");


Insert into jefe values (1, "Jefe", "Antonio", "ant@gmail.com", 66666666);
Insert into jefe values (2, "Viejo", "Juan", "juan@gmail.com", 66666666);
Insert into jefe values (3, "Jefe ", "Pepe", "pepe@gmail.com", 66666666);


Insert into proyecto values (1, 1, "Primer_proyecto", "Proyecto de prueba",50);
Insert into proyecto values (2, 2, "Proyecto_Razvan", "Proyecto de prueba de Razvan", 10);
Insert into proyecto values (3, 2, "Proyecto_Gabi", "Proyecto de prueba de Gabi", 10);
Insert into proyecto values (4, 3, "Proyecto_Cine", "Proyecto de prueba de cine", 10);
Insert into proyecto values (5, 3, "Primer_Salim", "Proyecto de prueba de Salim", 20);

Insert into requisito values(1, "Facil", "Facil de usar");
Insert into requisito values(2, "Rapido", "Que sea rapido");
Insert into requisito values(3, "Rendimiento", "Rendimiento rapido");
Insert into requisito values(4, "Fiabilidad", "Que sea Fiable");
Insert into requisito values(5, "Seguridad", "Que tenga Seguridad");
Insert into requisito values(6, "Mantenimiento", "Facil mantenimiento");
Insert into requisito values(7, "Interfaz", "Interfaz");

insert into valor values(1, 1, 1, 5);
insert into valor values(2, 2, 2, 4);
insert into valor values(2, 3, 3, 3);
insert into valor values(3, 4, 4, 4);
insert into valor values(4, 5, 4, 2);

insert into importancia values(1, 1, 20);
insert into importancia values(2, 2, 10);
insert into importancia values(3, 3, 10);
insert into importancia values(4, 4, 20);
insert into importancia values(5, 4, 15);

Insert into esfuerzo values(1, 1, 10.2, 0);
Insert into esfuerzo values(2, 2, 20.0, 0);
Insert into esfuerzo values(2, 3, 5.0, 0);
Insert into esfuerzo values(3, 4, 15.0, 0);
Insert into esfuerzo values(4, 5, 20, 0);