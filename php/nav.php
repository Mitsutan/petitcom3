<?php
    echo '<nav id="navigation">';
    echo '<div class="container-fluid m-0 bg-dark bg-gradient">';
    echo '<div class="row">';
    echo '<div class="col">';
    echo '<a href="index.html"><img src="" alt="プチコン３号作品倉庫"></a>';
    echo '</div>';
    echo '<div class="col">';
    echo '<ul>';
    if (isset($_SESSION['login_id'])) {
        echo '<li><a href="./php/logout.php">ログアウト</a></li>';
        echo '<li><a href="./writing.html">新規記事投稿</a></li>';
    } else {
        echo '<li><a href="./login.html">ログイン</a></li>';
    }
    echo '<li><a href="./search.html">検索</a></li>';
    echo '<li><a href="./contact.html">問い合わせ</a></li>';
    echo '<li><a href="./readme.html">READ ME</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
?>