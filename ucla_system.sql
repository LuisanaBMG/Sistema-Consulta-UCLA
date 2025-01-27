-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-01-2025 a las 20:24:52
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ucla_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academy`
--

CREATE TABLE `academy` (
  `Id_Academy` int(11) NOT NULL,
  `Academy_Number` varchar(20) NOT NULL,
  `Academy_Name` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `associates`
--

CREATE TABLE `associates` (
  `Id_Associate` int(11) NOT NULL,
  `Associate_Name` varchar(100) NOT NULL,
  `Associate_Comment` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attached_units`
--

CREATE TABLE `attached_units` (
  `Id_Units` int(11) NOT NULL,
  `Acronyms_Unit` varchar(5) NOT NULL,
  `Attached_Unit` varchar(150) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `attached_units`
--

INSERT INTO `attached_units` (`Id_Units`, `Acronyms_Unit`, `Attached_Unit`, `Date`, `Status`) VALUES
(1, 'CEE', 'DECANATO DE CIENCIAS ECONOMICAS Y EMPRESARIALES', '2024-12-21', 'Active'),
(2, 'DAG', 'DECANATO DE AGRONOMIA', '2024-12-13', 'Active'),
(3, 'DC', 'DIRECCION DE CULTURA', '2024-12-13', 'Active'),
(4, 'DCR', 'DIRECCION DE RELACIONES INTERINSTITUCIONALES', '2024-12-13', 'Active'),
(5, 'DCS', 'DECANATO DE CIENCIAS DE LA SALUD', '2024-12-13', 'Active'),
(6, 'DCV', 'DECANATO DE CIENCIAS VETERINARIAS', '2024-12-13', 'Active'),
(7, 'DCyT', 'DECANATO DE CIENCIAS Y TECNOLOGIA', '2024-12-13', 'Active'),
(8, 'DEU', 'DIRECCION DE EXTENSION UNIVERSITARIA', '2024-12-13', 'Active'),
(9, 'DHA', 'DECANATO EXPERIMENTAL DE HUMANIDADES Y ARTES', '2024-12-13', 'Active'),
(10, 'DIC', 'DECANATO DE INGENIERIA CIVIL', '2024-12-13', 'Active'),
(11, 'DIN', 'DIRECCION DE INVESTIGACION', '2024-12-13', 'Active'),
(12, 'REC', 'RECTORADO', '2024-12-13', 'Active'),
(13, 'VAC', 'VIRRECTORADO ACADEMICO', '2024-12-13', 'Active'),
(14, 'VAD', 'VICERRECTORADO ADMINISTRATIVO', '2024-12-14', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsibles`
--

CREATE TABLE `responsibles` (
  `Id_Responsible` int(11) NOT NULL,
  `Document_Type` enum('V-','J-','P-','E-','G-') NOT NULL,
  `Identification_Document` varchar(10) NOT NULL,
  `Date_Birth` date NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Second_Name` varchar(50) DEFAULT NULL,
  `First_LastName` varchar(50) NOT NULL,
  `Second_LastName` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Gender` enum('Female','Male','Other') NOT NULL,
  `Comment_Responsible` text DEFAULT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `responsible_associate`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `responsible_associate` (
`Id_RA` int(11)
,`Id_A` int(11)
,`A_Name` varchar(100)
,`Id_R` int(11)
,`Full_Name` varchar(101)
,`Date` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsible_associates`
--

CREATE TABLE `responsible_associates` (
  `Id_RA` int(11) NOT NULL,
  `Id_Responsible` int(11) NOT NULL,
  `Id_Associate` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `Id_Student` int(11) NOT NULL,
  `Document_Type` enum('V-','J-','P-','E-') NOT NULL,
  `Identification_Document` varchar(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Second_Name` varchar(50) NOT NULL,
  `First_LastName` varchar(50) NOT NULL,
  `Second_LastName` varchar(50) NOT NULL,
  `Date_Birth` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Gender` enum('Female','Male','Other') NOT NULL,
  `Comment_Student` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `student_consultation`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `student_consultation` (
`Id_Student` int(11)
,`Document_Type` enum('V-','J-','P-','E-')
,`Identification_Document` varchar(10)
,`First_Name` varchar(50)
,`Second_Name` varchar(50)
,`First_LastName` varchar(50)
,`Second_LastName` varchar(50)
,`Date_Birth` date
,`Email` varchar(100)
,`Phone_Number` varchar(13)
,`Gender` enum('Female','Male','Other')
,`Comment_Student` text
,`Date` date
,`Id_Student_Studies` int(11)
,`Id_Studies` int(11)
,`Study_Name` varchar(60)
,`Book` int(11)
,`Folio` int(11)
,`Line` int(11)
,`Start_Date` date
,`Termination_Date` date
,`Comment_SS` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_studies`
--

CREATE TABLE `student_studies` (
  `Id_Student_Studies` int(11) NOT NULL,
  `Id_Student` int(11) NOT NULL,
  `Id_Studies` int(11) NOT NULL,
  `Book` int(11) NOT NULL,
  `Folio` int(11) NOT NULL,
  `Line` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Termination_Date` date NOT NULL,
  `Comment_SS` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `studies`
--

CREATE TABLE `studies` (
  `Id_Studies` int(11) NOT NULL,
  `Id_Study_Types` int(11) NOT NULL,
  `Id_Units` int(11) NOT NULL,
  `Cohort` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Id_Academy` int(11) NOT NULL,
  `Identification_Document` varchar(10) NOT NULL,
  `Study_Name` varchar(60) NOT NULL,
  `Id_RA` int(11) NOT NULL,
  `Number_Hours` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Termination_Date` date NOT NULL,
  `Comment_Studies` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `study_consultation`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `study_consultation` (
`Id_Studies` int(11)
,`Study_Code` varchar(60)
,`Cohort` int(11)
,`Study_Name` varchar(60)
,`Identification_Document` varchar(10)
,`Year` year(4)
,`Comment_Studies` text
,`Number_Hours` int(11)
,`Id_Study_Types` int(11)
,`Study_Type` varchar(60)
,`Id_Units` int(11)
,`Attached_Unit` varchar(150)
,`Id_Academy` int(11)
,`Academy_Name` varchar(100)
,`Id_RA` int(11)
,`Associate` varchar(202)
,`Start_Date` date
,`Termination_Date` date
,`Date` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `study_types`
--

CREATE TABLE `study_types` (
  `Id_Study_Types` int(11) NOT NULL,
  `Acronyms_Study` varchar(5) NOT NULL,
  `Study_Type` varchar(60) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `study_types`
--

INSERT INTO `study_types` (`Id_Study_Types`, `Acronyms_Study`, `Study_Type`, `Date`, `Status`) VALUES
(1, 'DIP', 'DIPLOMADO', '2024-12-21', 'Active'),
(2, 'CUR', 'CURSO', '2024-12-13', 'Active'),
(3, 'T', 'TALLER', '2024-12-14', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit_resources`
--

CREATE TABLE `unit_resources` (
  `Id_Resources` int(11) NOT NULL,
  `Acronyms_Resource` varchar(5) NOT NULL,
  `Resource_Name` varchar(60) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unit_resources`
--

INSERT INTO `unit_resources` (`Id_Resources`, `Acronyms_Resource`, `Resource_Name`, `Date`, `Status`) VALUES
(1, 'UGR', 'UNIDAD DE INVESTIGACION Y DESARROLLO', '2024-12-21', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `Id_User` int(11) NOT NULL,
  `User` varchar(50) NOT NULL,
  `User_Name` varchar(100) NOT NULL,
  `User_LastName` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(33) NOT NULL,
  `Level` enum('1','2') NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`Id_User`, `User`, `User_Name`, `User_LastName`, `Email`, `Password`, `Level`, `Date`, `Status`) VALUES
(1, 'systemOperator', 'systemOperator', 'systemOperator', 'systemOperator@hotmail.com', 'a7e810524b752b4df5cc1b9ba686dfa6', '1', '2025-01-08', 'Active');

-- --------------------------------------------------------

--
-- Estructura para la vista `responsible_associate`
--
DROP TABLE IF EXISTS `responsible_associate`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `responsible_associate`  AS SELECT `ra`.`Id_RA` AS `Id_RA`, `a`.`Id_Associate` AS `Id_A`, `a`.`Associate_Name` AS `A_Name`, `r`.`Id_Responsible` AS `Id_R`, concat(`r`.`First_Name`,' ',`r`.`First_LastName`) AS `Full_Name`, `ra`.`Date` AS `Date` FROM ((`responsible_associates` `ra` join `associates` `a` on(`ra`.`Id_Associate` = `a`.`Id_Associate`)) join `responsibles` `r` on(`ra`.`Id_Responsible` = `r`.`Id_Responsible`)) WHERE `a`.`Status` = 'Active' AND `ra`.`Status` = 'Active' AND `r`.`Status` = 'Active' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `student_consultation`
--
DROP TABLE IF EXISTS `student_consultation`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `student_consultation`  AS SELECT `s`.`Id_Student` AS `Id_Student`, `s`.`Document_Type` AS `Document_Type`, `s`.`Identification_Document` AS `Identification_Document`, `s`.`First_Name` AS `First_Name`, `s`.`Second_Name` AS `Second_Name`, `s`.`First_LastName` AS `First_LastName`, `s`.`Second_LastName` AS `Second_LastName`, `s`.`Date_Birth` AS `Date_Birth`, `s`.`Email` AS `Email`, `s`.`Phone_Number` AS `Phone_Number`, `s`.`Gender` AS `Gender`, `s`.`Comment_Student` AS `Comment_Student`, `s`.`Date` AS `Date`, `ss`.`Id_Student_Studies` AS `Id_Student_Studies`, `ss`.`Id_Studies` AS `Id_Studies`, `st`.`Study_Name` AS `Study_Name`, `ss`.`Book` AS `Book`, `ss`.`Folio` AS `Folio`, `ss`.`Line` AS `Line`, `ss`.`Start_Date` AS `Start_Date`, `ss`.`Termination_Date` AS `Termination_Date`, `ss`.`Comment_SS` AS `Comment_SS` FROM ((`student_studies` `ss` join `student` `s` on(`s`.`Id_Student` = `ss`.`Id_Student`)) join `studies` `st` on(`st`.`Id_Studies` = `ss`.`Id_Studies`)) WHERE `s`.`Status` = 'Active' AND `ss`.`Status` = 'Active' AND `st`.`Status` = 'Active' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `study_consultation`
--
DROP TABLE IF EXISTS `study_consultation`;

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `study_consultation`  AS SELECT `s`.`Id_Studies` AS `Id_Studies`, concat(`st`.`Acronyms_Study`,'-',`au`.`Acronyms_Unit`,'-',`s`.`Cohort`,'-',`s`.`Year`,'-',`a`.`Academy_Number`,'-',`s`.`Identification_Document`) AS `Study_Code`, `s`.`Cohort` AS `Cohort`, `s`.`Study_Name` AS `Study_Name`, `s`.`Identification_Document` AS `Identification_Document`, `s`.`Year` AS `Year`, `s`.`Comment_Studies` AS `Comment_Studies`, `s`.`Number_Hours` AS `Number_Hours`, `st`.`Id_Study_Types` AS `Id_Study_Types`, `st`.`Study_Type` AS `Study_Type`, `au`.`Id_Units` AS `Id_Units`, `au`.`Attached_Unit` AS `Attached_Unit`, `a`.`Id_Academy` AS `Id_Academy`, `a`.`Academy_Name` AS `Academy_Name`, `ra`.`Id_RA` AS `Id_RA`, concat(`ra`.`A_Name`,' ',`ra`.`Full_Name`) AS `Associate`, `s`.`Start_Date` AS `Start_Date`, `s`.`Termination_Date` AS `Termination_Date`, `s`.`Date` AS `Date` FROM ((((`studies` `s` join `study_types` `st` on(`st`.`Id_Study_Types` = `s`.`Id_Study_Types`)) join `attached_units` `au` on(`au`.`Id_Units` = `s`.`Id_Units`)) join `academy` `a` on(`a`.`Id_Academy` = `s`.`Id_Academy`)) join `responsible_associate` `ra` on(`ra`.`Id_RA` = `s`.`Id_RA`)) WHERE `st`.`Status` = 'Active' AND `s`.`Status` = 'Active' AND `a`.`Status` = 'Active' AND `au`.`Status` = 'Active' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`Id_Academy`);

--
-- Indices de la tabla `associates`
--
ALTER TABLE `associates`
  ADD PRIMARY KEY (`Id_Associate`);

--
-- Indices de la tabla `attached_units`
--
ALTER TABLE `attached_units`
  ADD PRIMARY KEY (`Id_Units`);

--
-- Indices de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  ADD PRIMARY KEY (`Id_Responsible`);

--
-- Indices de la tabla `responsible_associates`
--
ALTER TABLE `responsible_associates`
  ADD PRIMARY KEY (`Id_RA`),
  ADD KEY `Id_Associate` (`Id_Associate`),
  ADD KEY `Id_Responsible` (`Id_Responsible`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Id_Student`);

--
-- Indices de la tabla `student_studies`
--
ALTER TABLE `student_studies`
  ADD PRIMARY KEY (`Id_Student_Studies`),
  ADD KEY `Id_Student` (`Id_Student`),
  ADD KEY `Id_Studies` (`Id_Studies`);

--
-- Indices de la tabla `studies`
--
ALTER TABLE `studies`
  ADD PRIMARY KEY (`Id_Studies`),
  ADD KEY `Id_Study_Types` (`Id_Study_Types`),
  ADD KEY `Id_Units` (`Id_Units`),
  ADD KEY `Id_Academy` (`Id_Academy`),
  ADD KEY `Id_RA` (`Id_RA`);

--
-- Indices de la tabla `study_types`
--
ALTER TABLE `study_types`
  ADD PRIMARY KEY (`Id_Study_Types`);

--
-- Indices de la tabla `unit_resources`
--
ALTER TABLE `unit_resources`
  ADD PRIMARY KEY (`Id_Resources`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academy`
--
ALTER TABLE `academy`
  MODIFY `Id_Academy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `associates`
--
ALTER TABLE `associates`
  MODIFY `Id_Associate` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `attached_units`
--
ALTER TABLE `attached_units`
  MODIFY `Id_Units` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  MODIFY `Id_Responsible` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `responsible_associates`
--
ALTER TABLE `responsible_associates`
  MODIFY `Id_RA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `Id_Student` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `student_studies`
--
ALTER TABLE `student_studies`
  MODIFY `Id_Student_Studies` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `studies`
--
ALTER TABLE `studies`
  MODIFY `Id_Studies` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `study_types`
--
ALTER TABLE `study_types`
  MODIFY `Id_Study_Types` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unit_resources`
--
ALTER TABLE `unit_resources`
  MODIFY `Id_Resources` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `responsible_associates`
--
ALTER TABLE `responsible_associates`
  ADD CONSTRAINT `responsible_associates_ibfk_1` FOREIGN KEY (`Id_Associate`) REFERENCES `associates` (`Id_Associate`),
  ADD CONSTRAINT `responsible_associates_ibfk_2` FOREIGN KEY (`Id_Responsible`) REFERENCES `responsibles` (`Id_Responsible`);

--
-- Filtros para la tabla `student_studies`
--
ALTER TABLE `student_studies`
  ADD CONSTRAINT `student_studies_ibfk_1` FOREIGN KEY (`Id_Student`) REFERENCES `student` (`Id_Student`),
  ADD CONSTRAINT `student_studies_ibfk_2` FOREIGN KEY (`Id_Studies`) REFERENCES `studies` (`Id_Studies`);

--
-- Filtros para la tabla `studies`
--
ALTER TABLE `studies`
  ADD CONSTRAINT `studies_ibfk_1` FOREIGN KEY (`Id_Study_Types`) REFERENCES `study_types` (`Id_Study_Types`),
  ADD CONSTRAINT `studies_ibfk_2` FOREIGN KEY (`Id_Units`) REFERENCES `attached_units` (`Id_Units`),
  ADD CONSTRAINT `studies_ibfk_3` FOREIGN KEY (`Id_Academy`) REFERENCES `academy` (`Id_Academy`),
  ADD CONSTRAINT `studies_ibfk_4` FOREIGN KEY (`Id_RA`) REFERENCES `responsible_associates` (`Id_RA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
