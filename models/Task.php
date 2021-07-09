<?php

namespace Models;

use Core\Model;
use Exception;
use PDO;
use PDOStatement;

class Task extends Model {



    public static function insert($task){

        try{

            $query = static::getConnection()->prepare(
                "INSERT INTO tasks (id, username, email, description) 
					 VALUES (NULL, :username, :email, :description)
					"
            );

            $query->execute(array(
                "username"=>$task['username'],
                "email"=>$task['email'],
                "description"=>$task['description']
            ));

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

    public static function getAll($page = null, $sort_param = null, $sort_order = null){

        $result = new \stdClass();

        try{


            $stmt = "SELECT * FROM tasks";
            $query = static::getConnection()
                ->prepare($stmt);
            $query->execute();

            $number_of_result = $query->rowCount();
            $per_page =  env('perPage');
            $number_of_page = ceil ($number_of_result / $per_page);
            $pages_before = ($page-1) * $per_page;

            if ($sort_param){
                $stmt .= " order by $sort_param $sort_order";
            }
            $stmt .= " LIMIT $pages_before, $per_page";

            $query = static::getConnection()
                ->prepare($stmt);
            $query->execute();
            $result->data = $query->fetchAll();
            $result->count = $number_of_page;

        }catch(Exception $e){
            echo $e->getMessage();
        }

        return $result;

    }


    public static function find($id){

        $result = null;

        try{

            $query = static::getConnection()->prepare("SELECT * FROM tasks WHERE id = :id");

            $query->execute(array("id"=>$id));
            $result = $query->fetch();

        }catch(Exception $e){
            echo $e->getMessage();
        }

        return $result;

    }

    public static function update($task){

        try{

            $query = static::getConnection()->prepare(
                "UPDATE tasks SET username = :username, email = :email, description = :description, status = :status, edited = :edited WHERE id = :id"
            );

            $query->execute(array(
                "username"=>$task['username'],
                "email"=>$task['email'],
                "description"=>$task['description'],
                "id"=>$task['id'],
                "status"=>$task['status'],
                "edited"=>$task['edited'],

            ));

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

}

?>