-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2024 a las 01:38:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tallercrm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asigacion_sucursal`
--

CREATE TABLE `asigacion_sucursal` (
  `asig_id` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellidos`, `direccion`, `telefono`, `email`, `fecha_registro`) VALUES
(1, 'LUIS', 'SORTO LEMUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-16'),
(2, 'FRANK JAVIER', 'SORTO LEMUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'francli@gmail.com', '2024-07-18'),
(3, 'OSCAR MANUEL', 'SORTO LEMUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(4, 'JONATHAN', 'SORTO LEMUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(5, 'PEDRO', 'SORTO LEMUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(6, 'MELVIN', 'MARROQUIN', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802764', 'superluis1994@gmail.com', '2024-07-18'),
(7, 'GARY', 'CARTAGENA', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(8, 'EMMANUEL', 'DE JESUS', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(9, 'CARLOS', 'JUAREZ', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(10, 'LUIS', 'ORTEGA', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'superluis1994@gmail.com', '2024-07-18'),
(11, 'JUANCHO', 'PERES', 'El salvador\r\nEl salvador, chalchuapa', '+503 75802763', 'ia.superluis@ufg.edu.sv', '2024-07-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `data_usuario`
--

CREATE TABLE `data_usuario` (
  `id_data` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `apellidos` varchar(70) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `data_usuario`
--

INSERT INTO `data_usuario` (`id_data`, `nombre`, `apellidos`, `telefono`, `sexo`, `id_user`) VALUES
(1, 'LUIS ALBERTO', 'SORTO LEMUS', '+503 75802763', 'M', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_factura`
--

INSERT INTO `detalle_factura` (`id_detalle`, `id_factura`, `tipo`, `id_item`, `cantidad`, `precio_unitario`, `observaciones`) VALUES
(1, 1, '1', 1, 2, 50.00, ''),
(2, 1, '2', 2, 1, 25.00, ''),
(5, 3, '1', 1, 1, 50.00, 'se utilizo 5W-30'),
(6, 3, '2', 2, 1, 25.00, ''),
(7, 3, '3', 3, 1, 15.00, 'se cambiaron las pastillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_cliente`, `fecha_emision`, `total`, `estado`) VALUES
(1, 10, '2024-07-30', 125.00, 'pendiente'),
(3, 10, '2024-07-31', 90.00, 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca_vehiculo`
--

CREATE TABLE `marca_vehiculo` (
  `id_marca` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca_vehiculo`
--

INSERT INTO `marca_vehiculo` (`id_marca`, `nombre`, `status`) VALUES
(1, 'Toyota', 1),
(2, 'Honda', 1),
(3, 'Ford', 1),
(4, 'Chevrolet', 1),
(5, 'Nissan', 1),
(6, 'BMW', 1),
(7, 'Mercedes-Benz', 1),
(8, 'Audi', 1),
(9, 'Volkswagen', 1),
(10, 'Hyundai', 1),
(11, 'Kia', 1),
(12, 'Mazda', 1),
(13, 'Mitsubishi', 1),
(14, 'Suzuki', 1),
(15, 'Subaru', 1),
(16, 'Isuzu', 1),
(17, 'Jeep', 1),
(18, 'Fiat', 1),
(19, 'Peugeot', 1),
(20, 'Renault', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `tipo` varchar(40) NOT NULL,
  `orden` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `id_padre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `titulo`, `enlace`, `icono`, `tipo`, `orden`, `Descripcion`, `id_padre`) VALUES
(1, 'CLIENTES', '/panel/cliente', '<svg width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-32\">\n                                    <path opacity=\"0.4\" d=\"M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z\" fill=\"currentColor\"></path>\n                                    <path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z\" fill=\"currentColor\"></path>\n                                </svg>                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>                               </svg>', 'Titulo', 2, '', NULL),
(2, 'FACTURAS', '/panel/factura', '<svg width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-32\">\n                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>\n                                </svg>', 'Titulo', 1, '', NULL),
(3, 'VEHICULOS', '/panel/vehiculos', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'Titulo', 3, '', NULL),
(4, 'ADMINISTRACION', '/panel/Administracion', '<svg width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" class=\"icon-32\">\r\n                                    <path opacity=\"0.4\" d=\"M10.0833 15.958H3.50777C2.67555 15.958 2 16.6217 2 17.4393C2 18.2559 2.67555 18.9207 3.50777 18.9207H10.0833C10.9155 18.9207 11.5911 18.2559 11.5911 17.4393C11.5911 16.6217 10.9155 15.958 10.0833 15.958Z\" fill=\"currentColor\"></path>\r\n                                    <path opacity=\"0.4\" d=\"M22.0001 6.37867C22.0001 5.56214 21.3246 4.89844 20.4934 4.89844H13.9179C13.0857 4.89844 12.4102 5.56214 12.4102 6.37867C12.4102 7.1963 13.0857 7.86 13.9179 7.86H20.4934C21.3246 7.86 22.0001 7.1963 22.0001 6.37867Z\" fill=\"currentColor\"></path>\r\n                                    <path d=\"M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856Z\" fill=\"currentColor\"></path>\r\n                                    <path d=\"M21.9998 17.3992C21.9998 19.2648 20.4609 20.7777 18.5609 20.7777C16.6621 20.7777 15.1221 19.2648 15.1221 17.3992C15.1221 15.5325 16.6621 14.0195 18.5609 14.0195C20.4609 14.0195 21.9998 15.5325 21.9998 17.3992Z\" fill=\"currentColor\"></path>\r\n                                </svg>', 'Titulo', 4, 'Mantenimiento de Servicios y Marcas: Sección dedicada a la gestión y actualización de los servicios y marcas disponibles para su registro y seguimiento en la base de datos de clientes.', NULL),
(12, 'Listado', '/panel/cliente/listado', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 1, '', 1),
(21, 'Historial', '/panel/factura/gererrarFactura', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 1, '', 2),
(22, 'Historial Factura', 'panel/factura/historial', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 2, '', 2),
(31, 'Vehiculos', '/panel/vehiculo/listado', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\n                                            <g>\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\n                                            </g>\n                                        </svg>', 'subMenu', 2, '', 3),
(41, 'Servicios', '/panel/Administracion/servicios', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 1, 'Administracion de servicios que ofrece el taller ', 4),
(42, 'Marcas', '/panel/Administracion/Marcas', '<svg class=\"icon-10\" xmlns=\"http://www.w3.org/2000/svg\" width=\"10\" viewBox=\"0 0 24 24\" fill=\"currentColor\">\r\n                                            <g>\r\n                                            <circle cx=\"12\" cy=\"12\" r=\"8\" fill=\"currentColor\"></circle>\r\n                                            </g>\r\n                                        </svg>', 'subMenu', 2, 'Administracion de las marcas de los vehiculos  ', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_user`
--

CREATE TABLE `permisos_user` (
  `id_permiso` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `tipo_permiso` enum('lectura','escritura','ninguno') DEFAULT 'lectura'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permisos_user`
--

INSERT INTO `permisos_user` (`id_permiso`, `id_user`, `id_menu`, `tipo_permiso`) VALUES
(175, 1, 1, 'lectura'),
(176, 1, 1, 'escritura'),
(177, 1, 2, 'lectura'),
(178, 1, 2, 'escritura'),
(181, 1, 21, 'lectura'),
(182, 1, 21, 'escritura'),
(183, 1, 21, 'lectura'),
(184, 1, 21, 'escritura'),
(185, 1, 12, 'lectura'),
(186, 1, 12, 'escritura'),
(187, 1, 4, 'escritura'),
(188, 1, 4, 'lectura'),
(189, 1, 41, 'lectura'),
(190, 1, 41, 'escritura'),
(191, 1, 42, 'lectura'),
(192, 1, 42, 'escritura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `precio_sugerido` decimal(11,2) NOT NULL DEFAULT 0.00,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre`, `precio_sugerido`, `descripcion`, `status`) VALUES
(1, 'Cambio de aceite', 50.00, 'Cambio de aceite de motor y filtro', 1),
(2, 'Alineación y balanceo', 25.00, 'Alineación y balanceo de llantas', 1),
(3, 'Revisión de frenos', 15.00, 'Inspección y cambio de pastillas de freno', 1),
(4, 'Revisión de suspensión', 0.00, 'Chequeo y ajuste de suspensión', 1),
(5, 'Reparación de motor', 0.00, 'Diagnóstico y reparación de fallas en el motor', 1),
(6, 'Revisión de sistema eléctrico', 0.00, 'Diagnóstico y reparación del sistema eléctrico', 1),
(7, 'Cambio de batería', 0.00, 'Cambio de batería y revisión del sistema de carga', 1),
(8, 'Revisión de transmisión', 0.00, 'Chequeo y mantenimiento de la transmisión', 1),
(9, 'Cambio de bujías', 0.00, 'Cambio de bujías y ajuste del sistema de encendido', 1),
(10, 'Revisión de sistema de escape', 0.00, 'Inspección y reparación del sistema de escape', 1),
(11, 'Revisión de sistema de refrigeración', 0.00, 'Chequeo y reparación del sistema de refrigeración', 1),
(12, 'Cambio de filtro de aire', 0.00, 'Cambio de filtro de aire del motor', 1),
(13, 'Cambio de filtro de combustible', 0.00, 'Cambio de filtro de combustible', 1),
(14, 'Servicio de aire acondicionado', 0.00, 'Revisión y carga de aire acondicionado', 1),
(15, 'Lavado de motor', 0.00, 'Lavado y desengrasado de motor', 1),
(16, 'Cambio de amortiguadores', 0.00, 'Cambio de amortiguadores y revisión de suspensión', 1),
(17, 'Revisión de luces', 0.00, 'Chequeo y cambio de luces delanteras y traseras', 1),
(18, 'Diagnóstico por computadora', 0.00, 'Diagnóstico completo del vehículo por computadora', 1),
(19, 'Servicio de mantenimiento preventivo', 0.00, 'Mantenimiento preventivo general del vehículo', 1),
(20, 'Inspección pre-ITV', 0.00, 'Inspección completa del vehículo antes de la ITV', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id_status`, `titulo`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'ACTIVO', '2024-04-08 21:08:51', NULL, 0, NULL),
(2, 'DESACTIVO', '2024-04-08 21:08:51', NULL, 0, NULL),
(3, 'CERRADO', '2024-05-11 02:29:19', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id_sucursal` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `departamento` int(11) NOT NULL,
  `gerente` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_usuario`
--

CREATE TABLE `tipo_de_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL,
  `usuario_creacion` int(11) NOT NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tipo_de_usuario`
--

INSERT INTO `tipo_de_usuario` (`id_tipo_usuario`, `titulo`, `status`, `fecha_creacion`, `fecha_actualizacion`, `usuario_creacion`, `usuario_actualizacion`) VALUES
(1, 'Admin', 1, '2024-07-07 21:39:15', NULL, 0, NULL),
(2, 'Gerente', 1, '2024-07-09 21:42:12', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `dui` varchar(12) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `passwor` text NOT NULL,
  `email` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `online` int(11) NOT NULL DEFAULT 1,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `dui`, `usuario`, `passwor`, `email`, `status`, `online`, `rol`) VALUES
(1, '04949668-8', 'superluis1994', '4kEJjhZXumb2kHkVjjP9k/dN674d2ZSGjCNZiV0ZmXY=', 'superluis1994@gmail.com', 1, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `serieMotor` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `id_cliente`, `marca`, `modelo`, `año`, `placa`, `serieMotor`) VALUES
(1, 1, '5', 'HILUX', 2019, '95960708', '04994957'),
(2, 2, '1', 'HILUX', 2019, '49959596', '8485866'),
(3, 3, '3', 'HILUX', 2019, '499595962', '848586623'),
(4, 4, '6', 'SSS', 2019, '959607083', '049949574'),
(5, 5, '2', 'SSS', 2019, '234567', '333333'),
(6, 6, '16', 'SSS', 2019, '95960708', '8485866'),
(7, 7, '9', 'SSS', 2019, '95960708', '04994957'),
(8, 8, '13', 'SSS', 2019, '95960708', '04994957'),
(9, 9, '7', 'HILUX', 2019, '95960708', '04994957'),
(10, 10, '4', 'SSS', 2019, '49959596', '04994957'),
(11, 11, '1', 'CCCCCCCCC', 2019, '55555555555', '44567');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asigacion_sucursal`
--
ALTER TABLE `asigacion_sucursal`
  ADD PRIMARY KEY (`asig_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `data_usuario`
--
ALTER TABLE `data_usuario`
  ADD PRIMARY KEY (`id_data`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_factura` (`id_factura`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_id_padre` (`id_padre`);

--
-- Indices de la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_hermano` (`id_user`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id_sucursal`);

--
-- Indices de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `data_usuario`
--
ALTER TABLE `data_usuario`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marca_vehiculo`
--
ALTER TABLE `marca_vehiculo`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_de_usuario`
--
ALTER TABLE `tipo_de_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_id_padre` FOREIGN KEY (`id_padre`) REFERENCES `menu` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_padre`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `permisos_user`
--
ALTER TABLE `permisos_user`
  ADD CONSTRAINT `permisos_user_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
