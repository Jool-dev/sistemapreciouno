-- Creación de los roles (usando el nombre de columna correcto 'nombre' en lugar de 'nombrerol')
INSERT INTO roles(nombre) VALUES
                              ('administrador'),
                              ('prevencionista');

-- Insertamos usuarios por defecto (con todos los campos requeridos)
INSERT INTO users(name, email, password, idrol, email_verified_at, remember_token, created_at, updated_at) VALUES
                                                                                                               (
                                                                                                                   'administrador',
                                                                                                                   'admin@preciouno.com',
                                                                                                                   '$2y$12$ULuC2R9E0Ot7E/uLw3VguuTXepVpWC176Ovb/43V8SnSltA6Q.wJO',
                                                                                                                   1,
                                                                                                                   NOW(),
                                                                                                                   NULL,
                                                                                                                   NOW(),
                                                                                                                   NOW()
                                                                                                               ),
                                                                                                               (
                                                                                                                   'prevencionista',
                                                                                                                   'prevencionista@preciouno.com',
                                                                                                                   '$2y$12$ULuC2R9E0Ot7E/uLw3VguuTXepVpWC176Ovb/43V8SnSltA6Q.wJO',
                                                                                                                   2,
                                                                                                                   NOW(),
                                                                                                                   NULL,
                                                                                                                   NOW(),
                                                                                                                   NOW()
                                                                                                               );
-- conductores
-- insert into conductores(nombre,dni,estado)values('pedro', '12345678', "Activo");
-- insert into conductores(nombre,dni,estado)values('Rodrigo', '36573921', "Activo");
-- insert into conductores(nombre,dni,estado)values('Joustin', '95724124', "Activo");

-- vehiculos
-- insert into vehiculos(placa, marca, tipo, estado)values("1234", "Honda", "Excelente", "Activo");
-- insert into vehiculos(placa, marca, tipo, estado)values("$9u43", "Mavila", "Excelente", "Activo");
-- insert into vehiculos(placa, marca, tipo, estado)values("#gyt4", "Zonshen", "Excelente", "Activo");
-- insert into vehiculos(placa, marca, tipo, estado)values("4h3h3", "Xtz", "Excelente", "Activo");
-- insert into vehiculos(placa, marca, tipo, estado)values("00=ne", "Escarabajo", "Excelente", "Activo");

-- tipoempresa
INSERT INTO tipoempresa (direccion, provincia, departamento, ubigeo, razonsocial, ruc, codigoestablecimiento, estado) VALUES
                                                                                                                          ('Av. Centenario No. 2086', 'CORONEL PORTILLO', 'UCAYALI', '150118', 'HIPERMERCADOS TOTTUS ORIENTE S.A.C', '20393864886', '', 'ACTIVO');
-- transporte
INSERT INTO transporte (ruc_transportista, nombre_razonsocial, estado) VALUES
                                                                           ('20604158657', 'AyS DISTRIBUCIONES E.I.R.L', 'Activo');
