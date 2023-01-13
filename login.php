<?php
/*
Msg 0:登出 1:登入失敗 2:登入成功 3:帳號已註冊 4:註冊成功 5:帳號未註冊
*/

//* 連結資料庫
include("connMySQL.php");

session_start();
//* 檢查是否有登入，若有則重新導向index.php
if (isset($_SESSION["loginUserName"]) && ($_SESSION["loginUserName"] != "")) {
    header("Location: index.php");
}
//* 執行會員登錄
if (isset($_POST["inputname"]) && isset($_POST["inputpasswd"])) {
    //* 聯繫登入會員資料 
    $SQLQuery_RecLogin = "SELECT username, password FROM members WHERE username=?";
    $result_RecLogin = $db_link->prepare($SQLQuery_RecLogin);
    $result_RecLogin->bind_param("s", $_POST["inputname"]);
    $result_RecLogin->execute();

    //* 取出帳號密碼的值 
    $result_RecLogin->bind_result($username, $password);
    $result_RecLogin->fetch();
    $result_RecLogin->close();
    //*檢查是否有資料
    if ($username == ""){
        header("Location: index.php?Msg=5");
    }else{
        //* 比對密碼， 若相同則登入成功
        if (password_verify($_POST["inputpasswd"],$password)) {
            //* 設定session
            $_SESSION["loginUserName"] = "$username";
            header("Location: index.php?Msg=2");
            //*Cookie
            if (isset($_POST["rememberme"]) && ($_POST["rememberme"] == "true")) {
                setcookie("remUser", $_POST["inputname"], time()+365*24*60);
                setcookie("remPass", $_POST["inputpasswd"], time()+365*24*60);
            } else {
                if(isset($_COOKIE["remUser"])){
                    setcookie("remUser", $_POST["inputname"], time()-100);
                    setcookie("remPass", $_POST["inputpasswd"], time()-100);
                }
            }
        }else{
            header("Location: index.php?Msg=1");
        }
    }
}
