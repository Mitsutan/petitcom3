<?php
    // セッション
    session_start();

    // データベースマネージャの読込
    require_once "./DBManager.php";
    $db = new DBManager();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        try {
            $db->submitUser($_POST['mail'], $_POST['name'], $_POST['pass'], $_POST['nnid']);
        } catch(LogicException $e) {
            echo $e->getMessage();
        } catch(PDOException $e) {
            echo '['.$e->getCode().']';               
            if($e->getCode() == '23000') {
                echo 'このメールアドレスは既に登録されています。<br />';
            }
            if($e->getCode() == '2002') {
                echo '情報の登録に失敗しました。<br />しばらく時間をおいて再度お試しください。';
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }

            // 新規登録完了
            echo '登録中...';
            // $_SESSION['login_id'] = $_POST["mail"];
            // $_SESSION['login_ln'] = $_POST['sei'];
            // $_SESSION['login_fn'] = $_POST['name'];
            // $_SESSION['login_post'] = $_POST['post'];
            // $_SESSION['login_pref'] = $_POST['pref'];
            // $_SESSION['login_ad1'] = $_POST['ad1'];
            // $_SESSION['login_ad2'] = $_POST['ad2'];
            // echo "<script>location.replace('./user_kanryo.html');</script>";
            exit;
    }
?>
