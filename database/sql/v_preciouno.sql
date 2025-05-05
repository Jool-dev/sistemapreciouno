-- crear vista vehiculos
create view v_vehiculo
as
select * from vehiculos;

-- crear vista productos
create view v_producto
as
select * from productos;

-- crear vista guiasderemision
create view v_guias_remision
as
select * from guias_remision;

-- crear vista revisiondeguias
create view v_detalle_guias
as
select * from detalle_guias;

-- crear vusuario
create view v_usuario as
select u.id as idusuario, u.name, u.email, u.password, u.idrol, r.nombre as rol from users as u left join roles as r on u.idrol = r.idrol
