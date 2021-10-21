<?php
session_start();
session_regenerate_id();

// var_dump($_POST);




$name = $_POST['name'];
$mail = $_POST['mail'];



require_once('../function/function.php');
xss($name);
xss($mail);




// バリエーション
$err = []; 
if($name === ""){
    $err['name'] = '名前を入力してください';
}

if($mail === ""){
    $err['mail'] = 'mailを入力してください';
}

$preg = "/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/";

if(!preg_match($preg,$mail)){
    $err['mail_spale'] = 'mailを正しく入力して下さい';
}

if($_POST['age'] === ""){
    $err['age'] = '年齢を入力して下さい';
    // var_dump($err['age']);
}else{
    $age = $_POST['age'];
    require_once('../function/function.php');
    xss($age);
    $age = intval($age);
    // var_dump($age);

}

if(!isset($_POST['gender'])){
    $err['gender'] = '性別を選んでください。';
}else{
    $gender = $_POST['gender'];
    require_once('../function/function.php');
    xss($gender);
    $gender = intval($gender);
    // var_dump($gender);
}
// var_dump($err);
// もし$errが0より大きければ登録画面に戻る、それ以外ならデータベースに登録しする。
if(count($err) > 0){
    $_SESSION = $err;
    // var_dump($_SESSION);
    header('Location:./add.php');
    
}else{

 require_once('../db_connection.php');
//    echo '登録が完了しました。';
}

try{
    $sql = 'INSERT INTO users(name,mail,age,gender) VALUE(:name,:mail,:age,:gender)';
    $stmt = $db -> prepare($sql);
    $stmt -> bindvalue(':name',$name,PDO::PARAM_STR);
    $stmt -> bindvalue(':mail',$mail,PDO::PARAM_STR);
    $stmt -> bindvalue(':age',$age,PDO::PARAM_INT);
    $stmt -> bindvalue(':gender',$gender,PDO::PARAM_STR);
    $stmt -> execute();
    echo 'データベースに登録完了';
}catch(PDOException $e){
    echo 'データベースに登録できません。'.$e->getMessage();
    exit();
}



?>