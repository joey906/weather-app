<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>WeatherApp</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header-wrapper clear">
                <div class="left">
                    <h1>お天気予報アプリ</h1>
                </div>
                <div class="right">
                    <ul class="contents">
                        <li class="content"><?= $this->Html->link('ログイン', '/users/loginf');?></li>
                        <li class="content"><?= $this->Html->link('新規登録', '/users/newForm');?></li>
                    </ul>
                </div>
                
            </div>
            <div class="flash">
            <?php if (isset($msg) !== false):?>
                <?= $msg?>
            <?php endif;?>
            </div>
        </div>
    </header>

 

    <div class="top">
        <div class="container">
            <div class="top-wrapper">
                <h1>
                    お天気予報アプリでお天気情報を把握しよう！
                </h1>
                <p>登録するだけで毎朝天気を通知してくれる特典付き！</p>
            </div>
        </div>
    </div>

    <main>
        <div class="container">
            <div class="main-wrapper">
                <div class="main-left">
                    <img src="img/wanko.png" alt="">
                </div>
                <div class="main-right">
                    <h2>お天気アプリでできること</h2>
                    <p>
                        お天気アプリでは3時間ごとの天気を見ることができます。
                        だから傘が必要なのどうかは一目瞭然です。
                        また、お天気アプリを見るのを忘れてしまう日があっても、
                        毎朝天気を通知してくれるのでその日のお天気情報がわか
                        らなくなるということはありません！
                    </p>
                </div>
            </div>
        </div>
    </main>
    <div class="login">
        <div class="container">
            <div class="login-wrapper">
                <div class="con">
                    <h2>早速始める！</h2>
                </div>
                <div class="btn">
                    <div class="login-btn">
                    <?= $this->Html->link('ログイン', '/users/loginf');?>
                    </div>
                    <div class="new-btn">
                    <?= $this->Html->link('新規登録', '/users/newForm');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">

        </div>
    </footer>
</body>
</html>

