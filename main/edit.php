<?php
session_start();
session_regenerate_id();

// var_dump($_SESSION);

$SESSION = array();

session_destroy();


// var_dump($_POST);
$id = $_POST['id'];
require_once('../function/function.php');
$id = xss($id);
$id = intval($id);

// var_dump($id);



require_once('../db_connection.php');
try{
    $sql = "SELECT * FROM users WHERE id = $id";
    $stmt = $db -> prepare($sql);
    $stmt  -> execute();
    foreach($stmt as $re){
        require_once('../function/function.php');
        
        $id = $re['id'];
        xss($id);
        $name = $re['name'];
        xss($name);
        
        $mail = $re['mail'];
        xss($name);
        
        $age = $re['age'];
        xss($name);
        $gender = $re['gender'];
        xss($name);
    }
    

}catch(PDOException $e){
    echo 'データを参照できませんでした。'.$e -> getMessage();
    exit();

}






?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>更新画面</title>
</head>
<body>
    <header>
        <h1>更新画面</h1>
    </header>
    <main>
        <form action="./edit_check.php" method="post">
            <ul>
                <!-- idはDBから取得して表示する -->
                <li>id:&emsp;<input type ="int" name="id" readonly value="<?php echo $id;?>"></li></br>
                <?php if(!isset($_SESSION['name'])):?>
                        <li>name:　<input type="text" name="name"></li></br>
                    
                        <?php elseif(isset($_SESSION)):?>
                            <li>name:　<input type="text" name="name"></li></br>
                            <p class="den"><?php echo $_SESSION['name'];?></p>
                     <?php endif;?>
                    
                     <?php if(!isset($_SESSION['mail'])):?>
                        <li>email:　<input type="email" name="mail"></li></br>
                      
                        <?php elseif(isset($_SESSION)):?>
                            <li>email:　<input type="email" name="mail"></li></br>
                             <p class="den"><?php echo $_SESSION['mail'];?></p>
                     <?php endif;?>
                    
                    <?php if(!isset($_SESSION['age'])):?>
                        <li>age:　   <input type="int" name="age"></li></br>
                        <?php elseif(isset($_SESSION)):?>
                            <li>age:　   <input type="int" name="age"></li></br>
                            <p class="den"><?php echo $_SESSION['age'];?></p>
                        <?php endif;?>
            </ul>
            
            <?php if($gender === 0):?>
             gender:　<input type="radio" name="gender" value="0" checked>男
                      <input type="radio" name="gender" value="1">女</br>
                      
            <?php elseif($gender === 1):?>
             gender:　<input type="radio" name="gender" value="0">男
                      <input type="radio" name="gender" value="1" checked>女</br>
                      <?php endif;?>

                   <input class ="button" type="submit" value="登録">
                    
        </form></br>
        <a href="./index.php">一覧に戻る</a>
    </main>
</body>
</html>

<!-- genderはsessionでそのままの値を -->
<!-- idをsessionに入れてやらなければならない -->