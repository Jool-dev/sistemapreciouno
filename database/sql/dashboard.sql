-- conteo guias
SELECT COUNT(*) AS total_guias_emitidas
FROM guiaremision
WHERE estado != 'Eliminado';
-- conteo revisiones
SELECT COUNT(*) AS total_revisiones
FROM revisionguia;
-- guiassindaño
SELECT COUNT(DISTINCT g.idguia) AS guias_sin_danio
FROM guiaremision g
         JOIN detalleguia d ON g.idguia = d.idguia
WHERE d.condicion = 'Bueno' AND g.estado != 'Eliminado';
-- guiascondaño
SELECT COUNT(DISTINCT g.idguia) AS guias_con_danio
FROM guiaremision g
         JOIN detalleguia d ON g.idguia = d.idguia
WHERE d.condicion = 'Dañado' AND g.estado != 'Eliminado';
-- ultimas guias añadidas
SELECT fechaemision, COUNT(*) AS total_guias
FROM guiaremision
WHERE estado != 'Eliminado'
GROUP BY fechaemision
ORDER BY fechaemision ASC
    LIMIT 15;
