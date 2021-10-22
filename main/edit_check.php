<?php

session_start();
session_regenerate_id();

require_once('../function/function.php');
$id = $_POST['id'];
xss($id);
$id = intval($id);

$name = $_POST['name'];
xss($name);

$mail = $_POST['mail'];
xss($mail);

$age = $_POST['age'];
xss($age);
$age = intval($age);


$gender = $_POST['gender'];
xss($gender);
$gender = intval($gender);





$err = []; 
if($name === ""){
    $err['name'] = '名前が入力されていません。';
}


$preg = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";
if($mail === "" || !preg_match($preg,$mail)){
    $err['mail'] = 'mail正しくを入力されていません。';
}


if($age === ""){
    $err['age'] = '年齢が入力されていません。';
    // var_dump($err['age']);
}

if(!isset($gender)){
    $err['gender'] = '性別を選ばれていません。';
}


// var_dump($err);
// もし$errが0より大きければ登録画面に戻る、それ以外ならデータベースに登録しする。
if(count($err) > 0){
    $_SESSION = $err;
    // var_dump($_SESSION);
    header('Location:./edit.php');
    
}else{

require_once('../db_connection.php');
//    echo '登録が完了しました。';
}

try{
    $sql = 'UPDATE users SET name = :name, mail = :mail, age = :age, gender = :gender WHERE id = :id';
    $stmt = $db -> prepare($sql);
    $stmt -> bindvalue(':id',$id,PDO::PARAM_INT);
    $stmt -> bindvalue(':name',$name,PDO::PARAM_STR);
    $stmt -> bindvalue(':mail',$mail,PDO::PARAM_STR);
    $stmt -> bindvalue(':age',$age,PDO::PARAM_INT);
    $stmt -> bindvalue(':gender',$gender,PDO::PARAM_INT);
    $stmt -> execute();
    header('Location:./index.php');
}catch(PDOException $e){
    echo 'データベースに登録できません。'.$e->getMessage();
    exit();
}



?>