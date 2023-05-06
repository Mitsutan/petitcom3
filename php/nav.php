<nav id="navigation">
    <div class="container-fluid m-0 bg-dark bg-gradient">
        <div class="row">
            <div class="col my-auto p-2 p-md-1">
                <a href="index.php"><img src="./img/logo.png" alt="プチコン３号作品倉庫" id="logo"></a>
            </div>
            <div class="col d-none d-md-block">
                <ul>
                    <?php
                    if (isset($_SESSION['login_id'])) {
                        echo '<li><a href="./php/logout.php">ログアウト</a></li>';
                        echo '<li><a href="./writing.php">新規記事投稿</a></li>';
                        if ($_SESSION['login_auth'] >= 1) {
                            echo '<li><a href="./mypage.php">プロフィール</a></li>';
                        }
                    } else {
                        echo '<li><a href="./login.php">ログイン</a></li>';
                    }
                    ?>
                    <li><a href="./search.php">検索</a></li>
                    <li><a href="./contact.php">問い合わせ</a></li>
                    <li><a href="./readme.php">READ ME</a></li>
                </ul>
            </div>
            <div class="col d-block d-md-none my-1">
                <details>
                    <summary>=</summary>
                    <ul>
                    <?php
                    if (isset($_SESSION['login_id'])) {
                        echo '<li><a href="./php/logout.php">ログアウト</a></li>';
                        echo '<li><a href="./writing.php">新規記事投稿</a></li>';
                        if ($_SESSION['login_auth'] >= 1) {
                            echo '<li><a href="./mypage.php">プロフィール</a></li>';
                        }
                    } else {
                        echo '<li><a href="./login.php">ログイン</a></li>';
                    }
                    ?>
                    <li><a href="./search.php">検索</a></li>
                    <li><a href="./contact.php">問い合わせ</a></li>
                    <li><a href="./readme.php">READ ME</a></li>
                </ul>
                </details>
            </div>
        </div>
    </div>
</nav>
