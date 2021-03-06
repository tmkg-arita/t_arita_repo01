<?php
session_start();
session_regenerate_id();

// var_dump($_SESSION);

$SESSION = array();

session_destroy();


// var_dump($_POST);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>登録画面</title>
</head>
<body>
    <header>
        <h1>登録画面</h1>
    </header>
    <main>
        <form action="./check.php" method="post">
            <ul>
                <!-- idはDBから取得して表示する -->
                <li>id:</li></br>
                    
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
            <?php if(!isset($_SESSION['gender'])):?>
                        gender:　
                        <input type="radio" name="gender" value="0">男
                        <input type="radio" name="gender" value="1">女</br>
                    
                        <?php elseif(isset($_SESSION)):?>
                        gender:　<input type="radio" name="gender" value=0>男
                        <input type="radio" name="gender" value="1">女
                        <p class="den"><?php echo $_SESSION['gender'];?></p></br>
                    <?php endif;?>
                     <input class ="button" type="submit" value="登録">
                    
        </form></br>
        <a href="./index.php">一覧に戻る</a>
    </main>
</body>
</html>
