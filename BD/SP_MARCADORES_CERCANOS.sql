-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Set default database
--
USE puntos;

DELIMITER $$

--
-- Create procedure `SP_MARCADORES_CERCANOS`
--
CREATE DEFINER = 'root'@'localhost'
PROCEDURE SP_MARCADORES_CERCANOS (IN `idMarcador` int,
IN `scope` int)
BEGIN

  SET @latitudMarcador = (SELECT
      m.latitud_marcador
    FROM marcadores m
    WHERE id = idMarcador);
  SET @longitudMarcador = (SELECT
      m.longitud_marcador
    FROM marcadores m
    WHERE id = idMarcador);


  SELECT
    m.id,
    m.titulo_marcador,
    m.latitud_marcador,
    m.longitud_marcador,
    CONCAT((SELECT
        ROUND(FU_CALCULAR_DISTANCIA(@latitudMarcador, m.latitud_marcador, @longitudMarcador, m.longitud_marcador), 2)), ' Km.') AS distance
  FROM marcadores m
  WHERE m.id <> idMarcador
  ORDER BY distance ASC
  LIMIT 0, scope;


END
$$

DELIMITER ;