<!--測試區-->
<?php
include("connMySQL.php");

//程式語言類別-資料庫搜尋 language:lang
$SQLQuery_language = "SELECT * FROM language_type WHERE 1";
$result_lang = $db_link->query($SQLQuery_language);

//用戶選擇看板文章-資料庫搜尋 
//預設顯示程式看板 (預設lang_type:1 HTML)
$num_lang = 1;
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
$SQLQuery_articles = "SELECT article_id,members.username,language_type.language_name,tags_type.tag_name,articles.title,articles.content,articles.created_at,articles.updated_at
FROM `articles`
INNER JOIN members ON articles.member_id = members.member_id
INNER JOIN language_type ON articles.language_id = language_type.language_id
INNER JOIN tags_type ON articles.tag_id = tags_type.tag_id
WHERE articles.language_id = {$num_lang} ";
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

<body>
  <main>
    <nav class="navbar navbar-expand-lg mb-lg-4 navbar-light bg-primary2">
      <div class="container">
        <!-- 品牌logo -->
        <a class="navbar-brand text-white" href="#">
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
              <a class="nav-link dropdown-toggle text-white" href="home.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">會員中心</a>
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
    <div class="container-md mb-lg-2">
      <div class="row px-4">
        <!--左側看板島行列-->
        <!--左側看板有時間補lg以下顯示下拉選單-->
        <div class="col-lg-2">
          <div class="p-3 rounded-2 bg-light h-100">
            <div class="h5 text-primary2">看 板 列 表</div>
            <nav class="nav flex-column ">
              <?php
              while ($row_result_lang = $result_lang->fetch_assoc()) {
                if ($row_result_lang["language_id"] == $num_lang) {
                  echo "<a class='nav-link text-white bg-primary2 rounded active' href='test.php?num_lang= {$row_result_lang["language_id"]} '>" . $row_result_lang["language_name"] . "</a>";
                } else {
                  echo "<a class='nav-link text-black ' href='test.php?num_lang= {$row_result_lang["language_id"]} '>" . $row_result_lang["language_name"] . "</a>";
                }
              }
              $db_link->close();
              ?>
            </nav>
          </div>
        </div>
        <!--文章列-->
        <div class="col-lg-10 ">
          <div class="p-3 h-100 rounded-2 bg-light">
            <div class="row justify-content-md-center">
              <div class="d-flex flex-row-reverse mb-2">
                <button type="button" class="btn btn-primary2 text-white float-right" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                  </svg>
                  新增文章
                </button>
              </div>

              <div class="row mb-2">
                <?php while ($row_result_articles = $result_articles_limit->fetch_assoc()) { ?>
                  <div class="col-md-12">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-150 position-relative">
                      <div class="col p-4 d-flex flex-column position-static ">
                        <div class="hstack gap-2">
                          <strong class="d-inline-block mb-2 text-warning">#<?php echo $row_result_articles["article_id"] ?></strong>
                          <strong class="d-inline-block mb-2 text-primary2">#<?php echo $row_result_articles["language_name"] ?></strong>
                          <strong class="d-inline-block mb-2 text-primary2">#<?php echo $row_result_articles["tag_name"] ?></strong>
                          <strong class="d-inline-block mb-2 ms-auto text-primary2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                            </svg>
                            <?php echo $row_result_articles["username"] ?>
                          </strong>
                        </div>
                        <h5 class="mb-0"><?php echo $row_result_articles["title"] ?></h5>
                        <p class="card-text mb-auto"><?php echo mb_strimwidth($row_result_articles["content"], 0, 20) . " . . ." ?></p>
                        <div class="hstack gap-2">
                          <div class="mb-1 text-muted">創建時間：<?php echo $row_result_articles["created_at"] ?></div>
                          <div class="mb-1 text-muted ">|</div>
                          <div class="mb-1 text-muted">最後修改時間：<?php echo $row_result_articles["updated_at"] ?></div>
                          <a href="#" class="stretched-link ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-angle-expand text-black" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z" />
                            </svg></a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <!-- while end-->
              </div>
            </div>
            <div class="row">
              <!--翻頁-->
              <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center">
                  <?php for ($i = 1; $i <= $totoal_pages; $i++) {
                    if ($i == $num_pages) {
                      echo "<li class='page-item ' aria-current='page'>
                            <span class='page-link text-white bg-primary2' href='test.php?num_lang={$num_lang}&num_pages={$i}'>" . $i . "</span></li>";
                    } else {
                      echo "<li class='page-item'><a class='page-link'  href='test.php?num_lang={$num_lang}&num_pages={$i}'>" . $i . "</a></li>";
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
  </main>
</body>

</html>