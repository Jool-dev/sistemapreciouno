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
