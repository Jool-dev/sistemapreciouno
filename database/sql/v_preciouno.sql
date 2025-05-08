-- crear vista transporte
create view v_transporte
as
select * from transporte;

-- crear vista vehiculos
create view v_vehiculo
as
select * from vehiculos;

-- crear vista conductores
create view v_conductores
as
select * from conductores;

-- crear vista tipoempresa
create view v_tipoempresa
as
select * from tipoempresa;

-- crear vista productos
create view v_producto
as
select * from productos;

-- crear vista guiasderemision
create view v_guiaremision
as
select * from guiaremision;

-- crear vista revisiondeguias
create view v_detalleguia
as
select * from detalleguia;

-- crear vista usuario
create view v_usuario as
select u.id as idusuario, u.name, u.email, u.password, u.idrol, r.nombre as rol from users as u left join roles as r on u.idrol = r.idrol;
