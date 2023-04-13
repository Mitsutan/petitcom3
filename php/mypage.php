<?php
    // セッション
    session_start();

    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $db->editUser($_SESSION['login_id'], $_POST['mail'], $_POST['name'], $_POST['nnid'], $_POST['description']);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        echo '登録中...';
        echo "<script>location.replace('../mypage.html');</script>";
        exit;
        
    }
?>