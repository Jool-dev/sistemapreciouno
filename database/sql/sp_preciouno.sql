CREATE PROCEDURE `sp_vehiculoinsertar`(
    spplaca varchar(50),
    spmarca varchar(50),
    sptipo varchar(50),
    OUT idvehiculo INT,
    OUT success bit,
    out message varchar(100)
)
BEGIN
INSERT INTO vehiculos(placa, marca, tipo)
values(spplaca, spmarca, sptipo);

if Row_count() > 0 then
		SET idvehiculo = LAST_INSERT_ID();
		set success = 1;
        set message = "OK";
else
		SET idvehiculo = 0;
		set success = 0;
        set message = "NO SE REGISTRO EL VEHICULO";
end if;
END;
