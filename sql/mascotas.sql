CREATE TABLE mascotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    tipo VARCHAR(255),
    sexo VARCHAR(10),
    fecha_nacimiento DATE,
    raza VARCHAR(255),
    tamaño VARCHAR(20),
    color VARCHAR(20),
    trama VARCHAR(20),
    foto BLOB
); ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
--
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`ID`);
COMMIT;
