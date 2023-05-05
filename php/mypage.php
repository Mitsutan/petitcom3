<?php
    // セッション
    session_start();

    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    $db->OutPutlog();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $db->editUser($_SESSION['login_id'], $_POST['mail'], $_POST['name'], $_POST['nnid'], htmlspecialchars($_POST['description'], ENT_QUOTES));
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        echo '登録中...';
        echo "<script>location.replace('../mypage.php');</script>";
        exit;
        
    }
?>