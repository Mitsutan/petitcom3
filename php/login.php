<?php
    // セッション
    session_start();
        if (isset($_SESSION['login_id'])) {
            header("Location: ./../index.html");
        }
    // データベースマネージャの読込
    require_once "./php/DBManager.php";
    $db = new DBManager();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        try {
            $result = $db->loginUser($_POST["mail"],$_POST["pass"]);
            // ユーザ情報をセッション変数に入れてトップページに飛ばす
            // $_SESSION['login_id'] = $result['customers_mail'];
            // $_SESSION['login_ln'] = $result['customers_ln'];
            // $_SESSION['login_fn'] = $result['customers_fn'];
            // $_SESSION['login_post'] = $result['customers_postcode'];
            // $_SESSION['login_pref'] = $result['customers_pref'];
            // $_SESSION['login_ad1'] = $result['customers_address'];
            // $_SESSION['login_ad2'] = $result['customers_subaddress'];
            echo "<script>location.replace('../index.html');</script>";
        } catch(PDOException $e) {
            if($e->getCode() == '2002') {
                echo '情報の登録に失敗しました。<br />しばらく時間をおいて再度お試しください。';
            }
        } catch(Exception $e) {
            // エラー表示
            echo $e->getMessage();
        }
        
    }
?>