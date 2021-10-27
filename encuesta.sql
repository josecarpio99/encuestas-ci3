-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 08:24 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encuesta`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_usuarios`
--

CREATE TABLE `adm_usuarios` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL,
  `razonSocial` varchar(65) NOT NULL,
  `email` varchar(85) NOT NULL,
  `passwd` varchar(45) NOT NULL,
  `perfil` int(10) UNSIGNED NOT NULL,
  `pposventa` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pventa` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pconfig` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `plistado` int(11) NOT NULL DEFAULT 0,
  `pExportOport` int(11) NOT NULL DEFAULT 0,
  `accesoCyclic` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adm_usuarios`
--

INSERT INTO `adm_usuarios` (`idUsuario`, `idEmpresa`, `idSucursal`, `razonSocial`, `email`, `passwd`, `perfil`, `pposventa`, `pventa`, `pconfig`, `plistado`, `pExportOport`, `accesoCyclic`) VALUES
(80, 3, 9, 'admin demo', 'admin@demo.com', '236', 2, 1, 1, 1, 1, 1, 0),
(81, 3, 9, 'vendedor 1', 'vendedor1@demoag.com', '54236', 1, 0, 1, 1, 0, 0, 0),
(82, 3, 9, 'vendedor 2', 'vendedor 2@demoag.com', '12536', 1, 0, 1, 1, 0, 0, 0),
(83, 3, 9, 'vendedor 3', 'vendedor 3@demoag.com', '55482', 1, 1, 0, 1, 0, 0, 0),
(84, 3, 10, 'vendedor 4', 'vendedor 4@demoag.com', '95021', 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `idArea` int(11) NOT NULL,
  `nombreArea` varchar(85) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`idArea`, `nombreArea`) VALUES
(1, 'Repuestos'),
(2, 'Servicios'),
(3, 'Ventas'),
(4, 'Administración'),
(5, 'Sol.Integrales'),
(7, 'Relevamiento');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(10) UNSIGNED NOT NULL,
  `email` varchar(145) DEFAULT NULL,
  `razonSocial` varchar(145) NOT NULL,
  `cuit` varchar(45) DEFAULT NULL,
  `passwd` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(60) DEFAULT NULL,
  `domicilio` varchar(253) DEFAULT NULL,
  `contacto` varchar(254) DEFAULT NULL,
  `telefonoContacto` varchar(60) DEFAULT NULL,
  `alias` varchar(145) DEFAULT NULL,
  `ingreso` tinyint(1) NOT NULL DEFAULT 0,
  `relevado` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `idTipoRelevamiento` int(11) NOT NULL DEFAULT 0,
  `fechaAlta` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaModif` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idLocalidad` int(11) DEFAULT NULL,
  `idEmpresa` int(11) NOT NULL,
  `tipoCliente` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `idSubrubro` int(10) UNSIGNED DEFAULT NULL,
  `codigoERP` varchar(21) DEFAULT NULL,
  `codigoERP_Padre` varchar(21) DEFAULT NULL,
  `idGrupoEconomico` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `categoriaVentas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `categoriaPotencial` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `idUsuarioAlta` int(11) NOT NULL,
  `usuarioAlta` varchar(150) NOT NULL,
  `idSucursalAlta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`idCliente`, `email`, `razonSocial`, `cuit`, `passwd`, `telefono`, `celular`, `domicilio`, `contacto`, `telefonoContacto`, `alias`, `ingreso`, `relevado`, `idTipoRelevamiento`, `fechaAlta`, `fechaModif`, `idLocalidad`, `idEmpresa`, `tipoCliente`, `idSubrubro`, `codigoERP`, `codigoERP_Padre`, `idGrupoEconomico`, `observaciones`, `categoriaVentas`, `categoriaPotencial`, `idUsuarioAlta`, `usuarioAlta`, `idSucursalAlta`) VALUES
(5001, 'cliente2@demoag.com', 'Cliente 2', '11111111119', 'demoAg20', '151651612', '543404492083', 'Direccion 2', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:36:50', 2755, 3, 0, NULL, '685', NULL, NULL, NULL, 1, 3, 0, '', 0),
(5002, 'cliente3@demoag.com', 'Cliente 3', '11111111120', 'demoAg20', '151651613', '543404492083', 'Direccion 3', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 2652, 3, 0, NULL, '5399', NULL, NULL, NULL, 1, 3, 0, '', 0),
(5003, 'cliente4@demoag.com', 'Cliente 4', '11111111121', 'demoAg20', '151651614', '543404492083', 'Direccion 4', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2020-03-17 00:21:11', 12460, 3, 0, NULL, '3779', NULL, NULL, NULL, 1, 3, 0, '', 0),
(5004, 'cliente5@demoag.com', 'Cliente 5', '11111111122', 'demoAg20', '151651615', '543404492083', 'Direccion 5', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 914, 3, 0, NULL, '32', NULL, NULL, NULL, 1, 2, 0, '', 0),
(5005, 'cliente6@demoag.com', 'Cliente 6', '11111111123', 'demoAg20', '151651616', '543404492083', 'Direccion 6', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2020-02-22 12:38:12', 12410, 3, 0, NULL, '269', NULL, NULL, NULL, 2, 1, 0, '', 0),
(5006, 'cliente7@demoag.com', 'Cliente 7', '11111111124', 'demoAg20', '151651617', '543404492083', 'Direccion 7', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 2459, 3, 0, NULL, '423', NULL, NULL, NULL, 3, 3, 0, '', 0),
(5007, 'cliente8@demoag.com', 'Cliente 8', '11111111125', 'demoAg20', '151651618', '543404492083', 'Direccion 8', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 1624, 3, 0, NULL, '2801', NULL, NULL, NULL, 3, 3, 0, '', 0),
(5008, 'cliente9@demoag.com', 'Cliente 9', '11111111126', 'demoAg20', '151651619', '543404492083', 'Direccion 9', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 20239, 3, 0, NULL, '2930', NULL, NULL, NULL, 3, 3, 0, '', 0),
(5009, 'cliente10@demoag.com', 'Cliente 10', '11111111127', 'demoAg20', '1516516110', '+545478458', 'Direccion 10', 'demo', '543404492083', 'diego', 0, 0, 1, '2019-12-16 03:00:00', '2021-05-07 14:32:16', 5899, 3, 0, 0, '3619', '', 1, '', 1, 3, 0, '', 0),
(5010, 'cliente11@demoag.com', 'Cliente 11', '11111111128', 'demoAg20', '1516516111', '543404492083', 'Direccion 11', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 1239, 3, 0, NULL, '1138', NULL, NULL, NULL, 1, 3, 0, '', 0),
(5011, 'cliente12@demoag.com', 'Cliente 12', '11111111129', 'demoAg20', '1516516112', '543404492083', 'Direccion 12', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:34', 1239, 3, 0, NULL, '2509', NULL, NULL, NULL, 1, 2, 0, '', 0),
(5012, 'cliente13@demoag.com', 'Cliente 13', '11111111130', 'demoAg20', '1516516113', '543404492083', 'Direccion 13', 'demo', '543404492083', NULL, 0, 0, 1, '2019-12-16 03:00:00', '2019-12-16 18:37:35', 1719, 3, 0, NULL, '2359', NULL, NULL, NULL, 1, 1, 0, '', 0),
(9492, 'fbarberis18@gmail.com', 'Agrosilo', '30250633598', '', '+543404575150', '+543404575152', '20 junio236', '', '', 'Diego', 0, 0, 1, '2021-04-29 05:00:00', '2021-07-27 16:00:12', 17015, 3, 0, 0, NULL, '', NULL, '', 0, 3, 0, '', 0),
(9493, 'cliente_454@gmail.com', 'Cliente 102321', '11121111127', '', '0340415492083', '+545478458g', '', '', '', '', 0, 0, 1, '2021-05-18 05:00:00', '2021-05-18 22:52:31', 9254, 3, 0, 0, NULL, '', NULL, '', 0, 1, 0, '', 0),
(9494, 'cliente5444@ag.com', 'Cliente 444', '11112311127', '', '', '+543404492083', '', '', '', '', 0, 0, 1, '2021-05-26 05:00:00', '2021-05-26 21:12:44', 752, 3, 0, 0, NULL, '', NULL, '', 0, 1, 0, '', 0),
(9495, 'agronivel@agnivel.com', 'Agronivel', '11118561127', '', '', '+543404492083', '', '', '', '', 0, 0, 1, '2021-06-08 05:00:00', '2021-09-01 20:17:04', 1605, 3, 0, 0, NULL, '', NULL, '', 0, 3, 0, '', 0),
(9496, 'agronivelx2@agnivel.com', 'Agronivel2', '11954111127', '', '', '+543404492083', '', '', '', '', 0, 0, 1, '2021-06-08 05:00:00', '2021-10-04 21:12:00', 12408, 3, 0, 0, NULL, '', NULL, '', 0, 3, 0, '', 0),
(9497, 'Cliente@77.com', 'Cliente578', '20315368364', '', '+5440415492083', '+543404492083', '', '', '', '', 0, 0, 1, '2021-06-14 05:00:00', '2021-06-14 10:43:32', 710, 3, 0, 0, NULL, '', NULL, '', 0, 1, 0, '', 0),
(9498, 'cliente56s2Cli2@ag.com', 'Ventascon sa', '33342234567', '', '', '+543404492083', '', '', '', '', 0, 0, 1, '2021-06-14 05:00:00', '2021-06-14 19:14:23', 636, 3, 0, 0, NULL, '', NULL, '', 0, 1, 0, '', 0),
(9499, 'Maxi@com', 'Agronegocios sas', '20104596585', '', '', '+5467887688766', '', '', '', '', 0, 0, 2, '2021-06-15 05:00:00', '2021-10-15 19:46:31', 14095, 3, 0, 0, NULL, '', NULL, '', 0, 1, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE `empresas` (
  `idEmpresa` int(11) NOT NULL,
  `razonSocial` varchar(60) NOT NULL,
  `nombreDominio` varchar(45) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `logo` varchar(254) NOT NULL,
  `idIdioma` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `redSocial1` text NOT NULL,
  `redSocial2` text NOT NULL,
  `redSocial3` text NOT NULL,
  `redSocial4` text NOT NULL,
  `idColor1` varchar(15) NOT NULL,
  `idColor2` varchar(15) NOT NULL,
  `idColor3` varchar(15) NOT NULL,
  `apiAL` varchar(260) NOT NULL,
  `linkCyclic` varchar(230) NOT NULL DEFAULT '#',
  `linkCyclicLocal` varchar(230) NOT NULL DEFAULT '#'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`idEmpresa`, `razonSocial`, `nombreDominio`, `email`, `telefono`, `logo`, `idIdioma`, `idPais`, `redSocial1`, `redSocial2`, `redSocial3`, `redSocial4`, `idColor1`, `idColor2`, `idColor3`, `apiAL`, `linkCyclic`, `linkCyclicLocal`) VALUES
(3, 'Demostracion', 'demostracion', 'miemapra@hotmail.com', '123456', 'logoAG.jpg', 0, 0, '#', '#', '#', '#', '#4e73df', '', '', '', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `encuestas`
--

CREATE TABLE `encuestas` (
  `idEncuesta` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `idTipoEncuesta` int(11) NOT NULL DEFAULT 1,
  `idEstadoEncuesta` int(11) NOT NULL DEFAULT 1,
  `idUnidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas`
--

INSERT INTO `encuestas` (`idEncuesta`, `nombre`, `titulo`, `idTipoEncuesta`, `idEstadoEncuesta`, `idUnidad`) VALUES
(16, 'Satisfacción cliente', 'Satisfacción cliente', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_clientes`
--

CREATE TABLE `encuestas_clientes` (
  `idEncuestaCliente` int(11) NOT NULL,
  `idEncuesta` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `idRelacion` int(11) DEFAULT NULL,
  `fechaEnvio` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaEnviada` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaRespuesta` datetime NOT NULL DEFAULT current_timestamp(),
  `idEstado` int(11) DEFAULT NULL,
  `calificacionGeneral` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_clientes`
--

INSERT INTO `encuestas_clientes` (`idEncuestaCliente`, `idEncuesta`, `idCliente`, `idUsuario`, `idRelacion`, `fechaEnvio`, `fechaEnviada`, `fechaRespuesta`, `idEstado`, `calificacionGeneral`) VALUES
(1, 16, 5001, NULL, NULL, '2021-10-27 14:18:47', '2021-10-27 14:18:47', '2021-10-27 14:18:47', NULL, NULL),
(2, 16, 9499, NULL, NULL, '2021-10-27 14:20:17', '2021-10-27 14:20:17', '2021-10-27 14:20:17', NULL, NULL),
(3, 16, 9496, NULL, NULL, '2021-10-27 14:23:18', '2021-10-27 14:23:18', '2021-10-27 14:23:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_clientes_respuestas`
--

CREATE TABLE `encuestas_clientes_respuestas` (
  `idEncuestaClienteRespuesta` int(11) NOT NULL,
  `idEncuestaCliente` int(11) NOT NULL,
  `idEncuestaPregunta` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_clientes_respuestas`
--

INSERT INTO `encuestas_clientes_respuestas` (`idEncuestaClienteRespuesta`, `idEncuestaCliente`, `idEncuestaPregunta`, `valor`) VALUES
(1, 1, 15, 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been '),
(2, 1, 16, 'si'),
(3, 1, 17, '8'),
(4, 1, 18, 'Excelente'),
(5, 1, 19, 'es and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sit'),
(6, 2, 15, 'unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions'),
(7, 2, 16, 'no'),
(8, 2, 17, '4'),
(9, 2, 18, 'bien'),
(10, 2, 19, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.'),
(11, 3, 15, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.'),
(12, 3, 16, 'si'),
(13, 3, 17, '10'),
(14, 3, 18, 'Excelente'),
(15, 3, 19, 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\"');

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_estados`
--

CREATE TABLE `encuestas_estados` (
  `idEstadoEncuesta` int(11) NOT NULL,
  `valor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_estados`
--

INSERT INTO `encuestas_estados` (`idEstadoEncuesta`, `valor`) VALUES
(1, 'estado 1'),
(2, 'estado 2'),
(3, 'estado 3');

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_preguntas`
--

CREATE TABLE `encuestas_preguntas` (
  `idEncuestaPregunta` int(11) NOT NULL,
  `idEncuesta` int(11) NOT NULL,
  `detalle` varchar(255) NOT NULL,
  `tipo` enum('0','1','2','3') NOT NULL,
  `minimo` int(11) DEFAULT NULL,
  `maximo` int(11) DEFAULT NULL,
  `orden` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_preguntas`
--

INSERT INTO `encuestas_preguntas` (`idEncuestaPregunta`, `idEncuesta`, `detalle`, `tipo`, `minimo`, `maximo`, `orden`) VALUES
(15, 16, 'Describe los usos que le darás al producto', '0', NULL, NULL, 1),
(16, 16, 'Piensa volver a comprar con nosotros', '1', NULL, NULL, 2),
(17, 16, 'Del 1 al 10 como calificas la calidad del producto', '3', 1, 10, 3),
(18, 16, 'Como calificarias la atención al cliente', '2', NULL, NULL, 4),
(19, 16, 'Algunas sugerencias', '0', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_preguntas_listas`
--

CREATE TABLE `encuestas_preguntas_listas` (
  `idEncuestaPreguntaLista` int(11) NOT NULL,
  `idEncuestaPregunta` int(11) NOT NULL,
  `valor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_preguntas_listas`
--

INSERT INTO `encuestas_preguntas_listas` (`idEncuestaPreguntaLista`, `idEncuestaPregunta`, `valor`) VALUES
(40, 18, 'Excelente'),
(41, 18, 'bien'),
(42, 18, 'deficiente');

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_responsable`
--

CREATE TABLE `encuestas_responsable` (
  `idEncuestaResponsable` int(11) NOT NULL,
  `idEncuesta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_responsable`
--

INSERT INTO `encuestas_responsable` (`idEncuestaResponsable`, `idEncuesta`, `idUsuario`, `idSucursal`) VALUES
(19, 16, 80, 9),
(20, 16, 82, 9);

-- --------------------------------------------------------

--
-- Table structure for table `encuestas_tipos`
--

CREATE TABLE `encuestas_tipos` (
  `idTipoEncuesta` int(11) NOT NULL,
  `nombreTipoEncuesta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `encuestas_tipos`
--

INSERT INTO `encuestas_tipos` (`idTipoEncuesta`, `nombreTipoEncuesta`) VALUES
(1, 'tipo 1'),
(2, 'tipo 2'),
(3, 'tipo 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idArea`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indexes for table `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indexes for table `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`idEncuesta`);

--
-- Indexes for table `encuestas_clientes`
--
ALTER TABLE `encuestas_clientes`
  ADD PRIMARY KEY (`idEncuestaCliente`);

--
-- Indexes for table `encuestas_clientes_respuestas`
--
ALTER TABLE `encuestas_clientes_respuestas`
  ADD PRIMARY KEY (`idEncuestaClienteRespuesta`);

--
-- Indexes for table `encuestas_estados`
--
ALTER TABLE `encuestas_estados`
  ADD PRIMARY KEY (`idEstadoEncuesta`);

--
-- Indexes for table `encuestas_preguntas`
--
ALTER TABLE `encuestas_preguntas`
  ADD PRIMARY KEY (`idEncuestaPregunta`),
  ADD KEY `fk_encuesta_id` (`idEncuesta`);

--
-- Indexes for table `encuestas_preguntas_listas`
--
ALTER TABLE `encuestas_preguntas_listas`
  ADD PRIMARY KEY (`idEncuestaPreguntaLista`),
  ADD KEY `fk_pregunta_id` (`idEncuestaPregunta`);

--
-- Indexes for table `encuestas_responsable`
--
ALTER TABLE `encuestas_responsable`
  ADD PRIMARY KEY (`idEncuestaResponsable`),
  ADD KEY `fk_grade_id` (`idEncuesta`);

--
-- Indexes for table `encuestas_tipos`
--
ALTER TABLE `encuestas_tipos`
  ADD PRIMARY KEY (`idTipoEncuesta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm_usuarios`
--
ALTER TABLE `adm_usuarios`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9531;

--
-- AUTO_INCREMENT for table `empresas`
--
ALTER TABLE `empresas`
  MODIFY `idEmpresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `idEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `encuestas_clientes`
--
ALTER TABLE `encuestas_clientes`
  MODIFY `idEncuestaCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `encuestas_clientes_respuestas`
--
ALTER TABLE `encuestas_clientes_respuestas`
  MODIFY `idEncuestaClienteRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `encuestas_estados`
--
ALTER TABLE `encuestas_estados`
  MODIFY `idEstadoEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `encuestas_preguntas`
--
ALTER TABLE `encuestas_preguntas`
  MODIFY `idEncuestaPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `encuestas_preguntas_listas`
--
ALTER TABLE `encuestas_preguntas_listas`
  MODIFY `idEncuestaPreguntaLista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `encuestas_responsable`
--
ALTER TABLE `encuestas_responsable`
  MODIFY `idEncuestaResponsable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `encuestas_tipos`
--
ALTER TABLE `encuestas_tipos`
  MODIFY `idTipoEncuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encuestas_preguntas`
--
ALTER TABLE `encuestas_preguntas`
  ADD CONSTRAINT `fk_encuesta_id` FOREIGN KEY (`idEncuesta`) REFERENCES `encuestas` (`idEncuesta`) ON DELETE CASCADE;

--
-- Constraints for table `encuestas_preguntas_listas`
--
ALTER TABLE `encuestas_preguntas_listas`
  ADD CONSTRAINT `fk_pregunta_id` FOREIGN KEY (`idEncuestaPregunta`) REFERENCES `encuestas_preguntas` (`idEncuestaPregunta`) ON DELETE CASCADE;

--
-- Constraints for table `encuestas_responsable`
--
ALTER TABLE `encuestas_responsable`
  ADD CONSTRAINT `fk_grade_id` FOREIGN KEY (`idEncuesta`) REFERENCES `encuestas` (`idEncuesta`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
