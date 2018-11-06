-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 06, 2018 at 06:54 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softinno_rendiciones_2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `afp`
--

CREATE TABLE `afp` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `porcentaje` double(8,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anos`
--

CREATE TABLE `anos` (
  `id` int(10) UNSIGNED NOT NULL,
  `ano` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anos`
--

INSERT INTO `anos` (`id`, `ano`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2018', 1, NULL, NULL),
(2, '2019', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calculo_horas`
--

CREATE TABLE `calculo_horas` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carga_mensuals`
--

CREATE TABLE `carga_mensuals` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPeriodo` int(10) UNSIGNED NOT NULL,
  `idEstablecimiento` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comunas`
--

CREATE TABLE `comunas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idProvincia` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comunas`
--

INSERT INTO `comunas` (`id`, `nombre`, `idProvincia`, `created_at`, `updated_at`) VALUES
(1, 'Arica', 1, NULL, NULL),
(2, 'Camarones', 1, NULL, NULL),
(3, 'General Lagos', 2, NULL, NULL),
(4, 'Putre', 2, NULL, NULL),
(5, 'Alto Hospicio', 3, NULL, NULL),
(6, 'Iquique', 3, NULL, NULL),
(7, 'Camiña', 4, NULL, NULL),
(8, 'Colchane', 4, NULL, NULL),
(9, 'Huara', 4, NULL, NULL),
(10, 'Pica', 4, NULL, NULL),
(11, 'Pozo Almonte', 4, NULL, NULL),
(12, 'Antofagasta', 5, NULL, NULL),
(13, 'Mejillones', 5, NULL, NULL),
(14, 'Sierra Gorda', 5, NULL, NULL),
(15, 'Taltal', 5, NULL, NULL),
(16, 'Calama', 6, NULL, NULL),
(17, 'Ollague', 6, NULL, NULL),
(18, 'San Pedro de Atacama', 6, NULL, NULL),
(19, 'María Elena', 7, NULL, NULL),
(20, 'Tocopilla', 7, NULL, NULL),
(21, 'Chañaral', 8, NULL, NULL),
(22, 'Diego de Almagro', 8, NULL, NULL),
(23, 'Caldera', 9, NULL, NULL),
(24, 'Copiapó', 9, NULL, NULL),
(25, 'Tierra Amarilla', 9, NULL, NULL),
(26, 'Alto del Carmen', 10, NULL, NULL),
(27, 'Freirina', 10, NULL, NULL),
(28, 'Huasco', 10, NULL, NULL),
(29, 'Vallenar', 10, NULL, NULL),
(30, 'Canela', 11, NULL, NULL),
(31, 'Illapel', 11, NULL, NULL),
(32, 'Los Vilos', 11, NULL, NULL),
(33, 'Salamanca', 11, NULL, NULL),
(34, 'Andacollo', 12, NULL, NULL),
(35, 'Coquimbo', 12, NULL, NULL),
(36, 'La Higuera', 12, NULL, NULL),
(37, 'La Serena', 12, NULL, NULL),
(38, 'Paihuaco', 12, NULL, NULL),
(39, 'Vicuña', 12, NULL, NULL),
(40, 'Combarbalá', 13, NULL, NULL),
(41, 'Monte Patria', 13, NULL, NULL),
(42, 'Ovalle', 13, NULL, NULL),
(43, 'Punitaqui', 13, NULL, NULL),
(44, 'Río Hurtado', 13, NULL, NULL),
(45, 'Isla de Pascua', 14, NULL, NULL),
(46, 'Calle Larga', 15, NULL, NULL),
(47, 'Los Andes', 15, NULL, NULL),
(48, 'Rinconada', 15, NULL, NULL),
(49, 'San Esteban', 15, NULL, NULL),
(50, 'La Ligua', 16, NULL, NULL),
(51, 'Papudo', 16, NULL, NULL),
(52, 'Petorca', 16, NULL, NULL),
(53, 'Zapallar', 16, NULL, NULL),
(54, 'Hijuelas', 17, NULL, NULL),
(55, 'La Calera', 17, NULL, NULL),
(56, 'La Cruz', 17, NULL, NULL),
(57, 'Limache', 17, NULL, NULL),
(58, 'Nogales', 17, NULL, NULL),
(59, 'Olmué', 17, NULL, NULL),
(60, 'Quillota', 17, NULL, NULL),
(61, 'Algarrobo', 18, NULL, NULL),
(62, 'Cartagena', 18, NULL, NULL),
(63, 'El Quisco', 18, NULL, NULL),
(64, 'El Tabo', 18, NULL, NULL),
(65, 'San Antonio', 18, NULL, NULL),
(66, 'Santo Domingo', 18, NULL, NULL),
(67, 'Catemu', 19, NULL, NULL),
(68, 'Llaillay', 19, NULL, NULL),
(69, 'Panquehue', 19, NULL, NULL),
(70, 'Putaendo', 19, NULL, NULL),
(71, 'San Felipe', 19, NULL, NULL),
(72, 'Santa María', 19, NULL, NULL),
(73, 'Casablanca', 20, NULL, NULL),
(74, 'Concón', 20, NULL, NULL),
(75, 'Juan Fernández', 20, NULL, NULL),
(76, 'Puchuncaví', 20, NULL, NULL),
(77, 'Quilpué', 20, NULL, NULL),
(78, 'Quintero', 20, NULL, NULL),
(79, 'Valparaíso', 20, NULL, NULL),
(80, 'Villa Alemana', 20, NULL, NULL),
(81, 'Viña del Mar', 20, NULL, NULL),
(82, 'Colina', 21, NULL, NULL),
(83, 'Lampa', 21, NULL, NULL),
(84, 'Tiltil', 21, NULL, NULL),
(85, 'Pirque', 22, NULL, NULL),
(86, 'Puente Alto', 22, NULL, NULL),
(87, 'San José de Maipo', 22, NULL, NULL),
(88, 'Buin', 23, NULL, NULL),
(89, 'Calera de Tango', 23, NULL, NULL),
(90, 'Paine', 23, NULL, NULL),
(91, 'San Bernardo', 23, NULL, NULL),
(92, 'Alhué', 24, NULL, NULL),
(93, 'Curacaví', 24, NULL, NULL),
(94, 'María Pinto', 24, NULL, NULL),
(95, 'Melipilla', 24, NULL, NULL),
(96, 'San Pedro', 24, NULL, NULL),
(97, 'Cerrillos', 25, NULL, NULL),
(98, 'Cerro Navia', 25, NULL, NULL),
(99, 'Conchalí', 25, NULL, NULL),
(100, 'El Bosque', 25, NULL, NULL),
(101, 'Estación Central', 25, NULL, NULL),
(102, 'Huechuraba', 25, NULL, NULL),
(103, 'Independencia', 25, NULL, NULL),
(104, 'La Cisterna', 25, NULL, NULL),
(105, 'La Granja', 25, NULL, NULL),
(106, 'La Florida', 25, NULL, NULL),
(107, 'La Pintana', 25, NULL, NULL),
(108, 'La Reina', 25, NULL, NULL),
(109, 'Las Condes', 25, NULL, NULL),
(110, 'Lo Barnechea', 25, NULL, NULL),
(111, 'Lo Espejo', 25, NULL, NULL),
(112, 'Lo Prado', 25, NULL, NULL),
(113, 'Macul', 25, NULL, NULL),
(114, 'Maipú', 25, NULL, NULL),
(115, 'Ñuñoa', 25, NULL, NULL),
(116, 'Pedro Aguirre Cerda', 25, NULL, NULL),
(117, 'Peñalolén', 25, NULL, NULL),
(118, 'Providencia', 25, NULL, NULL),
(119, 'Pudahuel', 25, NULL, NULL),
(120, 'Quilicura', 25, NULL, NULL),
(121, 'Quinta Normal', 25, NULL, NULL),
(122, 'Recoleta', 25, NULL, NULL),
(123, 'Renca', 25, NULL, NULL),
(124, 'San Miguel', 25, NULL, NULL),
(125, 'San Joaquín', 25, NULL, NULL),
(126, 'San Ramón', 25, NULL, NULL),
(127, 'Santiago', 25, NULL, NULL),
(128, 'Vitacura', 25, NULL, NULL),
(129, 'El Monte', 26, NULL, NULL),
(130, 'Isla de Maipo', 26, NULL, NULL),
(131, 'Padre Hurtado', 26, NULL, NULL),
(132, 'Peñaflor', 26, NULL, NULL),
(133, 'Talagante', 26, NULL, NULL),
(134, 'Codegua', 27, NULL, NULL),
(135, 'Coínco', 27, NULL, NULL),
(136, 'Coltauco', 27, NULL, NULL),
(137, 'Doñihue', 27, NULL, NULL),
(138, 'Graneros', 27, NULL, NULL),
(139, 'Las Cabras', 27, NULL, NULL),
(140, 'Machalí', 27, NULL, NULL),
(141, 'Malloa', 27, NULL, NULL),
(142, 'Mostazal', 27, NULL, NULL),
(143, 'Olivar', 27, NULL, NULL),
(144, 'Peumo', 27, NULL, NULL),
(145, 'Pichidegua', 27, NULL, NULL),
(146, 'Quinta de Tilcoco', 27, NULL, NULL),
(147, 'Rancagua', 27, NULL, NULL),
(148, 'Rengo', 27, NULL, NULL),
(149, 'Requínoa', 27, NULL, NULL),
(150, 'San Vicente de Tagua Tagua', 27, NULL, NULL),
(151, 'La Estrella', 28, NULL, NULL),
(152, 'Litueche', 28, NULL, NULL),
(153, 'Marchihue', 28, NULL, NULL),
(154, 'Navidad', 28, NULL, NULL),
(155, 'Peredones', 28, NULL, NULL),
(156, 'Pichilemu', 28, NULL, NULL),
(157, 'Chépica', 29, NULL, NULL),
(158, 'Chimbarongo', 29, NULL, NULL),
(159, 'Lolol', 29, NULL, NULL),
(160, 'Nancagua', 29, NULL, NULL),
(161, 'Palmilla', 29, NULL, NULL),
(162, 'Peralillo', 29, NULL, NULL),
(163, 'Placilla', 29, NULL, NULL),
(164, 'Pumanque', 29, NULL, NULL),
(165, 'San Fernando', 29, NULL, NULL),
(166, 'Santa Cruz', 29, NULL, NULL),
(167, 'Cauquenes', 30, NULL, NULL),
(168, 'Chanco', 30, NULL, NULL),
(169, 'Pelluhue', 30, NULL, NULL),
(170, 'Curicó', 31, NULL, NULL),
(171, 'Hualañé', 31, NULL, NULL),
(172, 'Licantén', 31, NULL, NULL),
(173, 'Molina', 31, NULL, NULL),
(174, 'Rauco', 31, NULL, NULL),
(175, 'Romeral', 31, NULL, NULL),
(176, 'Sagrada Familia', 31, NULL, NULL),
(177, 'Teno', 31, NULL, NULL),
(178, 'Vichuquén', 31, NULL, NULL),
(179, 'Colbún', 32, NULL, NULL),
(180, 'Linares', 32, NULL, NULL),
(181, 'Longaví', 32, NULL, NULL),
(182, 'Parral', 32, NULL, NULL),
(183, 'Retiro', 32, NULL, NULL),
(184, 'San Javier', 32, NULL, NULL),
(185, 'Villa Alegre', 32, NULL, NULL),
(186, 'Yerbas Buenas', 32, NULL, NULL),
(187, 'Constitución', 33, NULL, NULL),
(188, 'Curepto', 33, NULL, NULL),
(189, 'Empedrado', 33, NULL, NULL),
(190, 'Maule', 33, NULL, NULL),
(191, 'Pelarco', 33, NULL, NULL),
(192, 'Pencahue', 33, NULL, NULL),
(193, 'Río Claro', 33, NULL, NULL),
(194, 'San Clemente', 33, NULL, NULL),
(195, 'San Rafael', 33, NULL, NULL),
(196, 'Talca', 33, NULL, NULL),
(197, 'Arauco', 34, NULL, NULL),
(198, 'Cañete', 34, NULL, NULL),
(199, 'Contulmo', 34, NULL, NULL),
(200, 'Curanilahue', 34, NULL, NULL),
(201, 'Lebu', 34, NULL, NULL),
(202, 'Los Álamos', 34, NULL, NULL),
(203, 'Tirúa', 34, NULL, NULL),
(204, 'Alto Biobío', 35, NULL, NULL),
(205, 'Antuco', 35, NULL, NULL),
(206, 'Cabrero', 35, NULL, NULL),
(207, 'Laja', 35, NULL, NULL),
(208, 'Los Ángeles', 35, NULL, NULL),
(209, 'Mulchén', 35, NULL, NULL),
(210, 'Nacimiento', 35, NULL, NULL),
(211, 'Negrete', 35, NULL, NULL),
(212, 'Quilaco', 35, NULL, NULL),
(213, 'Quilleco', 35, NULL, NULL),
(214, 'San Rosendo', 35, NULL, NULL),
(215, 'Santa Bárbara', 35, NULL, NULL),
(216, 'Tucapel', 35, NULL, NULL),
(217, 'Yumbel', 35, NULL, NULL),
(218, 'Chiguayante', 36, NULL, NULL),
(219, 'Concepción', 36, NULL, NULL),
(220, 'Coronel', 36, NULL, NULL),
(221, 'Florida', 36, NULL, NULL),
(222, 'Hualpén', 36, NULL, NULL),
(223, 'Hualqui', 36, NULL, NULL),
(224, 'Lota', 36, NULL, NULL),
(225, 'Penco', 36, NULL, NULL),
(226, 'San Pedro de La Paz', 36, NULL, NULL),
(227, 'Santa Juana', 36, NULL, NULL),
(228, 'Talcahuano', 36, NULL, NULL),
(229, 'Tomé', 36, NULL, NULL),
(230, 'Bulnes', 37, NULL, NULL),
(231, 'Chillán', 37, NULL, NULL),
(232, 'Chillán Viejo', 37, NULL, NULL),
(233, 'Cobquecura', 37, NULL, NULL),
(234, 'Coelemu', 37, NULL, NULL),
(235, 'Coihueco', 37, NULL, NULL),
(236, 'El Carmen', 37, NULL, NULL),
(237, 'Ninhue', 37, NULL, NULL),
(238, 'Ñiquen', 37, NULL, NULL),
(239, 'Pemuco', 37, NULL, NULL),
(240, 'Pinto', 37, NULL, NULL),
(241, 'Portezuelo', 37, NULL, NULL),
(242, 'Quillón', 37, NULL, NULL),
(243, 'Quirihue', 37, NULL, NULL),
(244, 'Ránquil', 37, NULL, NULL),
(245, 'San Carlos', 37, NULL, NULL),
(246, 'San Fabián', 37, NULL, NULL),
(247, 'San Ignacio', 37, NULL, NULL),
(248, 'San Nicolás', 37, NULL, NULL),
(249, 'Treguaco', 37, NULL, NULL),
(250, 'Yungay', 37, NULL, NULL),
(251, 'Carahue', 38, NULL, NULL),
(252, 'Cholchol', 38, NULL, NULL),
(253, 'Cunco', 38, NULL, NULL),
(254, 'Curarrehue', 38, NULL, NULL),
(255, 'Freire', 38, NULL, NULL),
(256, 'Galvarino', 38, NULL, NULL),
(257, 'Gorbea', 38, NULL, NULL),
(258, 'Lautaro', 38, NULL, NULL),
(259, 'Loncoche', 38, NULL, NULL),
(260, 'Melipeuco', 38, NULL, NULL),
(261, 'Nueva Imperial', 38, NULL, NULL),
(262, 'Padre Las Casas', 38, NULL, NULL),
(263, 'Perquenco', 38, NULL, NULL),
(264, 'Pitrufquén', 38, NULL, NULL),
(265, 'Pucón', 38, NULL, NULL),
(266, 'Saavedra', 38, NULL, NULL),
(267, 'Temuco', 38, NULL, NULL),
(268, 'Teodoro Schmidt', 38, NULL, NULL),
(269, 'Toltén', 38, NULL, NULL),
(270, 'Vilcún', 38, NULL, NULL),
(271, 'Villarrica', 38, NULL, NULL),
(272, 'Angol', 39, NULL, NULL),
(273, 'Collipulli', 39, NULL, NULL),
(274, 'Curacautín', 39, NULL, NULL),
(275, 'Ercilla', 39, NULL, NULL),
(276, 'Lonquimay', 39, NULL, NULL),
(277, 'Los Sauces', 39, NULL, NULL),
(278, 'Lumaco', 39, NULL, NULL),
(279, 'Purén', 39, NULL, NULL),
(280, 'Renaico', 39, NULL, NULL),
(281, 'Traiguén', 39, NULL, NULL),
(282, 'Victoria', 39, NULL, NULL),
(283, 'Corral', 40, NULL, NULL),
(284, 'Lanco', 40, NULL, NULL),
(285, 'Los Lagos', 40, NULL, NULL),
(286, 'Máfil', 40, NULL, NULL),
(287, 'Mariquina', 40, NULL, NULL),
(288, 'Paillaco', 40, NULL, NULL),
(289, 'Panguipulli', 40, NULL, NULL),
(290, 'Valdivia', 40, NULL, NULL),
(291, 'Futrono', 41, NULL, NULL),
(292, 'La Unión', 41, NULL, NULL),
(293, 'Lago Ranco', 41, NULL, NULL),
(294, 'Río Bueno', 41, NULL, NULL),
(295, 'Ancud', 42, NULL, NULL),
(296, 'Castro', 42, NULL, NULL),
(297, 'Chonchi', 42, NULL, NULL),
(298, 'Curaco de Vélez', 42, NULL, NULL),
(299, 'Dalcahue', 42, NULL, NULL),
(300, 'Puqueldón', 42, NULL, NULL),
(301, 'Queilén', 42, NULL, NULL),
(302, 'Quemchi', 42, NULL, NULL),
(303, 'Quellón', 42, NULL, NULL),
(304, 'Quinchao', 42, NULL, NULL),
(305, 'Calbuco', 43, NULL, NULL),
(306, 'Cochamó', 43, NULL, NULL),
(307, 'Fresia', 43, NULL, NULL),
(308, 'Frutillar', 43, NULL, NULL),
(309, 'Llanquihue', 43, NULL, NULL),
(310, 'Los Muermos', 43, NULL, NULL),
(311, 'Maullín', 43, NULL, NULL),
(312, 'Puerto Montt', 43, NULL, NULL),
(313, 'Puerto Varas', 43, NULL, NULL),
(314, 'Osorno', 44, NULL, NULL),
(315, 'Puero Octay', 44, NULL, NULL),
(316, 'Purranque', 44, NULL, NULL),
(317, 'Puyehue', 44, NULL, NULL),
(318, 'Río Negro', 44, NULL, NULL),
(319, 'San Juan de la Costa', 44, NULL, NULL),
(320, 'San Pablo', 44, NULL, NULL),
(321, 'Chaitén', 45, NULL, NULL),
(322, 'Futaleufú', 45, NULL, NULL),
(323, 'Hualaihué', 45, NULL, NULL),
(324, 'Palena', 45, NULL, NULL),
(325, 'Aisén', 46, NULL, NULL),
(326, 'Cisnes', 46, NULL, NULL),
(327, 'Guaitecas', 46, NULL, NULL),
(328, 'Cochrane', 47, NULL, NULL),
(329, 'O\'higgins', 47, NULL, NULL),
(330, 'Tortel', 47, NULL, NULL),
(331, 'Coihaique', 48, NULL, NULL),
(332, 'Lago Verde', 48, NULL, NULL),
(333, 'Chile Chico', 49, NULL, NULL),
(334, 'Río Ibáñez', 49, NULL, NULL),
(335, 'Antártica', 50, NULL, NULL),
(336, 'Cabo de Hornos', 50, NULL, NULL),
(337, 'Laguna Blanca', 51, NULL, NULL),
(338, 'Punta Arenas', 51, NULL, NULL),
(339, 'Río Verde', 51, NULL, NULL),
(340, 'San Gregorio', 51, NULL, NULL),
(341, 'Porvenir', 52, NULL, NULL),
(342, 'Primavera', 52, NULL, NULL),
(343, 'Timaukel', 52, NULL, NULL),
(344, 'Natales', 53, NULL, NULL),
(345, 'Torres del Paine', 53, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cuentas`
--

INSERT INTO `cuentas` (`id`, `codigo`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, '410304', 'Cuenta', 'Cuenta', 1, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, '222', 'prueba2', 'aaaa', 0, '2018-11-06 15:56:53', '2018-11-06 16:02:44'),
(3, 'aaaaa', 'asdsad', 'asdasdsa', 0, '2018-11-06 16:05:50', '2018-11-06 16:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `exento` tinyint(1) DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`id`, `codigo`, `nombre`, `descripcion`, `exento`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'BOL', 'BOLETA', 'Boleta Simple', 0, 1, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, 'TAT', 'PRUEBA2', '12', NULL, 0, '2018-11-06 18:30:21', '2018-11-06 18:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `establecimientos`
--

CREATE TABLE `establecimientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rbd` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razonSocial` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rut` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idTipoDependencia` int(10) UNSIGNED NOT NULL,
  `idSostenedor` int(10) UNSIGNED NOT NULL,
  `idComuna` int(10) UNSIGNED NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `fono` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insignia` longtext COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `establecimientos`
--

INSERT INTO `establecimientos` (`id`, `nombre`, `rbd`, `razonSocial`, `rut`, `idTipoDependencia`, `idSostenedor`, `idComuna`, `direccion`, `fono`, `correo`, `insignia`, `estado`, `created_at`, `updated_at`) VALUES
(2, 'Colegio Los Heroes', '16569', 'Corporacion Educacional Un nimo un sueno de sarmiento', '651478413', 1, 1, 10, 'Av. Arturo Prat 256, Sarmiento', '975307317', 'correo@prueba.cl', NULL, 1, '2018-10-23 17:57:48', '2018-10-23 17:57:48'),
(3, 'Los Heroes', '16569', 'Corporacion Educacional Un nimo un sueno de sarmiento', '782354413', 2, 4, 13, 'Av. Arturo Prat 256, Sarmiento', '975307317', 'correo@prueba.cl', NULL, 1, '2018-10-23 17:59:12', '2018-10-23 17:59:12'),
(4, 'Establecimiento Prueba', '2222', 'Establecimiento Prueba', '3333333', 2, 2, 17, 'Establecimiento Prueba', '121231321', 'prueba@gmail.com', NULL, 0, '2018-11-05 19:42:43', '2018-11-05 20:01:56'),
(5, 'prueba', '3333333', 'aaaaaaa', '13121', 1, 1, 1, 'adsad', '654564', 'aaaa@gmail.com', NULL, 0, '2018-11-05 21:08:35', '2018-11-05 21:08:35'),
(6, '313132132123asdsad', '321321321', 'asdsadsa', '132132', 1, 1, 1, 'asd', '54165', 'aaaa@gmail.com', NULL, 0, '2018-11-05 21:09:49', '2018-11-05 21:09:49'),
(7, 'as6d4a6sd465as4d6', '1313212123', '65sa4d65a4sd654', '13213131321', 1, 1, 1, 'asdsasdad', 'asdsadad', 'a.ugarte.zk@gmail.com', NULL, 0, '2018-11-05 21:11:27', '2018-11-05 21:11:27');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `idEstablecimiento` int(10) UNSIGNED NOT NULL,
  `rut` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoPaterno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoMaterno` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idTipoContrato` int(10) UNSIGNED NOT NULL,
  `horasCtoSemanal` int(11) DEFAULT NULL,
  `fechaInicioContrato` date DEFAULT NULL,
  `fechaTerminoContrato` date DEFAULT NULL,
  `idFuncion` int(10) UNSIGNED NOT NULL,
  `ufIsapre` double(5,4) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `idEstablecimiento`, `rut`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `idTipoContrato`, `horasCtoSemanal`, `fechaInicioContrato`, `fechaTerminoContrato`, `idFuncion`, `ufIsapre`, `estado`, `created_at`, `updated_at`) VALUES
(3, 2, '33.333.333-3', 'Prueba', 'Prueba', 'Prueba', 1, 23, '2017-11-08', '2018-12-06', 1, 3.4000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `funcions`
--

CREATE TABLE `funcions` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funcions`
--

INSERT INTO `funcions` (`id`, `codigo`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DIR', 'Director', 'Director Colegio', 1, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, 'TAT2', 'PRUEBA2', NULL, 0, '2018-11-06 18:44:05', '2018-11-06 18:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `imputacions`
--

CREATE TABLE `imputacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `idEstablecimiento` int(10) UNSIGNED NOT NULL,
  `idSubvencion` int(10) UNSIGNED NOT NULL,
  `idCuenta` int(10) UNSIGNED NOT NULL,
  `idTipoDocumento` int(10) UNSIGNED NOT NULL,
  `numDocumento` int(11) DEFAULT NULL,
  `fechaDocumento` date DEFAULT NULL,
  `fechaPago` date DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `idProveedor` int(10) UNSIGNED NOT NULL,
  `montoGasto` int(11) DEFAULT NULL,
  `montoDocumento` int(11) DEFAULT NULL,
  `documento` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leys`
--

CREATE TABLE `leys` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idSubvencion` int(10) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `tipo` enum('Haber','Descuento') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Haber - Descuento',
  `imponible` tinyint(1) DEFAULT '0',
  `sueldoBase` tinyint(1) DEFAULT '0',
  `afp` tinyint(1) DEFAULT '0',
  `salud` tinyint(1) DEFAULT '0',
  `adicionalSalud` tinyint(1) DEFAULT '0',
  `porcMax` int(11) DEFAULT '0',
  `tope` int(11) DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leys`
--

INSERT INTO `leys` (`id`, `codigo`, `nombre`, `idSubvencion`, `descripcion`, `tipo`, `imponible`, `sueldoBase`, `afp`, `salud`, `adicionalSalud`, `porcMax`, `tope`, `estado`, `created_at`, `updated_at`) VALUES
(2, 'TOTALHABER', 'Total Haberes', 1, 'Prueba', 'Haber', 1, 2, 0, 0, 0, 90, 0, 1, NULL, NULL),
(3, NULL, 'PRUEBA', 7, 'ASAS123132', 'Haber', 1, NULL, NULL, NULL, NULL, 34, 3333, 0, '2018-11-06 01:11:47', '2018-11-06 01:11:47'),
(4, NULL, 'prueba4', 1, 'prueba4', 'Haber', NULL, 1, 1, NULL, NULL, 214, 123, 0, '2018-11-06 01:21:46', '2018-11-06 01:21:46'),
(5, 'prueba6', 'prueba5', 1, 'prueba5', 'Haber', 1, 1, 1, NULL, NULL, NULL, 2343, 1, '2018-11-06 01:22:38', '2018-11-06 14:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `liquidacions`
--

CREATE TABLE `liquidacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `idEstablecimiento` int(10) UNSIGNED NOT NULL,
  `idFuncionario` int(10) UNSIGNED NOT NULL,
  `idPeriodo` int(10) UNSIGNED NOT NULL,
  `fechaLiquidacion` date DEFAULT NULL,
  `diasTrabajados` int(11) DEFAULT NULL,
  `horasContratoSep` int(11) DEFAULT NULL,
  `fechaInicioContratoSep` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(734, '2014_10_12_000000_create_users_table', 1),
(735, '2014_10_12_100000_create_password_resets_table', 1),
(736, '2015_01_20_084450_create_roles_table', 1),
(737, '2015_01_20_084525_create_role_user_table', 1),
(738, '2015_01_24_080208_create_permissions_table', 1),
(739, '2015_01_24_080433_create_permission_role_table', 1),
(740, '2015_12_04_003040_add_special_role_column', 1),
(741, '2017_10_17_170735_create_permission_user_table', 1),
(742, '2018_10_12_100001_create_regiones_table', 1),
(743, '2018_10_12_100002_create_provincias_table', 1),
(744, '2018_10_12_100003_create_comunas_table', 1),
(745, '2018_10_12_100005_create_tipo_dependencia_table', 1),
(746, '2018_10_12_100006_create_periodos_table', 1),
(747, '2018_10_12_100007_create_anos_table', 1),
(748, '2018_10_12_100007_create_tipo_contrato_table', 1),
(749, '2018_10_12_100008_create_afp_table', 1),
(750, '2018_10_12_100009_create_salud_table', 1),
(751, '2018_10_12_205200_create_sostenedors_table', 1),
(752, '2018_10_12_205535_create_establecimientos_table', 1),
(753, '2018_10_12_205558_create_subvencions_table', 1),
(754, '2018_10_12_205620_create_leys_table', 1),
(755, '2018_10_12_205706_create_carga_mensuals_table', 1),
(756, '2018_10_12_205727_create_calculo_horas_table', 1),
(757, '2018_10_12_205744_create_cuentas_table', 1),
(758, '2018_10_12_205800_create_proveedors_table', 1),
(759, '2018_10_12_205821_create_documentos_table', 1),
(760, '2018_10_12_205835_create_funcions_table', 1),
(761, '2018_10_12_205846_create_funcionarios_table', 1),
(762, '2018_10_12_205906_create_imputacions_table', 1),
(763, '2018_10_12_205929_create_reporte_gastos_table', 1),
(764, '2018_10_12_205944_create_liquidacions_table', 1),
(765, '2018_10_12_210119_create_reporte_rrhhs_table', 1),
(767, '2018_10_19_174247_add_foreing_key_periodos_id_ano', 2),
(773, '2018_10_19_183007_add_foreing_key_s_carga_mensual', 3),
(774, '2018_10_19_183913_add_foreing_key_s_sostenedors_id_comuna', 3),
(775, '2018_10_19_215501_add_column_users_sostenedor', 3),
(776, '2018_10_23_135800_add_foreing_keys_establecimientos', 4),
(777, '2018_10_23_174141_add_foreing_key_leyes', 5),
(778, '2018_10_23_181851_add_foreing_key_proveedores', 6),
(779, '2018_10_23_182357_add_foreing_key_funcionarios', 7),
(780, '2018_10_23_183419_add_foreing_key_imputaciones', 8),
(781, '2018_10_23_184302_add_foreing_key_liquidacion', 9),
(782, '2018_11_05_150725_delet_column_from_establecimientos', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periodos`
--

CREATE TABLE `periodos` (
  `id` int(10) UNSIGNED NOT NULL,
  `idAno` int(10) UNSIGNED NOT NULL,
  `periodo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periodos`
--

INSERT INTO `periodos` (`id`, `idAno`, `periodo`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '01-2018', 1, NULL, NULL),
(2, 1, '02-2018\r\n', 1, NULL, NULL),
(3, 1, '03-2018', 1, NULL, NULL),
(4, 1, '04-2018', 1, NULL, NULL),
(5, 1, '05-2018', 1, NULL, NULL),
(6, 1, '06-2018', 1, NULL, NULL),
(7, 1, '07-2018', 1, NULL, NULL),
(8, 1, '08-2018', 1, NULL, NULL),
(9, 1, '09-2018', 1, NULL, NULL),
(10, 1, '10-2018', 1, NULL, NULL),
(11, 1, '11-2018', 1, NULL, NULL),
(12, 1, '12-2018', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Listar usuarios', 'users.index', 'Lista y navega todos los usuarios del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, 'Crear usuarios', 'users.create', 'Crear usuarios en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(3, 'Ver detalle usuarios', 'users.show', 'ver en detalle cada usuario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(4, 'Editar usuarios', 'users.edit', 'Editar cualquier usuario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(5, 'Eliminar usuarios', 'users.destroy', 'Eliminar cualquier usuario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(6, 'Listar roles', 'roles.index', 'Lista y navega todos los roles del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(7, 'Crear roles', 'roles.create', 'Crear roles en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(8, 'Ver detalle roles', 'roles.show', 'ver en detalle cada rol del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(9, 'Editar roles', 'roles.edit', 'Editar cualquier rol del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(10, 'Eliminar roles', 'roles.destroy', 'Eliminar cualquier rol del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(11, 'Listar sostenedores', 'sostenedores.index', 'Lista y navega todos los sostenedores del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(12, 'Crear sostenedores', 'sostenedores.create', 'Crear sostenedores en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(13, 'Ver detalle sostenedores', 'sostenedores.show', 'ver en detalle cada sostenedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(14, 'Editar sostenedores', 'sostenedores.edit', 'Editar cualquier sostenedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(15, 'Eliminar sostenedores', 'sostenedores.destroy', 'Eliminar cualquier sostenedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(16, 'Listar establecimientos', 'establecimientos.index', 'Lista y navega todos los establecimientos del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(17, 'Crear establecimientos', 'establecimientos.create', 'Crear establecimientos en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(18, 'Ver detalle establecimientos', 'establecimientos.show', 'ver en detalle cada establecimiento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(19, 'Editar establecimientos', 'establecimientos.edit', 'Editar cualquier establecimiento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(20, 'Eliminar establecimientos', 'establecimientos.destroy', 'Eliminar cualquier establecimiento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(21, 'Listar subvenciones', 'subvenciones.index', 'Lista y navega todas las subvenciones del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(22, 'Crear subvenciones', 'subvenciones.create', 'Crear subvenciones en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(23, 'Ver detalle subvenciones', 'subvenciones.show', 'ver en detalle cada subvencion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(24, 'Editar subvenciones', 'subvenciones.edit', 'Editar cualquier subvencion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(25, 'Eliminar subvenciones', 'subvenciones.destroy', 'Eliminar cualquier subvencion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(26, 'Listar leyes', 'leyes.index', 'Lista y navega todas las leyes del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(27, 'Crear leyes', 'leyes.create', 'Crear leyes en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(28, 'Ver detalle leyes', 'leyes.show', 'ver en detalle cada ley del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(29, 'Editar leyes', 'leyes.edit', 'Editar cualquier ley del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(30, 'Eliminar leyes', 'leyes.destroy', 'Eliminar cualquier ley del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(31, 'Listar carga mensual', 'cargamensual.index', 'Lista y navega todas las cargas mensuales del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(32, 'Crear carga mensual', 'cargamensual.create', 'Crear carga mensual en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(33, 'Ver detalle carga mensual', 'cargamensual.show', 'ver en detalle cada carga mensual del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(34, 'Editar carga mensual', 'cargamensual.edit', 'Editar cualquier carga mensual del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(35, 'Eliminar carga mensual', 'cargamensual.destroy', 'Eliminar cualquier carga mensual del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(36, 'Listar calculo hora', 'calculohoras.index', 'Lista y navega todos los calculos de horas del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(37, 'Crear calculo hora', 'calculohoras.create', 'Crear calculo hora en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(38, 'Ver detalle calculo hora', 'calculohoras.show', 'ver en detalle cada calculo hora del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(39, 'Editar calculo hora', 'calculohoras.edit', 'Editar cualquier calculo hora del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(40, 'Eliminar calculo hora', 'calculohoras.destroy', 'Eliminar cualquier calculo hora del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(41, 'Listar cuentas', 'cuentas.index', 'Lista y navega todas las cuentas del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(42, 'Crear cuentas', 'cuentas.create', 'Crear cuentas en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(43, 'Ver detalle cuentas', 'cuentas.show', 'ver en detalle cada cuenta del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(44, 'Editar cuentas', 'cuentas.edit', 'Editar cualquier cuenta del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(45, 'Eliminar cuentas', 'cuentas.destroy', 'Eliminar cualquier cuenta del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(46, 'Listar proveedores', 'proveedores.index', 'Lista y navega todos los proveedores del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(47, 'Crear proveedores', 'proveedores.create', 'Crear proveedores en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(48, 'Ver detalle proveedores', 'proveedores.show', 'ver en detalle cada proveedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(49, 'Editar proveedores', 'proveedores.edit', 'Editar cualquier proveedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(50, 'Eliminar proveedores', 'proveedores.destroy', 'Eliminar cualquier proveedor del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(51, 'Listar documentos', 'documentos.index', 'Lista y navega todos los documentos del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(52, 'Crear documentos', 'documentos.create', 'Crear documentos en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(53, 'Ver detalle documentos', 'documentos.show', 'ver en detalle cada documento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(54, 'Editar documentos', 'documentos.edit', 'Editar cualquier documento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(55, 'Eliminar documentos', 'documentos.destroy', 'Eliminar cualquier documento del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(56, 'Listar funciones', 'funciones.index', 'Lista y navega todas las funciones del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(57, 'Crear funciones', 'funciones.create', 'Crear funciones en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(58, 'Ver detalle funciones', 'funciones.show', 'ver en detalle cada funcion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(59, 'Editar funciones', 'funciones.edit', 'Editar cualquier funcion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(60, 'Eliminar funciones', 'funciones.destroy', 'Eliminar cualquier funcion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(61, 'Listar funcionarios', 'funcionarios.index', 'Lista y navega todos los funcionarios del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(62, 'Crear funcionarios', 'funcionarios.create', 'Crear funcionarios en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(63, 'Ver detalle funcionarios', 'funcionarios.show', 'ver en detalle cada funcionario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(64, 'Editar funcionarios', 'funcionarios.edit', 'Editar cualquier funcionario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(65, 'Eliminar funcionarios', 'funcionarios.destroy', 'Eliminar cualquier funcionario del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(66, 'Listar imputaciones', 'imputaciones.index', 'Lista y navega todas las imputaciones del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(67, 'Crear imputaciones', 'imputaciones.create', 'Crear imputaciones en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(68, 'Ver detalle imputaciones', 'imputaciones.show', 'ver en detalle cada imputacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(69, 'Editar imputaciones', 'imputaciones.edit', 'Editar cualquier imputacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(70, 'Eliminar imputaciones', 'imputaciones.destroy', 'Eliminar cualquier imputacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(71, 'Listar reportes', 'reportesgastos.index', 'Lista y navega todos los reportes del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(72, 'Crear reportes', 'reportesgastos.create', 'Crear reportes en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(73, 'Ver detalle reportes', 'reportesgastos.show', 'ver en detalle cada reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(74, 'Editar reportes', 'reportesgastos.edit', 'Editar cualquier reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(75, 'Eliminar reportes', 'reportesgastos.destroy', 'Eliminar cualquier reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(76, 'Listar liquidaciones', 'liquidaciones.index', 'Lista y navega todos los liquidaciones del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(77, 'Crear liquidaciones', 'liquidaciones.create', 'Crear liquidaciones en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(78, 'Ver detalle liquidaciones', 'liquidaciones.show', 'ver en detalle cada liquidacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(79, 'Editar liquidaciones', 'liquidaciones.edit', 'Editar cualquier liquidacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(80, 'Eliminar liquidaciones', 'liquidaciones.destroy', 'Eliminar cualquier liquidacion del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(81, 'Listar reportes', 'reportesrrhh.index', 'Lista y navega todos los reportes del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(82, 'Crear reportes', 'reportesrrhh.create', 'Crear reportes en el sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(83, 'Ver detalle reportes', 'reportesrrhh.show', 'ver en detalle cada reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(84, 'Editar reportes', 'reportesrrhh.edit', 'Editar cualquier reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(85, 'Eliminar reportes', 'reportesrrhh.destroy', 'Eliminar cualquier reporte del sistema', '2018-10-19 02:33:31', '2018-10-19 02:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proveedors`
--

CREATE TABLE `proveedors` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoPersona` enum('Persona Jurídica','Persona Natural') CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Jurídica - Natural',
  `rut` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razonSocial` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `giro` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idComuna` int(10) UNSIGNED NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `fono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proveedors`
--

INSERT INTO `proveedors` (`id`, `codigo`, `tipoPersona`, `rut`, `razonSocial`, `giro`, `idComuna`, `direccion`, `fono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Persona Jurídica', '179932261', 'Alonso Ugarte Álvarez', 'PRUEBA', 11, 'Psje Marta #784 Santiago Centro', '1111111', 'a.ugarte.zk@gmail.com', 1, '2018-11-06 16:53:31', '2018-11-06 18:14:38'),
(2, NULL, 'Persona Natural', '11111111', 'prueba2', 'aaaaaaaaaa', 3, 'aaa', '1231321', 'aaaa@gmail.com', 0, '2018-11-06 16:54:28', '2018-11-06 17:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRegion` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `idRegion`, `created_at`, `updated_at`) VALUES
(1, 'Arica', 1, NULL, NULL),
(2, 'Parinacota', 1, NULL, NULL),
(3, 'Iquique', 2, NULL, NULL),
(4, 'El Tamarugal', 2, NULL, NULL),
(5, 'Antofagasta', 3, NULL, NULL),
(6, 'El Loa', 3, NULL, NULL),
(7, 'Tocopilla', 3, NULL, NULL),
(8, 'Chañaral', 4, NULL, NULL),
(9, 'Copiapó', 4, NULL, NULL),
(10, 'Huasco', 4, NULL, NULL),
(11, 'Choapa', 5, NULL, NULL),
(12, 'Elqui', 5, NULL, NULL),
(13, 'Limarí', 5, NULL, NULL),
(14, 'Isla de Pascua', 6, NULL, NULL),
(15, 'Los Andes', 6, NULL, NULL),
(16, 'Petorca', 6, NULL, NULL),
(17, 'Quillota', 6, NULL, NULL),
(18, 'San Antonio', 6, NULL, NULL),
(19, 'San Felipe de Aconcagua', 6, NULL, NULL),
(20, 'Valparaiso', 6, NULL, NULL),
(21, 'Chacabuco', 7, NULL, NULL),
(22, 'Cordillera', 7, NULL, NULL),
(23, 'Maipo', 7, NULL, NULL),
(24, 'Melipilla', 7, NULL, NULL),
(25, 'Santiago', 7, NULL, NULL),
(26, 'Talagante', 7, NULL, NULL),
(27, 'Cachapoal', 8, NULL, NULL),
(28, 'Cardenal Caro', 8, NULL, NULL),
(29, 'Colchagua', 8, NULL, NULL),
(30, 'Cauquenes', 9, NULL, NULL),
(31, 'Curicó', 9, NULL, NULL),
(32, 'Linares', 9, NULL, NULL),
(33, 'Talca', 9, NULL, NULL),
(34, 'Arauco', 10, NULL, NULL),
(35, 'Bio Bío', 10, NULL, NULL),
(36, 'Concepción', 10, NULL, NULL),
(37, 'Ñuble', 10, NULL, NULL),
(38, 'Cautín', 11, NULL, NULL),
(39, 'Malleco', 11, NULL, NULL),
(40, 'Valdivia', 12, NULL, NULL),
(41, 'Ranco', 12, NULL, NULL),
(42, 'Chiloé', 13, NULL, NULL),
(43, 'Llanquihue', 13, NULL, NULL),
(44, 'Osorno', 13, NULL, NULL),
(45, 'Palena', 13, NULL, NULL),
(46, 'Aisén', 14, NULL, NULL),
(47, 'Capitán Prat', 14, NULL, NULL),
(48, 'Coihaique', 14, NULL, NULL),
(49, 'General Carrera', 14, NULL, NULL),
(50, 'Antártica Chilena', 15, NULL, NULL),
(51, 'Magallanes', 15, NULL, NULL),
(52, 'Tierra del Fuego', 15, NULL, NULL),
(53, 'Última Esperanza', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regiones`
--

CREATE TABLE `regiones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abreviacion` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regiones`
--

INSERT INTO `regiones` (`id`, `nombre`, `abreviacion`, `created_at`, `updated_at`) VALUES
(1, 'Arica y Parinacota', 'XV', NULL, NULL),
(2, 'Tarapacá', 'I', NULL, NULL),
(3, 'Antofagasta', 'II', NULL, NULL),
(4, 'Atacama', 'III', NULL, NULL),
(5, 'Coquimbo', 'IV', NULL, NULL),
(6, 'Valparaiso', 'V', NULL, NULL),
(7, 'Metropolitana de Santiago', 'RM', NULL, NULL),
(8, 'Libertador General Bernardo O\'Higgins', 'VI', NULL, NULL),
(9, 'Maule', 'VII', NULL, NULL),
(10, 'Biobío', 'VIII', NULL, NULL),
(11, 'La Araucanía', 'IX', NULL, NULL),
(12, 'Los Ríos', 'XIV', NULL, NULL),
(13, 'Los Lagos', 'X', NULL, NULL),
(14, 'Aisén del General Carlos Ibáñez del Campo', 'XI', NULL, NULL),
(15, 'Magallanes y de la Antártica Chilena', 'XII', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reporte_gastos`
--

CREATE TABLE `reporte_gastos` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reporte_rrhhs`
--

CREATE TABLE `reporte_rrhhs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `special`) VALUES
(1, 'Admin', 'admin', NULL, '2018-10-19 02:33:31', '2018-10-19 02:33:31', 'all-access');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salud`
--

CREATE TABLE `salud` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sostenedors`
--

CREATE TABLE `sostenedors` (
  `id` int(10) UNSIGNED NOT NULL,
  `rut` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoPaterno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoMaterno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idComuna` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `fono` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sostenedors`
--

INSERT INTO `sostenedors` (`id`, `rut`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `idComuna`, `direccion`, `fono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, '8', 'Chance Fritsch DDS', 'Apellido Paterno', 'Apellido Materno', 1, '31747 Eve View\nNorth Arjunbury, AZ 77208', '9', 'fboehm@example.net', 1, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, '9', 'Schuyler Nolan', 'Apellido Paterno', 'Apellido Materno', 1, '483 McClure Rapids\nSouth Hayden, IN 69330', '9', 'dare.gianni@example.com', 0, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(3, '9', 'Ted Corwin', 'Apellido Paterno', 'Apellido Materno', 1, '401 Okuneva Port\nRunolfsdottirview, KY 18362', '8', 'xcartwright@example.net', 0, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(4, '9', 'Kathlyn Gerhold super8', 'Apellido Paterno', 'Apellido Materno', 1, '43121 Naomi Ramp Apt. 102South Berniecemouth, OR 91912-2818', '8', 'ceasar42@example.org', 1, '2018-10-19 02:33:31', '2018-11-03 01:17:34'),
(5, '8', 'Rosella Grimes', 'Apellido Paterno', 'Apellido Materno', 1, '36580 Melisa MountainsBechtelarside, VT 65510-8624', '8', 'friesen.leanne@AAAXXXXX.org', 1, '2018-10-19 02:33:31', '2018-11-04 18:18:48'),
(6, '179932261', 'Alonso', 'Álvarez', 'Ugarte', 1, 'Psje Marta #784 Santiago Centro', '9582464654', 'a.ugarte.zk@gmail.com', 1, '2018-11-05 15:45:07', '2018-11-05 16:50:31'),
(7, '179932268', 'Alonso', 'Álvarez', 'Ugarte', 1, 'Psje Marta #784 Santiago Centro', NULL, NULL, 0, '2018-11-05 16:49:33', '2018-11-05 16:49:33'),
(8, '435435435', 'Prueba', 'Prueba', 'Prueba', 4, 'Prueba', '888888888', 'prueba@gmail.com', 1, '2018-11-05 16:51:48', '2018-11-05 20:09:36'),
(9, '222222222', 'sdfdsfs', 'sdfdsfdsfs', 'fsdfdsfdsf', 16, 'asdsadas', NULL, 'a.ugarte.zk@gmail.com', 0, '2018-11-05 17:41:14', '2018-11-05 17:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `subvencions`
--

CREATE TABLE `subvencions` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `valorHora` int(11) NOT NULL DEFAULT '0',
  `porcentajeMax` int(11) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subvencions`
--

INSERT INTO `subvencions` (`id`, `codigo`, `nombre`, `descripcion`, `valorHora`, `porcentajeMax`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'NOSUB', 'GENERAL', '1', 6500, 80, 1, '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, NULL, 'Subvención de Prueba', 'Prueba', 50, 0, 0, '2018-11-05 22:08:54', '2018-11-05 22:08:54'),
(3, NULL, 'Subven', '4a6sd4as6d', 1, 0, 0, '2018-11-05 22:10:03', '2018-11-05 22:10:03'),
(4, NULL, 'asdasd', NULL, 0, 0, 0, '2018-11-05 22:15:51', '2018-11-05 22:15:51'),
(5, NULL, 'aaaaaaaaaaaa', NULL, 0, 2, 0, '2018-11-05 22:16:47', '2018-11-05 22:32:05'),
(6, NULL, 'Alonso Ugarte', NULL, 0, 0, 0, '2018-11-05 22:20:04', '2018-11-05 22:20:04'),
(7, NULL, 'APV', 'prueba', 0, 22, 1, '2018-11-05 22:22:27', '2018-11-05 22:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_contrato`
--

CREATE TABLE `tipo_contrato` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoContrato` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipo_contrato`
--

INSERT INTO `tipo_contrato` (`id`, `codigo`, `tipoContrato`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'CI', 'Contrato Indefinido', 1, NULL, NULL),
(2, 'CPF', 'Contrato Plazo Fijo', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_dependencia`
--

CREATE TABLE `tipo_dependencia` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipo_dependencia`
--

INSERT INTO `tipo_dependencia` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Municipal', 1, NULL, NULL),
(2, 'Particular', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `sostenedor` tinyint(1) DEFAULT '0',
  `rut` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoPaterno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidoMaterno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(700) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 .- Inactivo - 1 .- Activo',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sostenedor`, `rut`, `name`, `apellidoPaterno`, `apellidoMaterno`, `direccion`, `email`, `password`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, '8354136', 'Twila Vandervort DVM', 'Apellido Paterno', 'Apellido Materno', '97607 Alf Hill\nLake Kamren, AK 91337-1701', 'rosalee13@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 1, 'ovkC0GlEci', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(2, 0, '15330311', 'Teresa Hauck', 'Apellido Paterno', 'Apellido Materno', '25648 Dasia Squares\nPort Faustoview, KY 10633-0240', 'barbara.skiles@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 1, '1AW5BDZoof', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(3, 0, '16962604', 'Joshuah Murazik PhD', 'Apellido Paterno', 'Apellido Materno', '97408 Althea River\nNannieport, MD 63515', 'oweber@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 1, 'W9m6E5DWO8', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(4, 0, '10197230', 'Kaitlin Gerhold', 'Apellido Paterno', 'Apellido Materno', '4906 Cassandre Vista Apt. 907\nSouth Kaley, ID 91902-1966', 'ankunding.madeline@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 1, 'QT4Vne6wVM', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(5, 0, '12578933', 'Prof. Rosalia Mills', 'Apellido Paterno', 'Apellido Materno', '6354 Kuvalis Port\nEast Frederick, OK 95745', 'jermey68@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 1, '9ilz33RkFu', '2018-10-19 02:33:31', '2018-10-19 02:33:31'),
(6, 0, '179932261', 'Alonso', 'Ugarte', 'Álvarez', 'Prueba', 'a.ugarte.zk@gmail.com', '$2y$10$HeitokuTUWmIx9PGp3hEWeoAlbB2StPyg05fjSe/TB11P6NAShTnS', 1, NULL, '2018-10-19 23:12:49', '2018-10-19 23:12:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `afp`
--
ALTER TABLE `afp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anos`
--
ALTER TABLE `anos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calculo_horas`
--
ALTER TABLE `calculo_horas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carga_mensuals`
--
ALTER TABLE `carga_mensuals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carga_mensuals_idperiodo_foreign` (`idPeriodo`),
  ADD KEY `carga_mensuals_idestablecimiento_foreign` (`idEstablecimiento`);

--
-- Indexes for table `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunas_idprovincia_foreign` (`idProvincia`);

--
-- Indexes for table `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `establecimientos`
--
ALTER TABLE `establecimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `establecimientos_idtipodependencia_foreign` (`idTipoDependencia`),
  ADD KEY `establecimientos_idsostenedor_foreign` (`idSostenedor`),
  ADD KEY `establecimientos_idcomuna_foreign` (`idComuna`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionarios_idestablecimiento_foreign` (`idEstablecimiento`),
  ADD KEY `funcionarios_idtipocontrato_foreign` (`idTipoContrato`),
  ADD KEY `funcionarios_idfuncion_foreign` (`idFuncion`);

--
-- Indexes for table `funcions`
--
ALTER TABLE `funcions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imputacions`
--
ALTER TABLE `imputacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imputacions_idestablecimiento_foreign` (`idEstablecimiento`),
  ADD KEY `imputacions_idsubvencion_foreign` (`idSubvencion`),
  ADD KEY `imputacions_idcuenta_foreign` (`idCuenta`),
  ADD KEY `imputacions_idtipodocumento_foreign` (`idTipoDocumento`),
  ADD KEY `imputacions_idproveedor_foreign` (`idProveedor`);

--
-- Indexes for table `leys`
--
ALTER TABLE `leys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leys_idsubvencion_foreign` (`idSubvencion`);

--
-- Indexes for table `liquidacions`
--
ALTER TABLE `liquidacions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `liquidacions_idestablecimiento_foreign` (`idEstablecimiento`),
  ADD KEY `liquidacions_idfuncionario_foreign` (`idFuncionario`),
  ADD KEY `liquidacions_idperiodo_foreign` (`idPeriodo`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periodos_idano_foreign` (`idAno`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_permission_id_index` (`permission_id`),
  ADD KEY `permission_user_user_id_index` (`user_id`);

--
-- Indexes for table `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedors_idcomuna_foreign` (`idComuna`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provincias_idregion_foreign` (`idRegion`);

--
-- Indexes for table `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporte_gastos`
--
ALTER TABLE `reporte_gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporte_rrhhs`
--
ALTER TABLE `reporte_rrhhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `salud`
--
ALTER TABLE `salud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sostenedors`
--
ALTER TABLE `sostenedors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sostenedors_idcomuna_foreign` (`idComuna`);

--
-- Indexes for table `subvencions`
--
ALTER TABLE `subvencions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_dependencia`
--
ALTER TABLE `tipo_dependencia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_rut_unique` (`rut`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `afp`
--
ALTER TABLE `afp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anos`
--
ALTER TABLE `anos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `calculo_horas`
--
ALTER TABLE `calculo_horas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carga_mensuals`
--
ALTER TABLE `carga_mensuals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;
--
-- AUTO_INCREMENT for table `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `establecimientos`
--
ALTER TABLE `establecimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `funcions`
--
ALTER TABLE `funcions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `imputacions`
--
ALTER TABLE `imputacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leys`
--
ALTER TABLE `leys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `liquidacions`
--
ALTER TABLE `liquidacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=783;
--
-- AUTO_INCREMENT for table `periodos`
--
ALTER TABLE `periodos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reporte_gastos`
--
ALTER TABLE `reporte_gastos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reporte_rrhhs`
--
ALTER TABLE `reporte_rrhhs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `salud`
--
ALTER TABLE `salud`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sostenedors`
--
ALTER TABLE `sostenedors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `subvencions`
--
ALTER TABLE `subvencions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tipo_contrato`
--
ALTER TABLE `tipo_contrato`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo_dependencia`
--
ALTER TABLE `tipo_dependencia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carga_mensuals`
--
ALTER TABLE `carga_mensuals`
  ADD CONSTRAINT `carga_mensuals_idestablecimiento_foreign` FOREIGN KEY (`idEstablecimiento`) REFERENCES `establecimientos` (`id`),
  ADD CONSTRAINT `carga_mensuals_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`);

--
-- Constraints for table `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_idprovincia_foreign` FOREIGN KEY (`idProvincia`) REFERENCES `provincias` (`id`);

--
-- Constraints for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_idestablecimiento_foreign` FOREIGN KEY (`idEstablecimiento`) REFERENCES `establecimientos` (`id`),
  ADD CONSTRAINT `funcionarios_idfuncion_foreign` FOREIGN KEY (`idFuncion`) REFERENCES `funcions` (`id`),
  ADD CONSTRAINT `funcionarios_idtipocontrato_foreign` FOREIGN KEY (`idTipoContrato`) REFERENCES `tipo_contrato` (`id`);

--
-- Constraints for table `imputacions`
--
ALTER TABLE `imputacions`
  ADD CONSTRAINT `imputacions_idcuenta_foreign` FOREIGN KEY (`idCuenta`) REFERENCES `cuentas` (`id`),
  ADD CONSTRAINT `imputacions_idestablecimiento_foreign` FOREIGN KEY (`idEstablecimiento`) REFERENCES `establecimientos` (`id`),
  ADD CONSTRAINT `imputacions_idproveedor_foreign` FOREIGN KEY (`idProveedor`) REFERENCES `proveedors` (`id`),
  ADD CONSTRAINT `imputacions_idsubvencion_foreign` FOREIGN KEY (`idSubvencion`) REFERENCES `subvencions` (`id`),
  ADD CONSTRAINT `imputacions_idtipodocumento_foreign` FOREIGN KEY (`idTipoDocumento`) REFERENCES `documentos` (`id`);

--
-- Constraints for table `leys`
--
ALTER TABLE `leys`
  ADD CONSTRAINT `leys_idsubvencion_foreign` FOREIGN KEY (`idSubvencion`) REFERENCES `subvencions` (`id`);

--
-- Constraints for table `liquidacions`
--
ALTER TABLE `liquidacions`
  ADD CONSTRAINT `liquidacions_idestablecimiento_foreign` FOREIGN KEY (`idEstablecimiento`) REFERENCES `establecimientos` (`id`),
  ADD CONSTRAINT `liquidacions_idfuncionario_foreign` FOREIGN KEY (`idFuncionario`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `liquidacions_idperiodo_foreign` FOREIGN KEY (`idPeriodo`) REFERENCES `periodos` (`id`);

--
-- Constraints for table `periodos`
--
ALTER TABLE `periodos`
  ADD CONSTRAINT `periodos_idano_foreign` FOREIGN KEY (`idAno`) REFERENCES `anos` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proveedors`
--
ALTER TABLE `proveedors`
  ADD CONSTRAINT `proveedors_idcomuna_foreign` FOREIGN KEY (`idComuna`) REFERENCES `comunas` (`id`);

--
-- Constraints for table `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_idregion_foreign` FOREIGN KEY (`idRegion`) REFERENCES `regiones` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sostenedors`
--
ALTER TABLE `sostenedors`
  ADD CONSTRAINT `sostenedors_idcomuna_foreign` FOREIGN KEY (`idComuna`) REFERENCES `comunas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
