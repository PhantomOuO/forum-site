<?php
/*
Msg 0:登出 1:登入失敗 2:登入成功 3:帳號已註冊 4:註冊成功 5:帳號未註冊
*/

//* 連結資料庫
include("connMySQL.php");

if (isset($_POST["action"]) && ($_POST["action"] == "join")) {
    //指定帳號資料-資料庫搜尋
    $SQLQuery_RecFindUer = "SELECT username FROM members WHERE username = '{$_POST["username"]}'";
    $result_RecFindUser = $db_link -> query($SQLQuery_RecFindUer);

    //判斷帳號是否已被註冊(比數若大於0則已被註冊)
    if ($result_RecFindUser -> num_rows > 0) {
        header("Location: index.php?Msg=3");
    }else {//執行新增帳號
        $SQLQuery_insert = "INSERT INTO members (username, password, email) VALUES (?, ?, ?)";
        $result_insert = $db_link -> prepare($SQLQuery_insert);
        $result_insert -> bind_param("sss", $_POST["username"] ,password_hash($_POST["userpassword"], PASSWORD_DEFAULT),  $_POST["useremail"]);
        $result_insert -> execute();
        $result_insert -> close();
        $db_link -> close();
        header("Location: index.php?Msg=4&signName={$_POST['username']}");
    }
}
?>