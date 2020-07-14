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
-- Create function `FU_CALCULAR_DISTANCIA`
--
CREATE DEFINER = 'root'@'localhost'
FUNCTION FU_CALCULAR_DISTANCIA (`v_latitud_origen` double,
`v_latitud_destino` double,
`v_longitud_origen` double,
`v_longitud_destino` double)
RETURNS float
COMMENT 'Funcion para calular la distancia entre dos puntos | devolucion en KM'
BEGIN

  RETURN (SELECT
      (ACOS(SIN(RADIANS(v_latitud_origen)) * SIN(RADIANS(v_latitud_destino)) +
      COS(RADIANS(v_latitud_origen)) * COS(RADIANS(v_latitud_destino)) *
      COS(RADIANS(v_longitud_origen) - RADIANS(v_longitud_destino))) * 6378) AS
      DISTANCE);

END
$$

DELIMITER ;