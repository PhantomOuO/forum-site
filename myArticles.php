<!--測試區-->
<?php
include("connMySQL.php");

session_start();
//判斷是否已登入，若尚未登入轉跳回首頁
if (!isset($_SESSION["loginUserName"]) && ($_SESSION["loginUserName"] == "")) {
    header("Location: index.php?Msg=8");
}

//程式語言類別-資料庫搜尋 language:lang
$SQLQuery_language_all = "SELECT * FROM language_type WHERE 1";
$result_lang_all = $db_link->query($SQLQuery_language_all);

//程式標籤類別-資料庫搜尋 
$SQLQuery_tags = "SELECT * FROM tags_type WHERE 1";
$result_tags = $db_link->query($SQLQuery_tags);

//會員有發佈文章的程式語言類別-資料庫搜尋 language:lang
$SQLQuery_language = "SELECT language_type.language_id, language_type.language_name 
FROM language_type 
INNER JOIN articles on language_type.language_id = articles.language_id  WHERE articles.member_id = {$_SESSION["loginUserID"]}
Group By language_type.language_id, language_type.language_name ";
$result_lang = $db_link->query($SQLQuery_language);

//指定會員有發佈文章的程式語言類別(限制1筆)-資料庫搜尋 
$SQLQuery_language_limit = $SQLQuery_language . "LIMIT 0,1";
$result_language_limit = $db_link->query($SQLQuery_language_limit);
$row_result_language_limit = $result_language_limit->fetch_assoc();

//用戶選擇看板文章-資料庫搜尋 
//預設顯示程式看板 
//若無發布文章，預設看板為id:1
if(mysqli_num_rows($result_lang) == 0){
    $num_lang = 1;
}else{//若有發布文章，設為已發布文章第一筆
    $num_lang = $row_result_language_limit["language_id"];
}


//計算總看板數
$lang_totoal_records = $result_lang->num_rows;

//變更看板時 更新看板搜尋
if (isset($_GET["num_lang"])) {
    $num_lang = $_GET["num_lang"];
    //頁數重置至第一頁
}

//預設每頁筆數 4筆
$pageRow_records = 4;
//預設顯示頁數 
$num_pages = 1;
//變更頁數時 更新看板文章
if (isset($_GET["num_pages"])) {
    $num_pages = $_GET["num_pages"];
}
//紀錄本頁筆數
$startRow_records = ($num_pages - 1) * $pageRow_records;

//指定看板文章資料-資料庫搜尋 
$SQLQuery_articles = "SELECT article_id,members.username,language_type.language_id,language_type.language_name,tags_type.tag_id,tags_type.tag_name,articles.title,articles.content,articles.created_at,articles.updated_at
FROM articles
INNER JOIN members ON articles.member_id = members.member_id
INNER JOIN language_type ON articles.language_id = language_type.language_id
INNER JOIN tags_type ON articles.tag_id = tags_type.tag_id
WHERE articles.language_id = {$num_lang} and articles.member_id = {$_SESSION["loginUserID"]} ";
$result_articles_all = $db_link->query($SQLQuery_articles);

//指定看板文章資料(限制筆數)-資料庫搜尋 
$SQLQuery_articles_limit = $SQLQuery_articles . "LIMIT {$startRow_records},{$pageRow_records}";
$result_articles_limit = $db_link->query($SQLQuery_articles_limit);

//計算總筆數
$totoal_records = $result_articles_all->num_rows;
//計算總頁數
$totoal_pages = ceil($totoal_records / $pageRow_records);

?>

<!doctype html>
<html lang="zh-TW">

<head>
    <title>程式語言論壇網-我的文章</title>
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap SCSS v5.2.1 -->
    <link rel="stylesheet" href="scss/all.css">
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</head>

<body>
    <main>
        <nav class="navbar navbar-expand-lg mb-lg-4 navbar-light bg-primary2">
            <div class="container">
                <!-- 品牌logo -->
                <a class="navbar-brand text-white fw-bold" href="./myArticles.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-terminal" viewBox="0 0 16 16">
                        <path d="M6 9a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3A.5.5 0 0 1 6 9zM3.854 4.146a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z" />
                        <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h12z" />
                    </svg>
                    程式語言論壇網 - 我的文章
                </a>

                <!-- 第一部份：手機版 -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#linkbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- 第二部份：桌上型電腦版 -->
                <div class="collapse navbar-collapse justify-content-end" id="linkbar">
                    <!-- 下拉選項 -->
                    <ul class="navbar-nav">
                        <li><a class="nav-link text-white fw-bold" href="./index.php" id="navbarHome" role="button">回到首頁</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">會員中心</a>
                            <ul class="dropdown-menu dropdown-menu-end rounded-0 mt-2 bg-primary2" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-white fw-bold"><?php echo "ID：" . $_SESSION["loginUserName"]; ?></a></li>
                                <li>
                                    <hr class="dropdown-divider ">
                                </li>
                                <li>
                                    <?php echo "<a class='dropdown-item text-white' href='logout.php?logout=true'>登出</a>"; ?>
                                </li>
                                <li><a class="dropdown-item text-white" href="">我的文章</a></li>
                                <li><a class="dropdown-item text-white" href="">收藏文章</a></li>
                                <li><a class="dropdown-item text-white" href="">個人資料</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <!--? 修改文章成功訊息(Msg：9)  -->
        <?php if (isset($_GET["Msg"]) && ($_GET["Msg"] == "9")) { ?>
            <div class="position-relative me-4">
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show position-absolute top-0 end-0" role="alert" style="width: 350px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-check-fill  me-2" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                    </svg>
                    <div class="fs-5">文章修改成功 !</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <!--? 修改文章失敗訊息(Msg：10)  -->
        <?php if (isset($_GET["Msg"]) && ($_GET["Msg"] == "10")) { ?>
            <div class="position-relative me-4">
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show position-absolute top-0 end-0" role="alert" style="width: 350px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-x-fill me-2" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-4.854-1.354a.5.5 0 0 0 0 .708l.647.646-.647.646a.5.5 0 0 0 .708.708l.646-.647.646.647a.5.5 0 0 0 .708-.708l-.647-.646.647-.646a.5.5 0 0 0-.708-.708l-.646.647-.646-.647a.5.5 0 0 0-.708 0Z" />
                    </svg>
                    <div class="fs-5">文章修改失敗 !</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <!--? 刪除文章成功訊息(Msg：11)  -->
        <?php if (isset($_GET["Msg"]) && ($_GET["Msg"] == "11")) { ?>
            <div class="position-relative me-4">
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show position-absolute top-0 end-0" role="alert" style="width: 350px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill me-2" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg>
                    <div class="fs-5">您已刪除所選文章 !</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <!--? 刪除文章失敗訊息(Msg：12)  -->
        <?php if (isset($_GET["Msg"]) && ($_GET["Msg"] == "12")) { ?>
            <div class="position-relative me-4">
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show position-absolute top-0 end-0" role="alert" style="width: 350px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-exclamation-fill me-2" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1.5a.5.5 0 0 1-1 0V11a.5.5 0 0 1 1 0Zm0 3a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                    </svg>
                    <div class="fs-5">您尚未登入，無法執行操作 !</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>

        <div class="container-md mb-lg-2">
            <div class="row px-4">

                <!-- 左側看板島行列 -->
                <!-- 左側看板有時間補lg以下顯示下拉選單 -->
                <div class="col-lg-2" style="height: 900px;">
                    <div class="p-3 rounded-2 bg-light h-100">
                        <div class="h5 text-primary2 fw-bold ">已發佈文章看板</div>
                        <nav class="nav flex-column ">
                            <?php
                            while ($row_result_lang = $result_lang->fetch_assoc()) {
                                if ($row_result_lang["language_id"] == $num_lang) {
                                    echo "<a class='nav-link fw-bold text-white bg-primary2 rounded active' href='myArticles.php?num_lang= {$row_result_lang["language_id"]} '>" . $row_result_lang["language_name"] . "</a>";
                                } else {
                                    echo "<a class='nav-link text-black ' href='myArticles.php?num_lang= {$row_result_lang["language_id"]} '>" . $row_result_lang["language_name"] . "</a>";
                                }
                            }
                            ?>
                        </nav>
                    </div>
                </div>

                <!-- 右側容器 -->
                <div class="col-lg-10 ">
                    <div class="p-3 h-100 rounded-2 bg-light">
                        <div class="row justify-content-md-center">
                            <!--文章-->
                            <div class="col-lg-12 mt-4 mb-2">
                                <?php if((mysqli_num_rows($result_lang) == 0) && (mysqli_num_rows($result_articles_limit) == 0)) {
                                    echo "
                                    <div class='vstack gap-3 text-center'>
                                        <div class='bg-body-tertiary '>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-exclamation-octagon-fill text-danger' viewBox='0 0 16 16'>
                                            <path d='M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                                            </svg>
                                        </div>
                                        <div class='bg-body-tertiary'>
                                            <p class='  fs-5 fw-bold'>您尚未發佈過文章</p>
                                        </div>
                                    </div>";
                                } else { ?>
                                    <?php while ($row_result_articles = $result_articles_limit->fetch_assoc()) { ?>
                                        <div class="col-md-12">
                                            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-150 position-relative">
                                                <div class="col p-4 d-flex flex-column position-static">
                                                    <div class="hstack gap-2">
                                                        <strong class="d-inline-block mb-2 text-warning">#<?php echo $row_result_articles["article_id"] ?></strong>
                                                        <strong class="d-inline-block mb-2 text-primary2">#<?php echo $row_result_articles["language_name"] ?></strong>
                                                        <strong class="d-inline-block mb-2 text-primary2">#<?php echo $row_result_articles["tag_name"] ?></strong>
                                                        <button type="button" class="btn text-white btn-primary2 btn-sm mb-2 ms-auto" href="#" data-bs-toggle="modal" data-bs-target="#updateArticle" data-bs-id="<?php echo $row_result_articles["article_id"] ?>" data-bs-lang="<?php echo $row_result_articles["language_id"] ?>" data-bs-tag="<?php echo $row_result_articles["tag_id"] ?>" data-bs-title="<?php echo $row_result_articles["title"] ?>" data-bs-content="<?php echo $row_result_articles["content"] ?>">修 改</button>
                                                        <button type="button" class="btn text-white btn-secondary btn-sm mb-2" href="#" data-bs-toggle="modal" data-bs-target="#deleteArticle" data-bs-id="<?php echo $row_result_articles["article_id"] ?>" data-bs-title="<?php echo $row_result_articles["title"] ?>">刪 除</button>
                                                    </div>
                                                    <h5 class="mb-0"><?php echo $row_result_articles["title"] ?></h5>
                                                    <p class="card-text mb-auto"><?php echo mb_strimwidth($row_result_articles["content"], 0, 70) . " . . ." ?></p>
                                                    <div class="hstack gap-2" style="transform: rotate(0);">
                                                        <div class="mb-1 text-muted">創建時間：<?php echo $row_result_articles["created_at"] ?></div>
                                                        <div class="mb-1 text-muted ">|</div>
                                                        <div class="mb-1 text-muted">最後修改時間：<?php echo $row_result_articles["updated_at"] ?></div>
                                                        <a class="stretched-link ms-auto" type="button" href="#" data-bs-toggle="modal" data-bs-target="#showArticle" data-bs-id="<?php echo $row_result_articles["article_id"] ?>" data-bs-lang="<?php echo $row_result_articles["language_name"] ?>" data-bs-tag="<?php echo $row_result_articles["tag_name"] ?>" data-bs-username="<?php echo $row_result_articles["username"] ?>" data-bs-title="<?php echo $row_result_articles["title"] ?>" data-bs-content="<?php echo $row_result_articles["content"] ?>" data-bs-createdAt="<?php echo $row_result_articles["created_at"] ?>" data-bs-updatedAt="<?php echo $row_result_articles["updated_at"] ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-angle-expand text-black" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>

                            <!--刪除文章彈窗-->
                            <div class="modal fade " id="deleteArticle">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content rounded-4 shadow">
                                        <!-- Header -->
                                        <div class="modal-header p-5 pb-2 border-bottom-0 ">
                                            <h1 class="modal-title fw-bold mb-0 fs-2 ">刪除文章</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Body -->
                                        <div class="modal-body p-5 pt-0">
                                            <p class="article-Id fs-5 fw-bold m-2">文章編號：</p>
                                            <p class="article-Title fs-5 fw-bold m-2">文章標題：</p>
                                            <form class="delArticle" method="POST" action="deleteArticles.php">
                                                <div class="input-group">
                                                    <input type="hidden" id="article-Id-Acc-In" name="del_article_id">
                                                    <span class="input-group-text bg-light">驗 證</span>
                                                    <input type="text" class="form-control bg-light" id="article-Title-Acc-In" placeholder="請輸入完整文章標題" oninput="setCustomValidity('');" required>
                                                    <input type="hidden" id="action" name="action" value="delete">
                                                    <button class="btn btn-outline-secondary fw-bold text-white btn-danger" type="submit" id="button-addon2">刪 除</button>
                                                </div>
                                            </form>
                                            <div class=" text-danger fs-6 fw-bold mt-4 me-auto">
                                                <span class="badge text-bg-danger align-middle me-2">警告</span>
                                                刪除文章後將無法復原。
                                            </div>
                                        </div>
                                        <!-- Footer -->
                                        <!--<div class="modal-footer px-4" style="height:70px;">
                                            
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <!-- 刪除文章彈窗 結束 -->

                            <!-- 修改文章彈窗 -->
                            <div class="modal fade " id="updateArticle">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content rounded-4 shadow">
                                        <!-- Header -->
                                        <div class="modal-header p-5 pb-4 border-bottom-0 ">
                                            <h1 class="modal-title fw-bold mb-0 fs-2 ">修改文章</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Body -->
                                        <div class="modal-body p-5 pt-0">
                                            <form class="" method="POST" action="updateArticles.php">
                                                <div class="mb-3 ">
                                                    <label for="articleTitle" class="form-label">標 題</label>
                                                    <input type="form-title" class="form-control bg-light" id="articleTitle" name="articleTitle" minlength="5" maxlength="40" placeholder="請輸入標題... (最少5個字，最高40個字)" required>
                                                </div>
                                                <div class="row g-2 mb-2">
                                                    <div class="col-md">
                                                        <label for="articleLanguages" class="form-label">語言看板</label>
                                                        <div class="form-floating">
                                                            <select class="form-select bg-light" id="articleLanguages" name="articleLanguages" required>
                                                                <option selected></option>
                                                                <?php
                                                                while ($row_result_lang_all = $result_lang_all->fetch_assoc()) {
                                                                    echo "<option value='{$row_result_lang_all["language_id"]}'>" . $row_result_lang_all["language_name"] . "</option>";
                                                                }

                                                                ?>
                                                            </select>
                                                            <label for="articleTags">程式語言看板選擇</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <label for="articleTags" class="form-label">文章標籤</label>
                                                        <div class="form-floating">
                                                            <select class="form-select bg-light" id="articleTags" name="articleTags" required>
                                                                <option selected></option>
                                                                <?php
                                                                while ($row_result_tags = $result_tags->fetch_assoc()) {
                                                                    echo "<option value=' {$row_result_tags["tag_id"]} '>" . $row_result_tags["tag_name"] . "</option>";
                                                                } ?>
                                                            </select>
                                                            <label for="articleTags">文章標籤選擇</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="articleContent" class="form-label">內 容</label>
                                                    <textarea class="form-control bg-light" id="articleContent" name="articleContent" rows="3" style="height:400px;" placeholder="請輸入內文... (最少10個字，最高800個字)" minlength="10" maxlength="800" required></textarea>
                                                </div>
                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                        <input type="hidden" id="update-Id-Acc-In" name="update_article_id">
                                                        <input type="hidden" id="action" name="action" value="update">
                                                        <button class="btn btn-secondary me-md-2" type="reset">清 空</button>
                                                        <button class="btn text-white btn-primary2" type="submit">送 出</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 修改文章彈窗 結束 -->

                            <!--文章彈窗-->
                            <div class="modal fade " id="showArticle">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content rounded-4 shadow">
                                        <!-- Header -->
                                        <div class="modal-header p-5 pb-1 border-bottom-0">
                                            <h4 class="modal-title fs-2 fw-bold mb-0 me-2">標 題</h1>
                                                <span class="article badge text-white text-bg-warning me-1">#文章編號</span>
                                                <span class="lang badge text-white text-bg-primary2 me-1">#語言類型</span>
                                                <span class="tag badge text-white text-bg-primary2 me-1">#文章類型</span>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <!-- Body -->
                                        <div class="modal-body p-5 pt-0" style="height:450px;">
                                            <hr>
                                            <p class="content fs-5 text-wrap" style="word-break: break-all;"></p>
                                        </div>
                                        <!-- Footer -->
                                        <div class="modal-footer" style="height:50px;">
                                            <div class="spinner-grow spinner-grow-sm text-primary2" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="userName text-muted">發佈者：</div>
                                            <div class="createdAt text-muted">創建時間：</div>
                                            <div class="updatedAt text-muted">`最後修改時間：</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 文章彈窗 結束 -->
                            <!--翻頁-->
                            <div class="col-lg-12 ">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm justify-content-center">
                                        <?php for ($i = 1; $i <= $totoal_pages; $i++) {
                                            if ($i == $num_pages) {
                                                echo "<li class='page-item ' aria-current='page'>
                                                <span class='page-link text-white bg-primary2' href='myArticles.php?num_lang={$num_lang}&num_pages={$i}'>" . $i . "</span></li>";
                                            } else {
                                                echo "<li class='page-item'><a class='page-link'  href='myArticles.php?num_lang={$num_lang}&num_pages={$i}'>" . $i . "</a></li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- js -->
        <script>
            //個別文章彈窗 showArticle
            const showArticle = document.getElementById('showArticle')
            showArticle.addEventListener('show.bs.modal', event => {
                //觸發按鈕
                const button = event.relatedTarget
                //獲取data-bs 資料
                const article_id = button.getAttribute('data-bs-id')
                const username_id = button.getAttribute('data-bs-username')
                const lang_id = button.getAttribute('data-bs-lang')
                const tag_id = button.getAttribute('data-bs-tag')
                const title = button.getAttribute('data-bs-title')
                const content = button.getAttribute('data-bs-content')
                const created_at = button.getAttribute('data-bs-createdat')
                const updated_at = button.getAttribute('data-bs-updatedat')

                const modalTitle = showArticle.querySelector('.modal-title')
                const modalID = showArticle.querySelector('.modal-header span.article')
                const modaLang = showArticle.querySelector('.modal-header span.lang')
                const modaTag = showArticle.querySelector('.modal-header span.tag')
                const modaContent = showArticle.querySelector('.modal-body p.content')
                const modaUsername = showArticle.querySelector('.modal-footer div.userName')
                const modaCreatedAt = showArticle.querySelector('.modal-footer div.createdAt')
                const modaUpdatedAt = showArticle.querySelector('.modal-footer div.updatedAt')

                modalTitle.textContent = title
                modalID.textContent = `# ${article_id}`
                modaLang.textContent = `# ${lang_id}`
                modaTag.textContent = `# ${tag_id}`
                modaContent.textContent = content
                modaUsername.textContent = `發佈者： ${username_id} | `
                modaCreatedAt.textContent = `創建時間： ${created_at} | `
                modaUpdatedAt.textContent = `最後修改時間： ${updated_at}`
            })

            //刪除文章彈窗 deleteArticle
            var acc_Title = ''
            var acc_Id = '741'
            const deleteArticle = document.getElementById('deleteArticle');
            deleteArticle.addEventListener('show.bs.modal', event => {
                //觸發按鈕
                const button = event.relatedTarget;
                //獲取data-bs 資料
                const article_id = button.getAttribute('data-bs-id')
                const title = button.getAttribute('data-bs-title')
                const article_del = `deleteArticles.php?article_id=${article_id}`
                acc_Title = button.getAttribute('data-bs-title')
                acc_Id = button.getAttribute('data-bs-id')

                const modalTitle = deleteArticle.querySelector('.modal-body p.article-Title')
                const modalID = deleteArticle.querySelector('.modal-body p.article-Id')

                modalTitle.textContent = `標題：${title}`
                modalID.textContent = `編號：# ${article_id}`

            });

            //驗證標題
            const article_Title_Acc_In = document.getElementById("article-Title-Acc-In");
            article_Title_Acc_In.onchange = function() {
                myFunction();
            };

            function myFunction() {
                if (acc_Title != article_Title_Acc_In.value) {
                    article_Title_Acc_In.setCustomValidity('標題不吻合');
                    article_Title_Acc_In.reportValidity();
                } else {
                    const article_Id_Acc_In = document.getElementById("article-Id-Acc-In");
                    //article_Id_Acc_In.setAttribute('value',acc_Id);
                    article_Id_Acc_In.value = acc_Id;
                }
            }

            //修改文章彈窗 deleteArticle
            const updateArticle = document.getElementById('updateArticle')
            updateArticle.addEventListener('show.bs.modal', event => {
                //觸發按鈕
                const button = event.relatedTarget
                //獲取data-bs 資料
                const article_id = button.getAttribute('data-bs-id')
                const lang_id = button.getAttribute('data-bs-lang')
                const tag_id = button.getAttribute('data-bs-tag')
                const title = button.getAttribute('data-bs-title')
                const content = button.getAttribute('data-bs-content')

                const modalID = document.getElementById("update-Id-Acc-In");
                const modalTitle = document.getElementById("articleTitle");
                const modaLang = document.getElementById("articleLanguages");
                const modaTag = document.getElementById("articleTags");
                const modaContent = document.getElementById("articleContent");

                modalID.value = article_id;
                modalTitle.value = title;
                modaContent.value = content;
                modaLang.options[lang_id].selected = true;
                modaTag.options[tag_id].selected = true;
                console.log(modaLang.value);
                console.log(lang_id);
            })
        </script>
    </main>
</body>

</html>