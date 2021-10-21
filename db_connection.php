<?php
   try{
    $dbh = 'mysql:dbname=git_test;host=localhost;charset=utf8';
    $user = 'root';
    $pass = '';
    $db = new PDO($dbh,$user,$pass,[PDO::ATTR_DEFAULT_FETCH_MODE
                                    => PDO::FETCH_ASSOC,
                                    PDO::ATTR_ERRMODE
                                    =>PDO::ERRMODE_EXCEPTION,
                                    PDO::ATTR_EMULATE_PREPARES
                                    =>false]);
        // echo '接続OK';
        }catch(PDOException $e){
            echo 'データベースに接続できません。'.$e->getMessage();
            exit();
        }

?>