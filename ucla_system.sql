-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2025 a las 02:07:02
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
-- Estructura de tabla para la tabla `cohort`
--

CREATE TABLE `cohort` (
  `Id_Cohort` int(11) NOT NULL,
  `Id_Program` int(11) NOT NULL,
  `Cohort` varchar(11) NOT NULL,
  `Number_Females` int(11) NOT NULL,
  `Number_Males` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Termination_Date` date NOT NULL,
  `Comment_Cohort` varchar(50) DEFAULT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cohort_consultation`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cohort_consultation` (
`Id_Program` int(11)
,`Program_Name` varchar(60)
,`Cohort` varchar(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organization`
--

CREATE TABLE `organization` (
  `Id_Organization` int(11) NOT NULL,
  `Organization_Number` varchar(20) NOT NULL,
  `Organization_Name` varchar(100) NOT NULL,
  `Id_Responsible` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programs`
--

CREATE TABLE `programs` (
  `Id_Program` int(11) NOT NULL,
  `Id_Program_Types` int(11) NOT NULL,
  `Id_Units` int(11) NOT NULL,
  `Year` year(4) NOT NULL,
  `Id_Organization` int(11) NOT NULL,
  `Id_Resources` int(11) NOT NULL,
  `Program_Name` varchar(60) NOT NULL,
  `Number_Hours` int(11) NOT NULL,
  `Approval_Date` date NOT NULL,
  `Comment_Programs` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `program_consultation`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `program_consultation` (
`Id_Program` int(11)
,`Program_Code` varchar(114)
,`Program_Name` varchar(60)
,`Year` year(4)
,`Comment_Programs` text
,`Number_Hours` int(11)
,`Approval_Date` date
,`Id_Cohort` int(11)
,`Cohort` varchar(22)
,`Number_Females` int(11)
,`Number_Males` int(11)
,`Start_Date` date
,`Termination_Date` date
,`Comment_Cohort` varchar(50)
,`Id_Program_Types` int(11)
,`Program_Type` varchar(60)
,`Id_Units` int(11)
,`Attached_Unit` varchar(150)
,`Id_Resources` int(11)
,`Acronyms_Resource` enum('UGR','NGR')
,`Id_Organization` int(11)
,`Organization_Name` varchar(100)
,`Date` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `program_types`
--

CREATE TABLE `program_types` (
  `Id_Program_Types` int(11) NOT NULL,
  `Acronyms_Program` varchar(5) NOT NULL,
  `Program_Type` varchar(60) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `program_types`
--

INSERT INTO `program_types` (`Id_Program_Types`, `Acronyms_Program`, `Program_Type`, `Date`, `Status`) VALUES
(1, 'DIP', 'DIPLOMADO', '2024-12-21', 'Active'),
(2, 'CUR', 'CURSO', '2024-12-13', 'Active'),
(3, 'T', 'TALLER', '2024-12-14', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsibles`
--

CREATE TABLE `responsibles` (
  `Id_Responsible` int(11) NOT NULL,
  `Document_Type` enum('V-','J-','P-','E-','G-') NOT NULL,
  `Identification_Document` varchar(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Second_Name` varchar(50) DEFAULT NULL,
  `First_LastName` varchar(50) NOT NULL,
  `Second_LastName` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Gender` enum('Female','Male','Other') NOT NULL,
  `Type_Responsible` varchar(30) NOT NULL,
  `Status_Responsible` varchar(30) NOT NULL,
  `Comment_Responsible` text DEFAULT NULL,
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
  `First_Name` varchar(80) NOT NULL,
  `Second_Name` varchar(80) NOT NULL,
  `First_LastName` varchar(80) NOT NULL,
  `Second_LastName` varchar(80) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone_Number` varchar(13) NOT NULL,
  `Gender` enum('Female','Male','Other') NOT NULL,
  `Social_Network` varchar(30) NOT NULL,
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
`Student_Code` varchar(125)
,`Id_Student` int(11)
,`Document_Type` enum('V-','J-','P-','E-')
,`Identification_Document` varchar(10)
,`First_Name` varchar(80)
,`Second_Name` varchar(80)
,`First_LastName` varchar(80)
,`Second_LastName` varchar(80)
,`Email` varchar(100)
,`Phone_Number` varchar(13)
,`Gender` enum('Female','Male','Other')
,`Social_Network` varchar(30)
,`Comment_Student` text
,`Id_Student_Programs` int(11)
,`Id_Program` int(11)
,`Program_Name` varchar(60)
,`Book` int(11)
,`Folio` int(11)
,`Line` int(11)
,`Comment_SS` text
,`Date` date
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_programs`
--

CREATE TABLE `student_programs` (
  `Id_Student_Programs` int(11) NOT NULL,
  `Id_Student` int(11) NOT NULL,
  `Id_Program` int(11) NOT NULL,
  `Book` int(11) NOT NULL,
  `Folio` int(11) NOT NULL,
  `Line` int(11) NOT NULL,
  `Comment_SS` text NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit_resources`
--

CREATE TABLE `unit_resources` (
  `Id_Resources` int(11) NOT NULL,
  `Acronyms_Resource` enum('UGR','NGR') NOT NULL,
  `Resource_Name` varchar(60) NOT NULL,
  `Approval_Date` date NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Estructura para la vista `cohort_consultation`
--
DROP TABLE IF EXISTS `cohort_consultation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cohort_consultation`  AS WITH ranked_programs AS (SELECT `p`.`Id_Program` AS `Id_Program`, `p`.`Program_Name` AS `Program_Name`, `ct`.`Cohort` AS `Cohort`, row_number() over ( partition by `p`.`Id_Program` order by `ct`.`Cohort` desc) AS `rn` FROM (`programs` `p` join `cohort` `ct` on(`p`.`Id_Program` = `ct`.`Id_Program`)) WHERE `p`.`Status` = 'Active' AND `ct`.`Status` = 'Active') SELECT `ranked_programs`.`Id_Program` AS `Id_Program`, `ranked_programs`.`Program_Name` AS `Program_Name`, `ranked_programs`.`Cohort` AS `Cohort` FROM `ranked_programs` WHERE `ranked_programs`.`rn` = 11  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `program_consultation`
--
DROP TABLE IF EXISTS `program_consultation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `program_consultation`  AS SELECT `p`.`Id_Program` AS `Id_Program`, concat(`pt`.`Acronyms_Program`,'-',`ur`.`Acronyms_Resource`,'-',`ur`.`Resource_Name`,'-',`au`.`Acronyms_Unit`,'-',`ct`.`Cohort`,'-',`p`.`Year`,'-',`o`.`Organization_Number`) AS `Program_Code`, `p`.`Program_Name` AS `Program_Name`, `p`.`Year` AS `Year`, `p`.`Comment_Programs` AS `Comment_Programs`, `p`.`Number_Hours` AS `Number_Hours`, `p`.`Approval_Date` AS `Approval_Date`, `ct`.`Id_Cohort` AS `Id_Cohort`, concat(`ct`.`Cohort`,' - ',case when `ct`.`Status` = 'Active' then 'Activo' else 'Inactivo' end) AS `Cohort`, `ct`.`Number_Females` AS `Number_Females`, `ct`.`Number_Males` AS `Number_Males`, `ct`.`Start_Date` AS `Start_Date`, `ct`.`Termination_Date` AS `Termination_Date`, `ct`.`Comment_Cohort` AS `Comment_Cohort`, `pt`.`Id_Program_Types` AS `Id_Program_Types`, `pt`.`Program_Type` AS `Program_Type`, `au`.`Id_Units` AS `Id_Units`, `au`.`Attached_Unit` AS `Attached_Unit`, `ur`.`Id_Resources` AS `Id_Resources`, `ur`.`Acronyms_Resource` AS `Acronyms_Resource`, `o`.`Id_Organization` AS `Id_Organization`, `o`.`Organization_Name` AS `Organization_Name`, `p`.`Date` AS `Date` FROM (((((`programs` `p` join `program_types` `pt` on(`pt`.`Id_Program_Types` = `p`.`Id_Program_Types`)) join `attached_units` `au` on(`au`.`Id_Units` = `p`.`Id_Units`)) join `unit_resources` `ur` on(`ur`.`Id_Resources` = `p`.`Id_Resources`)) join `organization` `o` on(`o`.`Id_Organization` = `p`.`Id_Organization`)) join `cohort` `ct` on(`ct`.`Id_Program` = `p`.`Id_Program`)) WHERE `pt`.`Status` = 'Active' AND `p`.`Status` = 'Active' AND `o`.`Status` = 'Active' AND `au`.`Status` = 'Active' AND `ur`.`Status` = 'Active' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `student_consultation`
--
DROP TABLE IF EXISTS `student_consultation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_consultation`  AS SELECT concat(`pt`.`Acronyms_Program`,'-',`ur`.`Acronyms_Resource`,'-',`ur`.`Resource_Name`,'-',`au`.`Acronyms_Unit`,'-',`ct`.`Cohort`,'-',`p`.`Year`,'-',`o`.`Organization_Number`,'-',`s`.`Identification_Document`) AS `Student_Code`, `s`.`Id_Student` AS `Id_Student`, `s`.`Document_Type` AS `Document_Type`, `s`.`Identification_Document` AS `Identification_Document`, `s`.`First_Name` AS `First_Name`, `s`.`Second_Name` AS `Second_Name`, `s`.`First_LastName` AS `First_LastName`, `s`.`Second_LastName` AS `Second_LastName`, `s`.`Email` AS `Email`, `s`.`Phone_Number` AS `Phone_Number`, `s`.`Gender` AS `Gender`, `s`.`Social_Network` AS `Social_Network`, `s`.`Comment_Student` AS `Comment_Student`, `sp`.`Id_Student_Programs` AS `Id_Student_Programs`, `sp`.`Id_Program` AS `Id_Program`, `p`.`Program_Name` AS `Program_Name`, `sp`.`Book` AS `Book`, `sp`.`Folio` AS `Folio`, `sp`.`Line` AS `Line`, `sp`.`Comment_SS` AS `Comment_SS`, `s`.`Date` AS `Date` FROM (((((((`student_programs` `sp` join `programs` `p` on(`p`.`Id_Program` = `sp`.`Id_Program`)) join `program_types` `pt` on(`p`.`Id_Program_Types` = `pt`.`Id_Program_Types`)) join `student` `s` on(`s`.`Id_Student` = `sp`.`Id_Student`)) join `organization` `o` on(`o`.`Id_Organization` = `p`.`Id_Organization`)) join `cohort_consultation` `ct` on(`ct`.`Id_Program` = `p`.`Id_Program`)) join `attached_units` `au` on(`au`.`Id_Units` = `p`.`Id_Units`)) join `unit_resources` `ur` on(`ur`.`Id_Resources` = `p`.`Id_Resources`)) WHERE `p`.`Status` = 'Active' AND `pt`.`Status` = 'Active' AND `s`.`Status` = 'Active' AND `o`.`Status` = 'Active' AND `au`.`Status` = 'Active' AND `ur`.`Status` = 'Active' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attached_units`
--
ALTER TABLE `attached_units`
  ADD PRIMARY KEY (`Id_Units`);

--
-- Indices de la tabla `cohort`
--
ALTER TABLE `cohort`
  ADD PRIMARY KEY (`Id_Cohort`),
  ADD KEY `Id_Program` (`Id_Program`);

--
-- Indices de la tabla `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`Id_Organization`),
  ADD KEY `Id_Responsible` (`Id_Responsible`);

--
-- Indices de la tabla `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`Id_Program`),
  ADD KEY `Id_Study_Types` (`Id_Program_Types`),
  ADD KEY `Id_Units` (`Id_Units`),
  ADD KEY `Id_Academy` (`Id_Organization`),
  ADD KEY `Id_Resources` (`Id_Resources`);

--
-- Indices de la tabla `program_types`
--
ALTER TABLE `program_types`
  ADD PRIMARY KEY (`Id_Program_Types`);

--
-- Indices de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  ADD PRIMARY KEY (`Id_Responsible`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Id_Student`);

--
-- Indices de la tabla `student_programs`
--
ALTER TABLE `student_programs`
  ADD PRIMARY KEY (`Id_Student_Programs`),
  ADD KEY `Id_Student` (`Id_Student`),
  ADD KEY `Id_Studies` (`Id_Program`);

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
-- AUTO_INCREMENT de la tabla `attached_units`
--
ALTER TABLE `attached_units`
  MODIFY `Id_Units` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cohort`
--
ALTER TABLE `cohort`
  MODIFY `Id_Cohort` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `organization`
--
ALTER TABLE `organization`
  MODIFY `Id_Organization` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programs`
--
ALTER TABLE `programs`
  MODIFY `Id_Program` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `program_types`
--
ALTER TABLE `program_types`
  MODIFY `Id_Program_Types` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `responsibles`
--
ALTER TABLE `responsibles`
  MODIFY `Id_Responsible` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `Id_Student` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `student_programs`
--
ALTER TABLE `student_programs`
  MODIFY `Id_Student_Programs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unit_resources`
--
ALTER TABLE `unit_resources`
  MODIFY `Id_Resources` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cohort`
--
ALTER TABLE `cohort`
  ADD CONSTRAINT `cohort_ibfk_1` FOREIGN KEY (`Id_Program`) REFERENCES `programs` (`Id_Program`);

--
-- Filtros para la tabla `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`Id_Responsible`) REFERENCES `responsibles` (`Id_Responsible`);

--
-- Filtros para la tabla `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`Id_Program_Types`) REFERENCES `program_types` (`Id_Program_Types`),
  ADD CONSTRAINT `programs_ibfk_2` FOREIGN KEY (`Id_Units`) REFERENCES `attached_units` (`Id_Units`),
  ADD CONSTRAINT `programs_ibfk_3` FOREIGN KEY (`Id_Organization`) REFERENCES `organization` (`Id_Organization`),
  ADD CONSTRAINT `programs_ibfk_4` FOREIGN KEY (`Id_Resources`) REFERENCES `unit_resources` (`Id_Resources`);

--
-- Filtros para la tabla `student_programs`
--
ALTER TABLE `student_programs`
  ADD CONSTRAINT `student_programs_ibfk_1` FOREIGN KEY (`Id_Student`) REFERENCES `student` (`Id_Student`),
  ADD CONSTRAINT `student_programs_ibfk_2` FOREIGN KEY (`Id_Program`) REFERENCES `programs` (`Id_Program`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `update_cohort_status` ON SCHEDULE EVERY 1 DAY STARTS '2025-03-14 16:37:52' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE cohort
    SET Status = 'Inactive'
    WHERE Termination_Date < CURRENT_DATE
    AND Status = 'Active';
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
