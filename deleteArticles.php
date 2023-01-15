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
if (isset($_POST["action"]) && ($_POST["action"] == "delete")) {
    //*檢查登入狀態
    if (isset($_SESSION["loginUserName"]) && ($_SESSION["loginUserName"] != "")) {
        $SQLQuery_delArticle = "DELETE FROM articles WHERE article_id=?";
        $result_delArticle = $db_link -> prepare($SQLQuery_delArticle);
        $result_delArticle -> bind_param("i", $_POST["del_article_id"]);
        $result_delArticle -> execute();
        $result_delArticle -> close();
        $db_link -> close();
        
        //若刪除文章失敗轉跳首頁(Msg：12)
        if(!$result_delArticle){
            header("Location: myArticles.php?Msg=12");
        }else{//若刪除文章成功轉跳首頁(Msg：11)
            header("Location: myArticles.php?Msg=11");
        }

    }else {//若尚未登入轉跳首頁
        header("Location: index.php?Msg=8");
    }
        
}




?>