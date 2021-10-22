<?php

var_dump($_POST);

$id = $_POST['id'];

var_dump($id);

$id = intval($id);

require_once('../db_connection.php');

try{
    $sql = 'DELETE FROM users WHERE id = :id';
    $stmt = $db -> prepare($sql);
    $stmt -> bindvalue(':id',$id,PDO::PARAM_INT); 
    $stmt -> execute();
    header('Location:./index.php');

}catch(PDOException $e){
    echo 'データベースで削除失敗'.$e -> getMessage();
    exit();
}


?>