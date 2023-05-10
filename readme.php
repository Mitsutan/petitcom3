<?php
// セッション
session_start();

// データベースマネージャの読込
require_once "./php/DBManager.php";
$db = new DBManager();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>プチコン３号作品倉庫 - READ ME</title>
</head>

<body>
    <?php require './php/nav.php'; ?>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12">
                <div class="section">
                    <h1>READ ME</h1>
                    <h2>禁止事項</h2>
                    <p>
                        以下に該当する内容は書き込んではいけません。
                    </p>
                    <ul>
                        <li>閲覧者が不快に感じる内容</li>
                        <li>法令に反する内容</li>
                        <li>個人情報</li>
                        <li>当サイトの趣旨に反する内容</li>
                        <li>なりすまし</li>
                        <li>意図的な記事の重複投稿</li>
                    </ul>
                    <p>
                        上記を含めこちらが問題がある書き込みであると判断した場合は、
                        当該の書き込みを削除したり、書き込みを行ったユーザに制限をかける場合があります。
                    </p>
                    <h2>免責</h2>
                    <p>
                        セキュリティには出来る限り万全を期していますが、素人の趣味制作サイトであるため
                        悪意の第三者による情報漏洩・改ざん・消失等、ユーザによって登録された情報の安全性は保障できません。
                    </p>
                    <p>
                        よって本サービスに関連して生じたユーザおよび第三者の結果的損害、付随的損害、逸失利益等の間接被害について、
                        それらの予見、予見可能性の有無にかかわらず一切の責任を負いません。
                    </p>
                    <p>
                        また当サイトはユーザに予告なくクローズすることがあります。ご了承ください。
                    </p>
                    <h2>利用ガイド</h2>
                    <p>
                        前項「免責」で述べたように情報漏洩の可能性は否定できません。
                        そのためユーザ登録される際にはパスワードを<span class="text-danger fw-bold">絶対にほかのサービスで使用しているものとは
                        異なるもの</span>にしてください。
                        ただしパスワードリセットには基本的に対応しないので忘れないように注意してください。
                    </p>
                    <p>
                        またメールアドレスもgmail、yahoo等のフリーメール、捨てメアドを使用することを推奨します。（現時点ではログインIDとして使用しているのみです。）
                    </p>
                    <p>
                        当サイトは株式会社スマイルブーム様とは一切関係ありませんので、このサイトについての問い合わせ等を行わないでください。
                    </p>
                    <p>
                        2023/4/11 制定
                    </p>
                    <h1>ライセンス</h1>
                    <details>
                        <summary>Trix 2.0.4</summary>
                        <p>
                            MIT License
                        </p>
                        <p>
                            Copyright (c) 2022 37signals, LLC
                        </p>
                        <p>
                            Permission is hereby granted, free of charge, to any person obtaining
                            a copy of this software and associated documentation files (the
                            "Software"), to deal in the Software without restriction, including
                            without limitation the rights to use, copy, modify, merge, publish,
                            distribute, sublicense, and/or sell copies of the Software, and to
                            permit persons to whom the Software is furnished to do so, subject to
                            the following conditions:
                        </p>
                        <p>
                            The above copyright notice and this permission notice shall be
                            included in all copies or substantial portions of the Software.
                        </p>
                        <p>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
                            EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
                            MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
                            NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
                            LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
                            OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
                            WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
