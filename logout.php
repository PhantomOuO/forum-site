<?php

session_start();

//*執行登出動作
if (isset($_GET["logout"]) && ($_GET["logout"]=="true")) {
    unset($_SESSION["loginUserName"]);
    header("Location: index.php?Msg=0");
}

?>