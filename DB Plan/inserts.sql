INSERT INTO `ceumh`.`carrera` 
(nombre, cantCuatri, cantMateria)
VALUES 
('Administración de empresas',9,45),
('Arquitectura',9,45),
('Cirujano dentista',10,50),
('Contaduría con énfasis en auditoria',9,45),
('Derecho con énfasis en fe pública',9,45),
('Gastronomía',9,45),
('Mercadotecnia',9,45),
('Psicología socioeducativa',9,45);


INSERT INTO `ceumh`.`alumno`
(idAlumno,nombre,apellidoP,apellidoM,nivelEducativo,
carrera,grupo)
VALUES
(420957,'Oscar','Morales','Cruz',3,3,1),
(354481,'Gamaliel','Rios','Serrano',3,3,1),
(360000,'Christian','Sánchez','Olguín',3,8,1),
(353029,'Jorge','Licea','Tinajero',3,1,1),
(420000,'Arphaxad','Calderón','Romero',3,5,1),
(350000,'Alonso','Vergara','Lorenzo',3,4,1),
(123456,'Tyrel','Fixer','Doer',2,null,3);


INSERT INTO `ceumh`.`docente`
(idDocente,nombre,apellidoP,apellidoM)
VALUES
(553311,'Norma','Salazar','Viveros'),
(553312,'Edrein','Aguilar','Ramírez'),
(553313,'Vanessa','Ureña','Medina');


INSERT INTO `ceumh`.`administrativo`
(idAdmin,nombre,apellidoP,apellidoM,topLevelAcc)
VALUES
(911,'Enrique','Peña','Nieto',1),
(912,'Felipe','Calderón','Hinojosa',0);


INSERT INTO `ceumh`.`accesoAlumno`
(idAlumno,pwsd)
VALUES
(420957,'420957'),
(354481,'354481'),
(360000,'360000'),
(353029,'353029'),
(420000,'420000'),
(350000,'350000'),
(123456,'123456');


INSERT INTO `ceumh`.`accesoDocente`
(idDocente,pwsd)
VALUES
(553311,'553311'),
(553312,'553312'),
(553313,'553313');


INSERT INTO `ceumh`.`accesoAdministrativo`
(idAdmin,pwsd)
VALUES
(911,'911'),
(912,'912');