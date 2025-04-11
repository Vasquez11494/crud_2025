
CREATE TABLE clientes (
    cli_id INT AUTO_INCREMENT PRIMARY KEY,
    cli_nombres VARCHAR(250) NOT NULL,
    cli_apellidos VARCHAR (250) NOT NULL,
    cli_telefono INT NOT NULL,
    cli_nit INT NOT NULL,
    cli_situacion SMALLINT DEFAULT 1
);