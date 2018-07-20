DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`AutorActualizar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`AutorActualizar`(id varchar(20),nom varchar(50),areax varchar(40),can integer)
BEGIN
update Autor set Nombre=nom,Area=areax,CantidadPublicaciones=can where IdAutor=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`AutorBuscar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`AutorBuscar`(id varchar(20))
BEGIN
select * from Autor where IdAutor=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`AutorEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`AutorEliminar`(id varchar(20))
BEGIN
delete from Autor where IdAutor=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`AutorInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`AutorInsertar`(id varchar(20),nom varchar(50),areax varchar(40),can integer)
BEGIN
insert into Autor(IdAutor,Nombre,Area,CantidadPublicaciones)
values (id,nom,areax,can);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`AutorListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`AutorListar`(id varchar(20))
BEGIN
select * from Autor where IdAutor like concat('%',id,'%');
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`CalificacionInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`CalificacionInsertar` (e varchar(20),m varchar(20), notax double)
BEGIN
insert into Calificacion(Estu,Mate,Nota) values (e,m,notax);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS biblioteca.`CalificacionEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE biblioteca.`CalificacionEliminar`(cod integer)
BEGIN
delete from Calificacion where Codigo=cod;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`CalificacionBuscar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`CalificacionBuscar` (cod integer)
BEGIN
select * from Calificacion where Codigo=cod;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`CalificacionListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`CalificacionListar` (e varchar(20))
BEGIN
select * from Calificacion where Mate=e;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`CalificacionActualizar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`CalificacionActualizar`(e varchar(20),m varchar(20), notax double)
BEGIN
update Calificacion set Nota=notax
where Estu=e and Mate=m;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`EstudianteEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`EstudianteEliminar`(id varchar(20))
BEGIN
   delete from Estudiante where IdEstudiante = id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`EstudianteInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`EstudianteInsertar`(id varchar(20), ed INTEGER, nom VARCHAR(50), correo VARCHAR(40), car VARCHAR(40), dir VARCHAR(50))
BEGIN
    insert into Estudiante (IdEstudiante,Edad,Nombre,Email,Carrera,Direccion)
		values (id,ed,nom,correo,car,dir);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`EstudianteListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`EstudianteListar`(id varchar(20))
BEGIN
select * from Estudiante where IdEstudiante like concat('%',id,'%');
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`EstudianteBuscar` $$
CREATE DEFINER=`root`@`localhost`  PROCEDURE `biblioteca`.`EstudianteBuscar`(id varchar(20))
BEGIN
    select * from Estudiante where IdEstudiante = id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`EstudianteActualizar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`EstudianteActualizar`(id varchar(20), ed INTEGER, nom VARCHAR(50), correo VARCHAR(40), car VARCHAR(40), dir VARCHAR(50))
BEGIN
update Estudiante set Edad=ed,
		Nombre=nom,
		Email=correo,
		Carrera=car,
		Direccion=dir
	  where IdEstudiante=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroActualizar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroActualizar`(id varchar(20),des varchar(50), isbn varchar(40),can integer)
BEGIN
update Libro set CantidadEjemplares=can,
		ISBN=isbn,
		Descripcion=des
	  where IdLibro=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroBuscar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroBuscar`(id varchar(20))
BEGIN
select * from Libro where IdLibro=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroEliminar`(id varchar(20))
BEGIN
delete from Libro where IdLibro=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroInsertar`(id varchar(20),des varchar(50), isb varchar(40),can integer)
BEGIN
insert into Libro(IdLibro,Descripcion,ISBN,CantidadEjemplares)
values (id,des,isb,can);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroListar`(id varchar(20))
BEGIN
select * from Libro where IdLibro like concat('%',id,'%');
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroAutorInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroAutorInsertar` (a varchar(20),l varchar(20))
BEGIN
insert into LibroAutor(Aut,Lib) values (a,l);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroAutorEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroAutorEliminar` (cod integer)
BEGIN
delete from LibroAutor where Codigo=cod;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroAutorBuscar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroAutorBuscar` (id varchar(20))
BEGIN
select * from LibroAutor where Lib=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`LibroAutorListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`LibroAutorListar` (l varchar(20))
BEGIN
select * from LibroAutor where Lib=l;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`MateriaActualizar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`MateriaActualizar`(id varchar(20), des varchar(50), cred integer)
BEGIN
update Materia set Descripcion=des,Creditaje=cred
where IdMateria=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`MateriaBuscar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`MateriaBuscar`(id varchar(20))
BEGIN
select * from Materia where IdMateria=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`MateriaEliminar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`MateriaEliminar`(id varchar(20))
BEGIN
delete from Materia where IdMateria=id;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`MateriaInsertar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`MateriaInsertar`(id varchar(20), des varchar(50), cred integer)
BEGIN
insert into Materia (IdMateria,Descripcion,Creditaje)
values (id,des,cred);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`MateriaListar` $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `biblioteca`.`MateriaListar`(id varchar(20))
BEGIN
select * from Materia where IdMateria like concat('%',id,'%');
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`PrestamoInsertar` $$
CREATE PROCEDURE `biblioteca`.`PrestamoInsertar` (e varchar(20),l varchar(20))
BEGIN
insert into Prestamos(Estu,Lib) values (e,l);
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`PrestamoEliminar` $$
CREATE PROCEDURE `biblioteca`.`PrestamoEliminar` (cod integer)
BEGIN
delete from Prestamos where Codigo=cod;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`PrestamosBuscar` $$
CREATE PROCEDURE `biblioteca`.`PrestamosBuscar` (cod integer)
BEGIN
select * from Prestamos where Codigo=cod;
END $$

DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `biblioteca`.`PrestamoListar` $$
CREATE PROCEDURE `biblioteca`.`PrestamoListar` (e varchar(20))
BEGIN
select * from Prestamos where Estu=e;
END $$

DELIMITER ;

