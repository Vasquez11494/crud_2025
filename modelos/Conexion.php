<?php

abstract class Conexion {

    protected $conexion = null;
    public static function conexion(): PDO
    {
        if (!self::$conexion) {

            try {
               
                self::$conexion = new PDO('mysql:host=host.docker.internal;port=3309;dbname=tienda', 'root', 'root');
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "No hay conexion a la BD";
                echo "<br>";
                echo $e->getMessage();
                self::$conexion = null;
                exit;
            }
        }

        return self::$conexion;
    }

}
