create table usuarios(
  nick varchar(20) PRIMARY KEY,
  email varchar(50) UNIQUE NOT NULL,
  contrasenia varchar(20) NOT NULL,
  nombre_apellidos varchar(80),
  nacimiento date,
  pais varchar(30),
  libro_fav varchar(60),
  n_leidos int NOT NULL,
  imagen varchar(200)
);

create table libros(
  ISBN int NOT NULL AUTO_INCREMENT,
  titulo varchar(60) NOT NULL,
  autor varchar(80) NOT NULL,
  editorial varchar(40) NOT NULL,
  descripcion text NOT NULL,
  numPaginas INT UNSIGNED,
  anio SMALLINT UNSIGNED,
  quienIntroduce varchar(20),
  imagen varchar(200),
  FOREIGN KEY (quienIntroduce) REFERENCES usuarios(nick),
  PRIMARY KEY (ISBN)
);

--id_opinion smallint unsigned NOT NULL,

create table opiniones(
  ISBN int NOT NULL,
  quienIntroduce varchar(40) NOT NULL,
  opinion text NOT NULL,
  n_estrellas smallint NOT NULL,
  FOREIGN KEY (isbn) REFERENCES libros(isbn),
  FOREIGN KEY (quienIntroduce) REFERENCES usuarios(nick),
  CONSTRAINT ID PRIMARY KEY (isbn, quienIntroduce)
);

create table hilos(
  id_hilo int PRIMARY KEY,
  titulo_hilo varchar(100) NOT NULL,
  fecha_creacion date NOT NULL,
  n_visitas int NOT NULL,
  usuarioCreador varchar(20) NOT NULL,
  FOREIGN KEY (usuarioCreador) REFERENCES usuarios(nick)
);

create table comentarios(
  id_comentario int NOT NULL,
  id_hilo int NOT NULL,
  usuario varchar(20) NOT NULL,
  fecha_hora datetime NOT NULL,
  comentario text NOT NULL,
  responde_a int,
  FOREIGN KEY (id_hilo) REFERENCES hilos(id_hilo),
  FOREIGN KEY (usuario) REFERENCES usuarios(nick),
  FOREIGN KEY (responde_a) REFERENCES comentarios(id_comentario),
  CONSTRAINT ID PRIMARY KEY (id_comentario,id_hilo)
);


INSERT INTO usuarios VALUES ('Simon_LV', 'simonlv@micorreo.es', 'contrasenia123', 'Simón López Vico', '1996-10-12', 'ESP', 'El Nombre del Viento', 0, 'NULL');
INSERT INTO usuarios (nick, email, contrasenia, nombre_apellidos, nacimiento, pais, n_leidos) VALUES ('john_mayer', 'johnmayer@micorreo.es', 'contrasenia321', 'John Clayton Mayer', '1977-10-16', 'EEUU', 0);
INSERT INTO libros VALUES (127839478, 'El Nombre del Viento', 'Patrick Rothfuss', 'DAW Books', 'Descripcion libro', 800, 2007, 'Simon_LV', 'NULL');
INSERT INTO libros (titulo, autor, editorial, descripcion, numPaginas, anio, quienIntroduce) VALUES ('Don Quijote de la Mancha', 'Miguel de Cervantes', 'Altaya', 'Descripçao', 1200, 1500, 'john_mayer');
INSERT INTO libros (titulo, autor, editorial, descripcion, quienIntroduce) VALUES ('Harry Potter y nosequemas', 'J.K. Rowling', 'Altaya', 'Omg jarrui porer','a');
INSERT INTO opiniones VALUES (127839478, "Simon_LV", "Opinion", 4);
INSERT INTO opiniones VALUES (127839479, "john_mayer", "Maravilloso Quijote y Sancho, ilusiones, realidades, verdades como puños que se pueden aplicar hoy en día. Libro imprescindible.", 4);
INSERT INTO hilos VALUES (12345, 'Hilo de prueba mininio', '2019-5-23', 100, 'Simon_LV');
INSERT INTO comentarios (id_comentario, id_hilo, usuario, fecha_hora, comentario) VALUES(1, 12345, 'Simon_LV', '2019-5-23 11:51:00', 'Buenas este es un comentario de prueba sobre un hilo de prueba adios.');
INSERT INTO comentarios VALUES(2, 12345, 'john_mayer', '2019-5-23 11:52:00', 'Hola, te respondo al comentario.', 1);

--UPDATE comentarios SET comentario = 'Buenas este es un comentario de prueba sobre un hilo de prueba adios.' WHERE (id_comentario=1 AND id_hilo=12345);
