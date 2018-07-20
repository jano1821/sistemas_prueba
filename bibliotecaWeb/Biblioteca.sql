DROP DATABASE IF EXISTS BIBLIOTECA;
create DATABASE BIBLIOTECA;
USE BIBLIOTECA;

CREATE TABLE Estudiante(
  IdEstudiante VARCHAR(20) NOT NULL,
  Edad INTEGER,
  Nombre VARCHAR(50) NOT NULL,
  Email VARCHAR(40) NOT NULL,
  Carrera VARCHAR(40),
  Direccion VARCHAR(50),
  PromedioPonderado FLOAT,
  PRIMARY KEY (IdEstudiante)
);

CREATE TABLE Libro(
  IdLibro VARCHAR(20) NOT NULL,
  Descripcion VARCHAR(50) NOT NULL,
  ISBN VARCHAR(40) NOT NULL,
  CantidadEjemplares INTEGER NOT NULL,
  PRIMARY KEY (IdLibro)
);

CREATE TABLE Materia(
  IdMateria VARCHAR(20) NOT NULL,
  Descripcion VARCHAR(50) NOT NULL,
  Creditaje INTEGER NOT NULL,
  PRIMARY KEY (IdMateria)
);

CREATE TABLE Autor(
  IdAutor VARCHAR(20) NOT NULL,
  Nombre VARCHAR(50) NOT NULL,
  Area VARCHAR(40) NOT NULL,
  CantidadPublicaciones INTEGER NOT NULL,
  PRIMARY KEY (IdAutor)
);

CREATE TABLE Prestamos(
  Codigo INTEGER AUTO_INCREMENT,
  Estu VARCHAR(20) NOT NULL,
  Lib VARCHAR(20) NOT NULL,
  PRIMARY KEY (Codigo),
  FOREIGN KEY (Estu) REFERENCES Estudiante(IdEstudiante),
  FOREIGN KEY (Lib) REFERENCES Libro(IdLibro)
);

CREATE TABLE Calificacion(
  Codigo integer auto_increment,
  Estu VARCHAR(20) NOT NULL,
  Mate VARCHAR(20) NOT NULL,
  Nota double not null,
  PRIMARY KEY (Codigo),
  foreign key (Estu) references Estudiante(IdEstudiante),
  foreign key (Mate) references Materia(IdMateria)
);

create table LibroAutor(
  Codigo integer auto_increment,
  Aut varchar(20) not null,
  Lib varchar(20)not null,
  PRIMARY KEY (Codigo),
  FOREIGN KEY (Aut) REFERENCES Autor(IdAutor),
  FOREIGN KEY (Lib) REFERENCES Libro(IdLibro)

);