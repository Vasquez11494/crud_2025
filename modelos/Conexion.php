<?php

abstract class Conexion {

    protected static $conexion = null;

    public static function conectar(): PDO
    {
        if (!self::$conexion) {
            try {
                self::$conexion = new PDO(
                    'mysql:host=host.docker.internal;port=3309;dbname=tienda',
                    'root',
                    'root'
                );
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "No hay conexión a la BD<br>" . $e->getMessage();
                self::$conexion = null;
                exit;
            }
        }

        return self::$conexion;
    }

    
    public function ejecutar($sql)
    {
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $resultado = $sentencia->execute();
        $idInsertado = $conexion->lastInsertId();
        return [
            "resultado" => $resultado,
            "id" => $idInsertado
        ];
    }

    // METODO PARA CONSULTAR INFORMACION
    public function servir($sql)
    {
        $conexion = self::conectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $datos = [];
        foreach ($data as $k => $v) {
            $datos[] = array_change_key_case($v, CASE_LOWER);
        }


        return $datos;
    }

    public static function getConexion(): PDO
    {
        self::conectar();
        return self::$conexion;
    }
    
    
}
