<nav id="navigation">
    <div class="container-fluid m-0 bg-dark bg-gradient">
        <div class="row">
            <div class="col">
                <a href="index.html"><img src="" alt="プチコン３号作品倉庫（ロゴ画像未定）"></a>
            </div>
            <div class="col">
                <ul>
                    <?php
                    if (isset($_SESSION['login_id'])) {
                        echo '<li><a href="./php/logout.php">ログアウト</a></li>';
                        echo '<li><a href="./writing.html">新規記事投稿</a></li>';
                        if ($_SESSION['login_auth'] >= 1) {
                            echo '<li><a href="./mypage.html">プロフィール</a></li>';
                        }
                    } else {
                        echo '<li><a href="./login.html">ログイン</a></li>';
                    }
                    ?>
                    <li><a href="./search.html">検索</a></li>
                    <li><a href="./contact.html">問い合わせ</a></li>
                    <li><a href="./readme.html">READ ME</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
