
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
if (isset($_POST["action"]) && ($_POST["action"] == "update")) {
    //檢查登入狀態
    if (isset($_SESSION["loginUserName"]) && ($_SESSION["loginUserName"] != "")) {
        $SQLQuery_updateArticle = "UPDATE articles SET title=?, language_id=?, tag_id=?, content=?, updated_at=NOW() WHERE article_id=?";
        $result_updateArticle = $db_link -> prepare($SQLQuery_updateArticle);
        $result_updateArticle -> bind_param("siisi", $_POST["articleTitle"], $_POST["articleLanguages"], $_POST["articleTags"], $_POST["articleContent"], $_POST["update_article_id"]);
        $result_updateArticle -> execute();
        $result_updateArticle -> close();
        $db_link -> close();
        
        //若修改文章失敗轉跳首頁(Msg：10)
        if(!$result_updateArticle){
            header("Location: myArticles.php?Msg=10");
        }else{//若修改文章成功轉跳首頁(Msg：9)
            header("Location: myArticles.php?Msg=9");
        }

    }else {//若尚未登入轉跳首頁
        header("Location: index.php?Msg=8");
    }
        
}




?>