<?php
/*
Msg 0:登出 1:登入失敗 2:登入成功 3:帳號已註冊 4:註冊成功 5:帳號未註冊 
    6:發布文章成功 7:發布文章失敗 8:未登入 
    9：修改文章成功 10：修改文章失敗 11：刪除文章成功 12：刪除文章失敗
*/

//* 連結資料庫
include("connMySQL.php");
session_start();
//* 檢查表單是否有送出
if (isset($_POST["action"]) && ($_POST["action"] == "addArticle")) {
    //* 檢查是否有登入
    if (isset($_SESSION["loginUserName"]) && ($_SESSION["loginUserName"] != "")) {
        $SQLQuery_addArticle = "INSERT INTO articles (member_id, title, content, language_id, tag_id) VALUES (?, ?, ?, ?, ?)";
        $result_addArticle = $db_link -> prepare($SQLQuery_addArticle);
        $result_addArticle -> bind_param("issii", $_SESSION["loginUserID"], $_POST["articleTitle"], $_POST["articleContent"], $_POST["articleLanguages"], $_POST["articleTags"]);
        $result_addArticle -> execute();
        $result_addArticle -> close();
        $db_link -> close();
        
        //若新增文章失敗轉跳首頁(Msg：7)
        if(!$result_addArticle){
            header("Location: index.php?Msg=7");
        }else{//若新增文章成功轉跳首頁(Msg：6)
            header("Location: index.php?Msg=6");
        }
    }else {//若尚未登入轉跳首頁
        header("Location: index.php?Msg=8");
    }
        
}


?>

