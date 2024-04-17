CREATE TABLE `due` (
  `ID` int(100) NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`),  
  `nombre` varchar(120) NOT NULL,
  `apellido` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `telefono` varchar(120) NOT NULL,
  `direccion` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--
--
ALTER TABLE `due`
  ADD PRIMARY KEY (`ID`);
COMMIT;
