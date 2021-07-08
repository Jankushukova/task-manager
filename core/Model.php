<?php
	
	namespace Core;
	use Exception;
    use PDO;

    class Model{


		protected static function getConnection(){

            try{
                return  new PDO("mysql:host=". env('host') . ";dbname=".env('dbname'), env('user'), env('password'));

            }catch(Exception $e){
                echo $e->getMessage();
            }
	    }

	}

?>