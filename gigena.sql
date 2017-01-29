

-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2017 a las 18:28:20
-- Versión del servidor: 5.7.9
-- Versión de PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gigena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

DROP TABLE IF EXISTS `articulos`;
CREATE TABLE IF NOT EXISTS `articulos` (
  `id_articulo` int(11) NOT NULL AUTO_INCREMENT,
  `autor_id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `url_img_principal` varchar(255) NOT NULL,
  `galeria` varchar(255) DEFAULT NULL,
  `visitas` int(10) NOT NULL,
  `activa` tinyint(4) NOT NULL,
  `especial` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_articulo`),
  UNIQUE KEY `id_articulo` (`id_articulo`),
  UNIQUE KEY `url` (`url`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `autor_id` (`autor_id`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `autor_id`, `id_categoria`, `url`, `titulo`, `texto`, `fecha_creacion`, `fecha_modificacion`, `url_img_principal`, `galeria`, `visitas`, `activa`, `especial`) VALUES
(1, 1, 2, 'Programa/ayuda-gratuita-', 'Ayuda Gratuita ', '<p>o&nbsp;&nbsp;&nbsp;Programa de Narcóticos Anónimos: El centro Gigena Parker facilita un espacio para la realización de un programa de ayuda mutua. Este programa es anónimo, gratuito y confidencial.&nbsp;El principal objetivo del mismo es generar adherencia y complementar el tratamiento profesional.&nbsp;</p>', '2016-12-20 03:16:26', '2016-12-20 03:16:26', '', '', 1, 1, 0),
(2, 1, 2, 'Programa/programa-de-prevencion-y-tratamiento-de-las-conductas-', 'Programa de Prevención y Tratamiento de las Conductas ', '<p>o&nbsp;<span style="color: black;">A través de un experimentado equipo interdisciplinario, ofrecemos un innovador programa cuyo objetivo central radica en la recuperación integral del paciente con problemas de adicción y su familia, según los estándares internacionales aplicados a esta problemática. Esto se logra a través de una estrategia que permite mejorar la calidad de vida del paciente y su familia a corto y largo plazo.&nbsp;Para ello, debemos lograr&nbsp;el mantenimiento de la abstinencia y lograr un contexto en el que pueden alcanzar mejorías en la salud integral del paciente.&nbsp;</span></p><p><strong style="color: black;"><u>El programa incluye: </u></strong></p><p><span style="color: black;">&nbsp;.Evaluación integral del paciente y su familia, para decidir el tratamiento a implementar</span></p><p><span style="color: black;"> .Test diagnósticos específicos. Planificación del tratamiento.&nbsp;</span></p><p><span style="color: black;"> .Desintoxicación médicamente asistida.&nbsp;</span></p><p><span style="color: black;"> .Programa Residencial&nbsp;a corto y mediano plazo, si fuese necesario </span></p><p><span style="color: black;"> .Tratamientos ambulatorios estructurados diurnos.&nbsp;</span></p><p><span style="color: black;"> .Programa de Tratamiento sin demanda</span></p><p><span style="color: black;"> .Entrevistas motivacionales previas para aquellos pacientes que no deciden a ingresar a   un&nbsp;tratamiento que requiera abstinencia total.&nbsp;</span></p><p><span style="color: black;">.Tratamiento Integrativo del Paciente Dual (trastornos adictivos y psiquiátricos) cuando se determine que el programa pueda ser beneficioso según el perfil del paciente y la familia.&nbsp;</span></p><p><span style="color: black;">.Monitoreo de drogas en orina.&nbsp;</span></p><p><span style="color: black;">.Tratamientos especiales.</span></p>', '2016-12-20 03:17:19', '2016-12-20 03:17:19', '', '', 0, 1, 0),
(3, 1, 2, 'Programa/programa-de-tratamiento-para-trastornos-de-personalidad-', 'Programa de Tratamiento para Trastornos de Personalidad ', '<p>o&nbsp;&nbsp;&nbsp;<span style="color: black;">Los trastornos de la personalidad están marcados por el&nbsp;malestar crónico, cuyos intentos para aliviarse los afectan aún más (y a su familia), tienen dificultades para adaptarse, no aprenden estrategias de afrontamiento, se desmotivan muy rápido, consumen mucha&nbsp;energía, les falta organización y estructura y tienen comportamientos ineficaces para resolver sus problemas. Este concepto es crucial para entender a estos pacientes tienen enormes dificultades para cambiar aún sabiendo que este cambio sería beneficioso</span></p><p><strong style="color: black;">¿Qué ofrecemos?</strong></p><p><span style="color: black;">Aplicamos un Programa Integral probado en diversas partes del mundo, que apunta principalmente al aprendizaje de habilidades psicológicas y sociales en conjunto con un sistema contingencial desarrollado especialmente por nuestro equipo e implementado en un significativo número de personas asistidas. </span></p><p><span style="color: black;">Dicho de otra manera, nuestro programa posibilita que el paciente aprenda y mejore su capacidad para manejarse mejor en lo referido a sus emociones, pensamientos y cosas que hacen, asociadas con las dificultades que le causan tristeza y malestar, a través del fuerte cambio de la actitud familiar.</span></p><p><span style="color: black;">El objetivo del programa es reducir los problemas causados por el caos interpersonal, la inestabilidad emocional, la impulsividad en las acciones y los conflictos de autoimagen. Para ello, enseñamos a manejar situaciones conflictivas, a aumentar el control de las mismas, a regular las emociones y a tolerar el malestar, como así también a sus familias a mejorar la consistencia y coherencia en el manejo de la situación</span></p>', '2016-12-20 03:18:33', '2016-12-20 03:18:33', '', '', 0, 1, 0),
(4, 1, 2, 'Programa/programa-de-psiquiatria-&-psicologia--infanto-juvenil-', 'Programa de Psiquiatría & Psicología  Infanto Juvenil ', '<p><span style="color: black;">El equipo de Psiquiatría y Psicología Infanto Juvenil dispone de un grupo de profesionales especializados y ofrece la evaluación, diagnóstico y tratamiento para niños y adolescentes con problemas conductuales, emocionales y del aprendizaje, en las distintas etapas del desarrollo.</span></p><p><span style="color: black;">﻿</span></p><p><strong><u>¿Que situaciones abodamos</u>?&nbsp;﻿</strong></p><ul><li>Trastornos del estado del ánimo: Depresión y Trastorno Bipolar.</li><li>Trastornos de ansiedad: ataques de pánico, ansiedad generalizada, ansiedad de separación, fobias generales y específicas (fobia escolar) y trastorno obsesivo compulsivo.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li><li>Trastorno por déficit de atención (TDAH) con Hiperactividad.&nbsp;Trastornos de conducta: oposicional – desafiante.</li><li>Trastornos de conducta alimentaria.&nbsp;</li><li>Trastornos generalizados del desarrollo: Autismo.&nbsp;Psicosis tempranas- Esquizofrenia.&nbsp;Retraso Mental</li></ul><p><br></p><p><strong><u>Que ofrecemos?</u></strong></p><ul><li>Evaluación y Diagnóstico del Niño y la Familia</li><li>Entrevistas de Orientación y Asesoramiento a los Padres</li><li>Psicoeducación</li><li>Intervenciones en crisis</li><li>Interconsultas</li><li>Psicoterapia individual para niños y adolescentes</li><li>Psicoterapia Familiar</li><li>Entrevistas vinculares&nbsp;&nbsp;&nbsp;(padre-hijo, madre-hijo, hermanos)</li><li>Terapia Psicofarmacológica</li><li>Orientación y Asesoramiento a Equipos docentes</li><li>Psicoprofilaxis prequirúrgica</li><li>Articulación con Equipos médicos</li></ul>', '2016-12-20 03:19:34', '2016-12-20 03:23:23', '', '', 2, 1, 0),
(5, 1, 2, 'Programa/programa-residencial-en-comunidad-terapeutica-', 'Programa Residencial en Comunidad Terapéutica ', '<p>o&nbsp;&nbsp;&nbsp;E<span style="color: black;">ste programa se lleva a cabo en la localidad de Las Vertientes de La Granja, tranquila localidad situada a 50 km. de la Ciudad de Córdoba, a menos de 40 minutos del aeropuerto internacional. Se trata de una antigua casa de piedra, reformada para albergar a 24 residentes. La construcción y funcionamiento de la casa fue pensada con el concepto del respeto por el medio ambiente, como pre-requisito&nbsp;del respeto por&nbsp;uno mismo. La casa está rodeada de pequeñas sierras, en un espacio amplio, sereno, seguro y discreto.&nbsp;&nbsp;</span></p><p><br></p><p>&nbsp;<strong style="color: black;">El equipo profesional</strong></p><p><span style="color: black;">La Comunidad Terapéutica Profesional Las Vertientes cuenta con un experimentado equipo de profesionales que, mediante un trabajo interdisciplinario, apuntan al los objetivos propuestos con el residente y su familia. Nuestro equipo tiene amplia experiencia en tratamientos ambulatorios, por lo que se hace énfasis en la reinserción y el cambio familiar.</span></p><p>o&nbsp;&nbsp;&nbsp;<span style="color: black;">Médico psiquiatra:</span></p><p>o&nbsp;&nbsp;&nbsp;<span style="color: black;">Psicólogos:</span></p><p>o&nbsp;&nbsp;&nbsp;<span style="color: black;">Operadores terapéuticos</span></p><p><br></p><p><strong style="color: black;">Ventajas de un tratamiento residencial </strong></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abstinencia controlada</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mayor intensidad y continuidad en el tratamiento.</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reproducción de comportamientos sociales bajo&nbsp;condiciones de observación e intervención óptimas.</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mayor potencial de eficacia por la&nbsp;intervención&nbsp;grupal</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Separación temporal de entorno habitual</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trabajo intensivo con la familia, la distancia con el residente puede ayudar a generar un contexto óptimo para observarse a ellos mismos y así planificar los cambios necesarios.</span></p><p><span style="color: black;">·&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trabajo intensivo con residentes geográficamente alejados que no pueden realizar un tratamiento ambulatorio.</span></p>', '2016-12-20 03:21:07', '2016-12-20 03:21:07', '', '', 2, 1, 0),
(6, 1, 2, 'Programa/programa-de-prevencion-y-tratamiento-de-las-conductas-adictivas-', 'Programa de Prevención y Tratamiento de las Conductas Adictivas ', '<p><span style="color: black;">A través de un experimentado equipo interdisciplinario, ofrecemos un innovador programa cuyo objetivo central radica en la recuperación integral del paciente con problemas de adicción y su familia, según los estándares internacionales aplicados a esta problemática. Esto se logra a través de una estrategia que permite mejorar la calidad de vida del paciente y su familia a corto y largo plazo.&nbsp;Para ello, debemos lograr&nbsp;el mantenimiento de la abstinencia y lograr un contexto en el que pueden alcanzar mejorías en la salud integral del paciente.&nbsp;</span></p><p><br></p><p><span style="color: black;">Esto se logra a&nbsp;través del restablecimiento de sus redes sociales saludables, sus vínculos familiares y&nbsp;enfocándose enérgicamente hacia el trabajo responsable, se puede alcanzar el equilibrio perdido.</span></p><p><span style="color: black;"> Según el Instituto Nacional de Salud de Estados Unidos, no es necesario que el tratamiento sea inicialmente voluntario para que sea efectivo, pero sí es esencial mantener al paciente en tratamiento por un tiempo adecuado para que lo sea. Nuestro programa puede comenzar con una motivación escasa por parte del&nbsp;paciente, contando solamente con el compromiso familiar y a partir del trabajo con ellos, que el paciente desarrolle un vínculo y pueda apreciar por sí mismo las ventajas de la recuperación en un contexto comunitario de motivación.</span></p><p><span style="color: black;"><span class="ql-cursor">﻿</span></span></p><p><span style="color: black;"> De esta manera ofrecemos sólo&nbsp;</span><u style="color: black;">tratamientos integrales con programas terapéuticos&nbsp;</u><span style="color: black;">para personas con problemas de adicción al alcohol, marihuana, cocaína y otras adicciones tanto químicas como comportamentales. Ya sea que asistan voluntariamente, llevados por un familiar o por alguna&nbsp;orden&nbsp;judicial o laboral.</span></p>', '2016-12-20 03:21:52', '2016-12-20 03:22:36', '', '', 4, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `id_categoria` (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(0, 'Noticias'),
(1, 'Nosotros'),
(2, 'Programa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

DROP TABLE IF EXISTS `equipo`;
CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `contenido` varchar(1000) DEFAULT NULL,
  `img_perfil` varchar(300) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `titulo`, `contenido`, `img_perfil`) VALUES
(0, 'Dr. Dario Gigena Parker', 'Médico Especialista en Psiquiatria', 'MP:23278- ME:8299. Ex alumno de la Escuela de Estudio en Alcohol y Drogas de la Univ. de Rutguers de New Jersey (USA) Pasantía en Medicina de Adicciones en Tully Hill Drug and Alcohol Rehabilitation Center (New York, USA). Profesor Asociado de la Facultad de Ciencias Médicas de la Universidad Nacional de Córdoba. Autor de artículos sobre la especialidad. Miembro fundador ISAM (Sociedad Internacional de Medicina de Adicciones) y miembro de su comité directivo ejecutivo (2005-2008).', 'imgs/equipo/IMG_8739.png'),
(1, 'Lic. Rushdy Salman', 'Psicologo', 'MP: 2939. Diplomado en Adicciones (Universidad Santiago de Chile) miembro del Staff de la Unidad de Adicciones de la Universidad de Santiago de Chile. Docente de la Diplomatura en Adicciones, Prevención y Asistencia de la Universidad de Santiago de Chile. Entrenado en el primer nivel de EMDR (tecnica congitivo-conductual para trauma, adicciones, trastornos de Fake Omega seamaster UK la personalidad y de ansiedad).', 'imgs/equipo/IMG_8742.png'),
(2, 'Lic. Graciela Maza', 'Psicologa', 'MP:5086. Postgrado en Adolescentes y Niños (Lic. Marta Reta). Entrenamiento en Bulimia y Anorexia en DOXA. Formacion en Sistemica Narrativa (Casa de Familia). \r\nEntrenada en el primer nivel de EMDR (tecnica congitivo-conductual para trauma, adicciones, trastornos de la personalidad y de ansiedad).', 'imgs/equipo/IMG_8743.png'),
(3, 'Lic. Guillermo Ponce Japaze', 'Psicólogo Clínico', 'Formación en Terapia Cognitiva Comportamental de segunda y tercera generación. Miembro estable de CIPCO (Centro Integral de Psicoterapias Cognitivas) y de LACI (Laboratorio de Comportamiento Interpersonal). Formación y entrenamientoen evaluación y rehabilitación neurocognitiva.', 'imgs/equipo/IMG_874442.png'),
(4, 'Lic. Guillermo Torres', 'Psicólogo clínico', 'Especialista en Psicoterapia Cognitivo Comportamental de segunda y tercera ola. Entrenado en primer nivel de EMDR Ex integrante del Programa Cambio. Integrante del equipo terapeutico de Cipco.', 'imgs/equipo/IMG_874223.png'),
(5, 'Lic. Valeria Putero Baravalle', 'Lic. en Psicología', 'Postgrado en Terapia Familiar Sistémica. Certificada en Terapia Conductual Dialectica. Behavioral Tech. Marsha Linehan. Docente del Curso de Operadores Terapeuticos en Adicciones. FCM. UNC.', 'imgs/equipo/IMG_8745.png'),
(6, 'Lic. Cecilia Villalba', 'Lic. en Psicología', 'Entrenada en terapia familiar sistemica y psicoeducación para familiares de personas con enfermedades mentales severas y persistentes. Postgrado en Terapia Gestaltica. Certificada en Terapia Conductual Dialectica. Behavioral Tech. Marsha Linehan. Docente del Curso de Operadores Terapeuticos en Adicciones. FCM. UNC.', 'imgs/equipo/IMG_87422.png'),
(7, 'Dra. Claudia Chacon', 'Médica clínica', 'Postgrado para la Especialidad en Psiquiatria. FCM. UNC. Certificada en Terapia Conductual Dialectica. Behavioral Tech. Marsha Linehan.', 'imgs/equipo/IMG_874222.png'),
(8, 'Lic. Sabrina Trovato', 'Lic. en Psicología', 'Entrenada en Psicoterapia Cognitivo Conductual y en Psicología de las Organizaciones. Certificada en Terapia Conductual Dialectica. Behavioral Tech. Marsha Linehan.', 'imgs/equipo/IMG_8747.png'),
(9, 'Lic. Gonzalo Rojas', 'Lic. en Psicologia', 'Ex integrante del centro "Por un mundo mejor". Operador terapeutico.', 'imgs/equipo/IMG_87432.png'),
(10, 'OST Gonzalo Gutierrez', '', 'Curso de Operador Terapeutico en Adicciones. FCM. UNC.', 'imgs/equipo/IMG_87443.png'),
(11, 'Cra. Luciana Juncos', '', 'Direccion administrativa', 'imgs/equipo/IMG_8742222.png'),
(12, 'Laura Juncos', '', 'Secretaria', 'imgs/equipo/IMG_874112.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE IF NOT EXISTS `privilegios` (
  `id_priv` int(11) NOT NULL AUTO_INCREMENT,
  `privilegio` varchar(20) DEFAULT NULL,
  UNIQUE KEY `id_priv` (`id_priv`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id_priv`, `privilegio`) VALUES
(5, 'Cliente'),
(13, 'Administrador'),
(11, 'Editor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL,
  `prefijo` varchar(25) DEFAULT NULL,
  `especialidad` varchar(120) DEFAULT NULL,
  `titulos` varchar(2000) DEFAULT NULL,
  `img_perfil` varchar(300) DEFAULT NULL,
  `privilegio` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `activo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `privilegio` (`privilegio`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `passw`, `prefijo`, `especialidad`, `titulos`, `img_perfil`, `privilegio`, `fecha_creacion`, `activo`) VALUES
(1, 'Federico', 'Laztra', 'korylinkin@gmail.com', '$2y$10$rk0qhMeOuNJAl9e9LbJpkOaXb/EuGGkDei8RsiP24Tof8B50j7L7q', NULL, NULL, NULL, NULL, 13, '2016-12-19 08:20:04', 1),
(2, 'Chabon ', 'Numero', 'federico@gmail.com', '$2y$10$EdMh2MttrYO3mDgjwnFxPe85tP.ptKU1DYEhQifNQ7mlWfQBKewjW', NULL, NULL, NULL, NULL, 11, '2016-12-20 04:10:22', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
