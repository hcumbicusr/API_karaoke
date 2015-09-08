-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.25


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema bd_karaoke
--

CREATE DATABASE IF NOT EXISTS bd_karaoke;
USE bd_karaoke;

--
-- Definition of table `music_business`
--

DROP TABLE IF EXISTS `music_business`;
CREATE TABLE `music_business` (
  `id_music` int(11) NOT NULL AUTO_INCREMENT,
  `id_musicgenre` int(11) NOT NULL,
  `id_typemusic` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `artist` varchar(200) DEFAULT NULL,
  `album` varchar(200) DEFAULT NULL,
  `description` text,
  `year_album` char(4) DEFAULT NULL,
  `ruta` varchar(250) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stat` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_music`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_business`
--

/*!40000 ALTER TABLE `music_business` DISABLE KEYS */;
INSERT INTO `music_business` (`id_music`,`id_musicgenre`,`id_typemusic`,`name`,`artist`,`album`,`description`,`year_album`,`ruta`,`likes`,`date_register`,`stat`) VALUES 
 (1,1,1,'Canción n 1','Art 1','Alb 1',NULL,'1990',NULL,3,'2015-08-20 14:53:35',2),
 (2,1,1,'Canción n 2','Art 1','Alb 1',NULL,'1990',NULL,2,'2015-08-20 14:53:35',2),
 (3,1,1,'Canción n 3','Art 1','Alb 1',NULL,'1990',NULL,8,'2015-08-20 14:53:35',2),
 (4,2,1,'Canción n 4','Art 2','Alb 2',NULL,'2005',NULL,10,'2015-08-20 14:53:35',2),
 (5,2,1,'Canción n 5','Art 3','Alb 3',NULL,'2006',NULL,19,'2015-08-20 14:53:35',2),
 (6,3,1,'Canción n 6','Art 4','Alb 4',NULL,'2015',NULL,40,'2015-08-20 14:53:35',2),
 (8,2,1,'Música de prueba',NULL,'','','1998','D:musica',0,'2015-08-23 16:51:27',2),
 (15,2,1,'Música de prueba 1','Artista de prueba','','','1998','D:musica',0,'2015-08-23 17:20:05',2),
 (16,2,1,'Música de prueba 4','Artista de prueba','alb 1','','1998','D:/musica',0,'2015-08-23 18:46:05',2),
 (17,2,1,'Música de prueba 3','Artista de prueba','alb 1','','1998','D:musica',0,'2015-08-23 20:19:52',4),
 (18,2,1,'Música de prueba 4','Artista de prueba','alb 1','','1998','D:/musica',0,'2015-08-23 17:33:38',2);
/*!40000 ALTER TABLE `music_business` ENABLE KEYS */;


--
-- Definition of table `music_genre`
--

DROP TABLE IF EXISTS `music_genre`;
CREATE TABLE `music_genre` (
  `id_musicgenre` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id_musicgenre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music_genre`
--

/*!40000 ALTER TABLE `music_genre` DISABLE KEYS */;
INSERT INTO `music_genre` (`id_musicgenre`,`name`) VALUES 
 (1,'GENERO 1'),
 (2,'GENERO 2'),
 (3,'GENERO 3');
/*!40000 ALTER TABLE `music_genre` ENABLE KEYS */;


--
-- Definition of table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_table` int(11) NOT NULL,
  `id_music` int(11) NOT NULL,
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_attention` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id_order`,`id_table`,`id_music`,`date_order`,`date_attention`,`stat`) VALUES 
 (47,1,1,'2015-08-31 10:33:43','0000-00-00 00:00:00',5),
 (48,3,3,'2015-08-31 12:45:21','0000-00-00 00:00:00',0),
 (49,4,4,'2015-08-31 12:45:30','0000-00-00 00:00:00',0),
 (50,5,5,'2015-08-31 12:45:33','0000-00-00 00:00:00',0),
 (51,6,5,'2015-08-31 12:48:49','0000-00-00 00:00:00',0),
 (52,6,6,'2015-08-31 12:58:37','0000-00-00 00:00:00',0),
 (53,7,7,'2015-08-31 13:40:20','0000-00-00 00:00:00',0),
 (54,4,3,'2015-08-31 13:40:46','0000-00-00 00:00:00',0),
 (55,4,2,'2015-08-31 13:41:05','0000-00-00 00:00:00',0),
 (56,1,2,'2015-08-31 13:44:03','0000-00-00 00:00:00',0),
 (57,1,3,'2015-08-31 13:44:16','0000-00-00 00:00:00',0),
 (58,2,1,'2015-08-31 13:47:09','0000-00-00 00:00:00',0),
 (59,2,2,'2015-08-31 13:47:39','0000-00-00 00:00:00',0),
 (60,3,4,'2015-08-31 14:30:06','0000-00-00 00:00:00',0),
 (61,5,2,'2015-08-31 16:14:08','0000-00-00 00:00:00',0),
 (62,9,2,'2015-08-31 16:15:27','0000-00-00 00:00:00',0),
 (63,12,2,'2015-08-31 16:25:53','0000-00-00 00:00:00',0),
 (64,12,5,'2015-09-01 00:20:14','0000-00-00 00:00:00',0),
 (65,11,5,'2015-09-01 00:27:37','0000-00-00 00:00:00',0),
 (66,9,3,'2015-09-01 08:42:47','0000-00-00 00:00:00',0),
 (67,11,1,'2015-09-01 08:57:08','0000-00-00 00:00:00',0),
 (68,10,5,'2015-09-01 10:21:42','0000-00-00 00:00:00',0),
 (69,13,2,'2015-09-01 10:50:45','0000-00-00 00:00:00',0),
 (70,13,4,'2015-09-01 10:51:17','0000-00-00 00:00:00',0),
 (71,7,4,'2015-09-01 11:12:35','0000-00-00 00:00:00',0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


--
-- Definition of table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `value` varchar(10) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_setting`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id_setting`,`description`,`value`,`stat`) VALUES 
 (1,'PED_X_MESA','2',2);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


--
-- Definition of table `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id_state` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id_state`,`name`) VALUES 
 (0,'PENDIENTE'),
 (1,'ATENDIDO'),
 (2,'ACTIVO'),
 (3,'INACTIVO'),
 (4,'ELIMINADO'),
 (5,'AGREGADO');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;


--
-- Definition of table `suggested_music`
--

DROP TABLE IF EXISTS `suggested_music`;
CREATE TABLE `suggested_music` (
  `id_suggested` int(11) NOT NULL AUTO_INCREMENT,
  `artist_group` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stat` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_suggested`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggested_music`
--

/*!40000 ALTER TABLE `suggested_music` DISABLE KEYS */;
INSERT INTO `suggested_music` (`id_suggested`,`artist_group`,`name`,`email`,`date_register`,`stat`) VALUES 
 (1,'Artista o grupo','Nombre de la canción','email@email.com','2015-08-25 18:37:40',2);
/*!40000 ALTER TABLE `suggested_music` ENABLE KEYS */;


--
-- Definition of table `table_business`
--

DROP TABLE IF EXISTS `table_business`;
CREATE TABLE `table_business` (
  `id_table` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(8) NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stat` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_table`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_business`
--

/*!40000 ALTER TABLE `table_business` DISABLE KEYS */;
INSERT INTO `table_business` (`id_table`,`number`,`date_register`,`stat`) VALUES 
 (1,'1','2015-08-20 14:50:30',2),
 (2,'2','2015-08-20 14:50:30',2),
 (3,'3','2015-08-20 14:50:30',2),
 (4,'4','2015-08-20 14:50:30',2),
 (5,'5','2015-08-20 14:50:30',2),
 (6,'6','2015-08-20 14:50:30',2),
 (7,'7','2015-08-20 14:50:30',2),
 (8,'8','2015-08-20 14:50:30',2),
 (9,'9','2015-08-20 14:50:30',2),
 (10,'10','2015-08-20 14:50:30',2),
 (11,'11','2015-08-25 22:04:38',2),
 (12,'12','2015-08-25 22:35:02',3);
/*!40000 ALTER TABLE `table_business` ENABLE KEYS */;


--
-- Definition of table `type_music`
--

DROP TABLE IF EXISTS `type_music`;
CREATE TABLE `type_music` (
  `id_typemusic` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id_typemusic`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_music`
--

/*!40000 ALTER TABLE `type_music` DISABLE KEYS */;
INSERT INTO `type_music` (`id_typemusic`,`name`) VALUES 
 (1,'TIPO 1'),
 (2,'TIPO 2'),
 (3,'TIPO 3');
/*!40000 ALTER TABLE `type_music` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `level` int(11) NOT NULL,
  `stat` int(11) NOT NULL DEFAULT '2',
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`,`name`,`password`,`fullname`,`email`,`level`,`stat`,`date_register`) VALUES 
 (1,'admin','21232f297a57a5a743894a0e4a801fc3','Henry Cumbicus Rivera','hcumbicusr@gmail.com',1,2,'2015-08-26 00:40:40'),
 (2,'usuario','e10adc3949ba59abbe56e057f20f883e','PEDRO PEREZ','email@email.com',2,2,'2015-08-26 00:49:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of procedure `sp_atender_sugerencia`
--

DROP PROCEDURE IF EXISTS `sp_atender_sugerencia`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_atender_sugerencia`(
in sugerencia int,
out salida text
)
BEGIN

update suggested_music set stat = 3 where id_suggested = sugerencia;

set salida = concat('OK',',','La sugerencia ha cambiado de estado');

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_cancion_playlist`
--

DROP PROCEDURE IF EXISTS `sp_cancion_playlist`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cancion_playlist`(
in pedido int,
out salida text
)
BEGIN


update orders set stat = 5 where id_order = pedido;

set salida = 'OK';

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_combo_genero`
--

DROP PROCEDURE IF EXISTS `sp_combo_genero`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_combo_genero`()
BEGIN

SELECT * FROM music_genre m;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_detalle_pedido`
--

DROP PROCEDURE IF EXISTS `sp_detalle_pedido`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_pedido`(
in id int
)
BEGIN

select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.description,
m.year_album, m.likes, g.name as genre from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

where o.id_order = id

order by date_order desc;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_editar_cancion`
--

DROP PROCEDURE IF EXISTS `sp_editar_cancion`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_cancion`(
in id_music_i int,
in id_musicgenre_i int,
in id_typemusic_i int,
in name_i varchar(250),
in artist_i varchar(200),
in album_i varchar(200),
in description_i text,
in y_album_i char(4),
in ruta_i varchar(250),

out salida text
)
BEGIN

update music_business set
id_musicgenre = id_musicgenre_i,
id_typemusic = id_typemusic_i,
name = name_i,
artist = artist_i,
album = album_i,
description = description_i,
year_album = y_album_i,
ruta = ruta_i
where id_music = id_music_i;

set salida = concat('OK',',','Modificado correctamente');


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_eliminar_cancion`
--

DROP PROCEDURE IF EXISTS `sp_eliminar_cancion`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_cancion`(
in id int,
out salida text
)
BEGIN

update music_business set stat =  4 where id_music = id;

set salida = concat('OK',',','La canción ha sido eliminada');

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_eliminar_mesa`
--

DROP PROCEDURE IF EXISTS `sp_eliminar_mesa`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_mesa`(
in mesa int,
out salida text
)
BEGIN

update table_business set stat =  3 where id_table = mesa;

set salida = concat('OK',',','La mesa ha sido eliminada');

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_eliminar_pedido`
--

DROP PROCEDURE IF EXISTS `sp_eliminar_pedido`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_pedido`(
in pedido int,
out salida text
)
BEGIN
-- estado = 4 ..> eliminado___ tabla states
update orders set stat = 4 where id_order = pedido;

set salida = 'OK';

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_canciones_album`
--

DROP PROCEDURE IF EXISTS `sp_listar_canciones_album`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_canciones_album`(
in album varchar(200)
)
BEGIN

SELECT m.*,g.name as genre, t.name as type_music
FROM music_business m
inner join music_genre g on m.id_musicgenre = g.id_musicgenre
inner join type_music t on m.id_typemusic = t.id_typemusic

where m.stat = 2 and
(
m.album like concat('%',album,'%')
)
order by m.name;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_canciones_artista`
--

DROP PROCEDURE IF EXISTS `sp_listar_canciones_artista`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_canciones_artista`(
in artista varchar(200)
)
BEGIN

SELECT m.*,g.name as genre, t.name as type_music
FROM music_business m
inner join music_genre g on m.id_musicgenre = g.id_musicgenre
inner join type_music t on m.id_typemusic = t.id_typemusic

where m.stat = 2 and
(
m.artist like concat('%',artista,'%') 
)
order by m.name;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_canciones_genero`
--

DROP PROCEDURE IF EXISTS `sp_listar_canciones_genero`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_canciones_genero`(
in genero int
)
BEGIN


SELECT m.*,g.name as genre, t.name as type_music
FROM music_business m
inner join music_genre g on m.id_musicgenre = g.id_musicgenre
inner join type_music t on m.id_typemusic = t.id_typemusic

where m.stat = 2 and m.id_musicgenre = genero
order by m.name;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_canciones_nombre`
--

DROP PROCEDURE IF EXISTS `sp_listar_canciones_nombre`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_canciones_nombre`(
in nombre varchar(200)
)
BEGIN

SELECT m.*,g.name as genre, t.name as type_music
FROM music_business m
inner join music_genre g on m.id_musicgenre = g.id_musicgenre
inner join type_music t on m.id_typemusic = t.id_typemusic

where m.stat = 2 and
(
m.name like concat('%',nombre,'%')
)
order by m.name;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_canciones_tipo`
--

DROP PROCEDURE IF EXISTS `sp_listar_canciones_tipo`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_canciones_tipo`(
in tipo int
)
BEGIN

SELECT m.*,g.name as genre, t.name as type_music
FROM music_business m
inner join music_genre g on m.id_musicgenre = g.id_musicgenre
inner join type_music t on m.id_typemusic = t.id_typemusic

where m.stat = 2 and m.id_typemusic = tipo
order by m.name;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_mesas`
--

DROP PROCEDURE IF EXISTS `sp_listar_mesas`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_mesas`()
BEGIN


SELECT t.* FROM table_business t
where stat = 2;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_pedidos`
--

DROP PROCEDURE IF EXISTS `sp_listar_pedidos`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_pedidos`()
BEGIN

select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.description,
m.year_album, m.likes, g.name as genre from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

order by date_order desc;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_pedidos_estado`
--

DROP PROCEDURE IF EXISTS `sp_listar_pedidos_estado`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_pedidos_estado`(
in estado int
)
BEGIN

if (estado = 0) then
select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.ruta,
m.year_album, m.likes, g.name as genre
from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

-- 5=agregado a la lista de reproduccion
where o.stat = estado or o.stat = 5

order by o.date_order, o.id_order;

else
select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.ruta,
m.year_album, m.likes, g.name as genre
from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

where o.stat = estado

order by o.date_order,o.id_order;
end if;
END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_pedidos_fechas`
--

DROP PROCEDURE IF EXISTS `sp_listar_pedidos_fechas`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_pedidos_fechas`(
in f1 date,
in f2 date
)
BEGIN


select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.description,
m.year_album, m.likes, g.name as genre from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

where date(date_order) between f1 and f2

order by date_order desc;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_pedidos_hoy`
--

DROP PROCEDURE IF EXISTS `sp_listar_pedidos_hoy`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_pedidos_hoy`()
BEGIN


select o.*,st.name as stat_desc, t.number, m.name as song, m.artist, m.album, m.description,
m.year_album, m.likes, g.name as genre from orders o
inner join table_business t on o.id_table = t.id_table
inner join music_business m on o.id_music = m.id_music
left join music_genre g on m.id_musicgenre = g.id_musicgenre
left join states st on st.id_state = o.stat

where date(o.date_order) = curdate()

order by date_order desc;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_sugerencias`
--

DROP PROCEDURE IF EXISTS `sp_listar_sugerencias`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_sugerencias`()
BEGIN

SELECT s.*, st.name as stat_desc
FROM suggested_music s
inner join states st on s.stat = st.id_state

order by s.stat;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_listar_sugerencias_estado`
--

DROP PROCEDURE IF EXISTS `sp_listar_sugerencias_estado`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_sugerencias_estado`(
in estado int
)
BEGIN

SELECT * FROM suggested_music s
where stat = estado order by date_register;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_login_usuario`
--

DROP PROCEDURE IF EXISTS `sp_login_usuario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login_usuario`(
in name_i varchar(100),
in pass_i varchar(150)
)
BEGIN

select * from users
where name = name_i and `password` = pass_i and stat = 2;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_modificar_pedido`
--

DROP PROCEDURE IF EXISTS `sp_modificar_pedido`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_modificar_pedido`(
in id_order_i int,
in id_table_i int,
in id_music_i int,

out salida text
)
BEGIN

update orders set id_music = id_music_i,id_table = id_table_i where id_order = od_order_i and stat = 0;

set salida = 'OK';

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_registrar_cancion`
--

DROP PROCEDURE IF EXISTS `sp_registrar_cancion`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_cancion`(
in id_musicgenre_i int,
in id_typemusic_i int,
in name_i varchar(250),
in artist_i varchar(200),
in album_i varchar(200),
in description_i text,
in y_album_i char(4),
in ruta_i varchar(250),

out salida text
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
END;

START TRANSACTION;

set @actual = now();

set @val = (select count(*) from music_business where name = name_i and album = album_i and stat = 2);

if (@val = 0) then
  insert into music_business values
  (
  null,
  id_musicgenre_i,
  id_typemusic_i,
  name_i,
  artist_i,
  album_i,
  description_i,
  y_album_i,
  ruta_i,
  0,
  @actual,
  2
  );

  set @val = (select count(*) from music_business where name = name_i and album = album_i and date_register = @actual and stat = 2);
  if (@val = 1) then
    commit;
    set @can = (select id_music from music_business where name = name_i and album = album_i and date_register = @actual and stat = 2);
    set salida = concat('OK',',',@can);
  else
    rollback;
    set salida = concat('NO',',','Ocurrió un error.');
  end if;
else
  set salida = concat('NO',',','Esta canción ya ha sido registrada.');
end if;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_registrar_mesa`
--

DROP PROCEDURE IF EXISTS `sp_registrar_mesa`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_mesa`(
in mesa varchar(8),
out salida text
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
END;

START TRANSACTION;

set @actual = now();

set @val = (select count(*) from table_business where number = mesa and stat = 2);

if (@val = 0) then
  insert into table_business values
  (
  null,
  upper(mesa),
  @actual,
  2
  );

  set @val = (select count(*) from table_business where number = mesa and stat = 2 and date_register = @actual);

  if (@val = 1) then
    commit;
    set salida = concat('OK',',','Mesa agregada');
  else
    rollback;
    set salida = concat('NO',',','No se ha podido agregar la mesa');
  end if;

else
  set salida = concat('NO',',','La mesa ya se encuentra registrada');

end if;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_registrar_pedido`
--

DROP PROCEDURE IF EXISTS `sp_registrar_pedido`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_pedido`(
in id_table_i int,
in id_music_i int,

out salida text
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
END;

START TRANSACTION;

set @actual = now();

-- PEDIDOS POR MESA
SET @ppm = (SELECT `value` FROM `settings` where description = 'PED_X_MESA' and stat = 2);

set @val = (select count(*) from orders where id_table = id_table_i and id_music = id_music_i and date(date_order) = curdate() and stat = 0);
set @val_s = (select count(*) from orders where id_table = id_table_i and stat = 0);
-- una mesa no puede solicitar la misma canción 2 veces mientras esté pendiente la primera solicitud
if (@val = 0 and (@val_s < @ppm) ) then
  insert into orders values
  (
  null,
  id_table_i,
  id_music_i,
  @actual,
  '',
  0
  );

  set @val = (select count(*) from orders where id_table = id_table_i and id_music = id_music_i and date_order = @actual and stat = 0);

  if (@val = 1) then
    commit;
    set @ped = (select id_order from orders where id_table = id_table_i and id_music = id_music_i and date_order = @actual and stat = 0);
    set salida = concat('OK',',',@ped);
  else
    rollback;
    set salida = concat('NO',',', 'No se ha podido registrar el pedido.');
  end if;

else
  set salida = concat('NO',',', 'Aun no puede hacer su pedido, por favor inténtelo más tarde.');

end if;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_registrar_sugerencia`
--

DROP PROCEDURE IF EXISTS `sp_registrar_sugerencia`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_sugerencia`(
in artist_group_i varchar(250),
in name_i varchar(250),
in email_i varchar(150),

out salida text
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
END;

START TRANSACTION;

set @actual = now();

set @val = (select count(*) from suggested_music where name = name_i and artist_group = artist_group_i and email =email_i);

if (@val = 0) then
  insert into suggested_music values
  (
  null,
  artist_group_i,
  name_i,
  email_i,
  @actual,
  2
  );

  set @val = (select count(*) from suggested_music
  where name = name_i and artist_group = artist_group_i and email =email_i and date_register = @actual);

  if (@val = 1) then
    commit;
    set salida = concat('OK',',','Sugerencia agregada');
  else
    rollback;
    set salida = concat('NO',',','Ocurrió un error');
  end if;

else

  set salida = concat('NO',',','La sugerencia ya ha sido agregada');

end if;


END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `sp_registrar_usuario`
--

DROP PROCEDURE IF EXISTS `sp_registrar_usuario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_usuario`(
in name_i varchar(100),
in password_i varchar(250),
in fullname_i varchar(250),
in email_i varchar(150),
in level_i int,

out salida text
)
BEGIN

DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
END;

START TRANSACTION;

set @actual = now();

set @val = (select count(*) from users where name = name_i);

if (@val = 0) then
  insert into users values
  (
  null,
  name_i,
  password_i,
  upper(fullname_i),
  email_i,
  level_i,
  2,
  @actual
  );
  set @val = (select count(*) from users where name = name_i and date_register = @actual);

  if (@val = 1) then
    commit;
    set salida = concat('OK',',','Usuario agregado');
  else
    rollback;
    set salida = concat('NO',',','No se ha podido registrar el usuario');
  end if;
else
  set salida = concat('NO',',','Ya existe un usuario con ese nombre');
end if;

END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
