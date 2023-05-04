<?php
    // セッション
    session_start();
        
    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $result = $db->loginUser($_POST["mail"],$_POST["pass"]);
            // ユーザ情報をセッション変数に入れてトップページに飛ばす
            $_SESSION['login_id'] = $result['user_id'];
            $_SESSION['login_auth'] = $result['user_auth'];
            // $_SESSION['login_nnid'] = $result['user_nnid'];
            echo "<script>location.replace('../index.php');</script>";
        } catch(PDOException $e) {
            if($e->getCode() == '2002') {
                echo '失敗しました。<br />しばらく時間をおいて再度お試しください。';
            }
        } catch(Exception $e) {
            // エラー表示
            echo $e->getMessage();
        }
        
    }
?>