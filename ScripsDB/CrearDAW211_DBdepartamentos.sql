-- Crear base de datos --
    CREATE DATABASE if NOT EXISTS Departamentos;
-- Uso de la base de datos. --
    USE Departamentos;

-- Crear tablas. --
    CREATE TABLE IF NOT EXISTS Departamento(
        CodDepartamento varchar(3) PRIMARY KEY,
        DescDepartamento varchar(255),      
        VolumenNegocio float 
    );   

-- Crear del usuario --
    CREATE USER IF NOT EXISTS 'admin2'@'localhost' identified BY 'paso'; 

-- Dar permisos al usuario --
    GRANT ALL PRIVILEGES ON Departamentos.* TO 'admin2'@'localhost'; 

-- Hacer el flush privileges, por si acaso --
    FLUSH PRIVILEGES;
