<!--測試區-->
<?php
include("connMySQL.php");

//程式語言類別-資料庫搜尋 language:lang
$SQLQuery_language = "SELECT * FROM language_type WHERE 1";
$result_lang = $db_link->query($SQLQuery_language);

//用戶選擇看板文章-資料庫搜尋 
//預設顯示程式看板 (預設lang_type:1 HTML)
$num_lang = 1;
//變更看板時更新看板搜尋
if (isset($_GET["num_lang"])) {
  $num_lang = $_GET["num_lang"];
  //頁數重置至第一頁
  $num_pages = 1;
}


//預設每頁筆數 5筆
$pageRow_records = 5;
//預設顯示頁數 
$num_pages = 1;
//變更頁數時更新看板文章
if(isset($_GET["num_pages"])){
  $num_pages = $_GET["num_pages"];
}
//紀錄本頁筆數
$startRow_records = ($num_pages - 1) * $pageRow_records;
//指定看板文章資料-資料庫搜尋 
$SQLQuery_articles = "SELECT * FROM articles WHERE language_id = {$num_lang} ";
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
  <title>test Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap SCSS v5.2.1 -->
  <link rel="stylesheet" href="scss/all.css">
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</head>

<body>
  <main>
    <nav class="navbar navbar-expand-lg mb-sm-4 navbar-light bg-primary2">
      <div class="container">
        <!-- 品牌logo -->
        <a class="navbar-brand text-danger" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-terminal" viewBox="0 0 16 16">
            <path d="M6 9a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3A.5.5 0 0 1 6 9zM3.854 4.146a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z" />
            <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h12z" />
          </svg>
          程式語言論壇網 測試頁面
        </a>
        <!-- 第一部份：手機版 -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#linkbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- 第二部份：桌上型電腦版 -->
        <div class="collapse navbar-collapse justify-content-end" id="linkbar">
          <!-- 下拉選項 -->
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="home.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">會員中心</a>
              <ul class="dropdown-menu dropdown-menu-end rounded-0" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item">ID：Admin</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">登入/註冊</a></li>
                <li><a class="dropdown-item" href="#">我的文章</a></li>
                <li><a class="dropdown-item" href="#">收藏文章</a></li>
              </ul>
              <!--? 登入彈窗 -->
              <div class="modal fade " id="loginModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content rounded-4 shadow">
                    <!--? Header -->
                    <div class="modal-header p-5 pb-4 border-bottom-0 ">
                      <h1 class="fw-bold mb-0 fs-2 ">會員登入</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--? Body -->
                    <div class="modal-body p-5 pt-0">
                      <form class="" method="post" action="login.php">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="Account" required>
                          <label for="floatingInput">帳 號</label>

                        </div>
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" required>
                          <label for="floatingPassword">密 碼</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary2" type="submit">登 入</button>

                        <div class="form-group">
                          <input type="checkbox" class="remember">
                          <small class="text-muted">記住我</small>
                        </div>
                        <!--? Footer -->
                        <div class="modal-footer">
                          <a href="#" type="button" class="signup text-decoration-none" data-bs-toggle="modal" data-bs-target="#signupModal">註冊</a>
                          <span>成為會員</span>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 登入彈窗 結束 -->
              <!--? 註冊彈窗 -->
              <div class="modal fade " id="signupModal">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content rounded-4 shadow">
                    <!--? Header -->
                    <div class="modal-header p-5 pb-4 border-bottom-0 ">
                      <h1 class="fw-bold mb-0 fs-2 ">會員註冊</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--? Body -->
                    <div class="modal-body p-5 pt-0">
                      <form class="" method="POST" action="signup.php">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control rounded-3" id="floatingname" placeholder="text" name="username" required>
                          <label for="floatingname">帳 號</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="email" class="form-control rounded-3" id="floatingemail" placeholder="name@example.com" required>
                          <label for="floatingemail">信 箱</label>
                        </div>
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password" name="userpassword" required>
                          <label for="floatingPassword">密 碼</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary2" type="submit">註冊</button>
                      </form>
                      <!--? Footer -->
                      <div class="modal-footer">
                        <span>已有帳號?</span>
                        <a href="#" type="button" class="login" data-bs-toggle="modal" data-bs-target="#loginModal">登入</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--? 註冊彈窗 結束 -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container mb-sm-4 vh-100  ">
      <div class="row px-4 vh-100">
        <div class="col-sm-2">
          <div class="p-3 h-100  rounded-2 bg-light">
            <div class="h5">看 板 列 表</div>
            <nav class="nav flex-column ">
              <?php
              while ($row_result_lang = $result_lang->fetch_assoc()) {
                echo "<a class='nav-link' href='test.php?num_lang=" . $row_result_lang["language_id"] . "'>" . $row_result_lang["name"] . "</a>";
              }
              $db_link->close();
              ?>
            </nav>
          </div>
        </div>
        <div class="col-sm-10 text-center">
          <div class="p-3 h-100  rounded-2 bg-light">對應語言文章
          <?php echo "<h3>" . $num_lang . "</h3>"; ?>

            <!--呼叫文章測試-->
            <?php
            while($row_result_articles = $result_articles_limit->fetch_assoc()){
              echo "#" . $row_result_articles["article_id"]  ." ". $row_result_articles["title"] .  "<br>";
              echo "會員編號:" . $row_result_articles["member_id"] . "<br>";
              echo "語言編號:" . $row_result_articles["language_id"] . "<br>";
              echo "標籤編號:" . $row_result_articles["tag_id"] . "<br>";
              echo "內文:" . $row_result_articles["content"] . "<br>";
              echo "創建時間:" . $row_result_articles["created_at"] . "<br>";
              echo "最後修改時間:" . $row_result_articles["updated_at"] . "<br>";
              echo "<hr>";
            }
            
            ?>

            <!--翻頁-->
          </div>
        </div>
      </div>
    </div>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>

</body>

</html>
<!-- 文章測試
<div class="articles">
              <div class="d-flex border rounded-2 mb-sm-2">
                <div class="flex-shrink-0">
                  <svg class="bd-placeholder-img" width="150" height="150" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="佔位元：圖像" preserveAspectRatio="xMidYMid slice" focusable="false" _mstaria-label="21298277">
                    <title _mstHash="2134210" _mstTextHash="6393283">佔位 元</title>
                    <rect width="100%" height="100%" fill="#e5e5e5"></rect><text x="50%" y="50%" fill="#999" dy=".3em" _mstHash="2650934" _mstTextHash="4180202">圖像</text>
                  </svg>
                </div>
                <div class="flex-grow-1 ms-3" _msthash="1738906" _msttexthash="295124713">這是來自媒體元件的一些內容。您可以將其替換為任何內容並根據需要進行調整。</div>
              </div>
            </div>-->