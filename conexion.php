<?php

/*Extendiendo la clase PDO. */
class Conexion extends PDO{
   private $hostbd = 'localhost';
   private $nombrebd = 'yuriar';
    private $usuariobd = 'root';
   private $passwordbd = '';

   public function __construct(){
      try{
          /* Llamar al constructor principal*/
            parent::__construct('mysql:host='.$this->hostbd.';dbname='.$this->nombrebd .';charset=utf8', $this->usuariobd, $this->passwordbd,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      }catch(PDOException $e){
         echo 'Ha ocurrido un error con la base de datos: ' . $e->getMessage();
         exit;
      }
    }
}