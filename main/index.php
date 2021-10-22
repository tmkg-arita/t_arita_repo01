<?php 
    require_once('../db_connection.php');
    try{
        $recods = $db -> query('SELECT * FROM users');
        
        

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
    <link rel="stylesheet" href="../css/style2.css">
    <title>一覧画面</title>
</head>
<body>
    <header>
        <h1>一覧画面</h1>
    </header>

    
    <table border="1" style="border-collapse: collapse">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>mail</th>
            <th>age</th>
            <th>gender</th>
            <th class = "choice1">edit</th>
            <th class = "choice2">delete</th>
        </tr>
        <?php foreach($recods as $recod => $val):?>
            <?php require_once('../function/function2.php')?>
        <tr>
            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['name'];?></td>
            <td><?php echo $val['mail'];?></td>
            <td><?php echo $val['age'];?></td>
            <td><?php echo gen($val['gender']);?></td>
            <form action = "./edit.php" method="post">
            <td><input type ="submit" name ="edit" value="編集"></td>
            <input type="hidden" name= id value="<?php echo $val['id'];?>"> 
            </form>
            <form action = "./delete.php" method="post">
            <td><input type ="submit" name ="delete" value="削除"></td>
            <input type = "hidden" name ="id" value="<?php echo $val['id'];?>" >
            </form>
        </tr>
        <?php endforeach ;?> 

    </table>
    

    <a href="./add.php">登録画面へ</a>