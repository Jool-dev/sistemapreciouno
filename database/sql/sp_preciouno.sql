-- Procedimiento almacenado para insertar usuarios
CREATE PROCEDURE `sp_usuarioinsertar`(
    spname varchar(255),
    spemail varchar(255),
    sppassword varchar(255),
    spidrol int,
    OUT id INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO users(name, email, password, idrol)
values(spname, spemail, sppassword, spidrol);

if Row_count() > 0 then
		SET id = LAST_INSERT_ID();
		set success = 1;
        set message = "Usuario Registrado Correctente";
else
		SET id = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL USUARIO";
end if;
END;

-- Procedimiento almacenado para insertar vehiculos
CREATE PROCEDURE `sp_vehiculoinsertar`(
    spplaca varchar(10),
    spmarca varchar(50),
    sptipo varchar(50),
    OUT idvehiculo INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO vehiculos(placa, marca, tipo, estado)
values(spplaca, spmarca, sptipo, "Activo");

if Row_count() > 0 then
		SET idvehiculo = LAST_INSERT_ID();
		set success = 1;
        set message = "Vehiculo Registrado Correctente";
else
		SET idvehiculo = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL VEHICULO";
end if;
END;

-- Procedimiento almacenado para insertar transportes
CREATE PROCEDURE `sp_transporteinsertar`(
    spruc_transportista varchar(10),
    spnombre_razonsocial varchar(50),
    OUT idtransportista INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO transporte(ruc_transportista, nombre_razonsocial, estado)
values(spruc_transportista, spnombre_razonsocial, "Activo");

if Row_count() > 0 then
		SET idtransportista = LAST_INSERT_ID();
		set success = 1;
        set message = "Transporte Registrado Correctente";
else
		SET idtransportista = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL TRANSPORTE";
end if;
END;

-- Procedimiento almacenado para insertar conductores
CREATE PROCEDURE `sp_conductoresinsertar`(
    spnombre varchar(50),
    spdni varchar(8),
    spidtransportista int,
    spidvehiculo int,
    OUT idconductor INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO conductores(nombre, dni, estado, idtransportista, idvehiculo)
values(spnombre, spdni, 'Activo', spidtransportista, spidvehiculo);

if Row_count() > 0 then
		SET idconductor = LAST_INSERT_ID();
		set success = 1;
        set message = "OK";
else
		SET idconductor = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL CONDUCTOR";
end if;
END;

-- Procedimiento almacenado para insertar productos
CREATE PROCEDURE `sp_productosinsertar`(
    spcodigoproducto varchar(20),
    spnombre varchar(50),
    sptipoinventario varchar(50),
    spfecharegistro datetime,
    OUT idproducto INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO productos(codigoproducto, nombre, tipocodproducto, tipoinventario, fecharegistro, estado)
values(spcodigoproducto, spnombre, 'Fijo', sptipoinventario, spfecharegistro, 'Activo');

if Row_count() > 0 then
		SET idproducto = LAST_INSERT_ID();
		set success = 1;
        set message = "OK";
else
		SET idproducto = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL PRODUCTO";
end if;
END;

-- Procedimiento almacenado para insertar guia de revision
CREATE PROCEDURE sp_guiaremision(
    spcodigoguia varchar(20),
    spfechaemision date,
    sphoraemision time,
    sprazonsocialguia varchar(100),
    spnumerotrasladotim varchar(20),
    spmotivotraslado varchar(100),
    sppesobrutototal decimal(10,2),
    spvolumenproducto decimal(10,2),
    spnumerobultopallet int,
    spobservaciones varchar(255),
    spidconductor INT,
    spidtipoempresa INT,
    OUT idguia INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO guiaremision(codigoguia ,fechaemision ,horaemision ,razonsocialguia ,numerotrasladotim ,motivotraslado ,pesobrutototal ,volumenproducto, numerobultopallet, observaciones, idconductor, idtipoempresa)
values(spcodigoguia ,spfechaemision ,sphoraemision ,sprazonsocialguia ,spnumerotrasladotim ,spmotivotraslado ,sppesobrutototal ,spvolumenproducto, spnumerobultopallet, spobservaciones, spidconductor, spidtipoempresa);

if Row_count() > 0 then
		SET idguia = LAST_INSERT_ID();
		set success = 1;
        set message = "OK";
else
		SET idguia = 0;
		set success = 0;
        set message = "NO SE REGISTRO LA GUIA DE REMISION";
end if;
END;



CREATE PROCEDURE `sp_detaleguiaremisioninsertar`(
    spidguia int,
    spidproducto int,
    spcondicion varchar(20),
    spcant int,
    OUT iddetalleguia INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
insert into detalleguia(idguia, idproducto, condicion, cantrecibida)
values(spidguia, spidproducto, spcondicion, spcant);

if Row_count() > 0 then
			SET iddetalleguia = LAST_INSERT_ID();
			set success = 1;
			set message = "detalleguia Registrado Correctente";
else
			SET iddetalleguia = 0;
			set success = 0;
			set message = "NO SE REGISTRO EL detalleguia";
end if;
END;
