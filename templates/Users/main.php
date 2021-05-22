<?php
echo $this->Html->css('style');
for ($i = 0; $i < count($todayWeather); $i++) {
    $times[] = substr($todayWeather[$i]['dt_txt'], -8);
}

for ($i = 0; $i < count($tomorrowWeather); $i++) {
    $times1[] = substr($tomorrowWeather[$i]['dt_txt'], -8);
}

for ($i = 0; $i < count($nextTwoWeather); $i++) {
    $times2[] = substr($nextTwoWeather[$i]['dt_txt'], -8);
}

for ($i = 0; $i < count($B); $i++) {
    $times3[] = substr($B[$i]['dt_txt'], -8);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css" >
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
                        
                        <li class="content"><a href="/users/logout">ログアウト</a></li>
                    </ul>
                </div>
            </div> 
        </div>
    </header>

    <session class="main2">
        <div class="container">
        <h2 class="greet"><?= $_SESSION['name']."さん こんにちは! ".$_SESSION['pref']."の天気です。"?></h2>
            <div class="main2-wrap">
            
                <div class="main2-wrapper">
                
                <h2>今日の天気:<?= $today?></h2>
                    <table class="table">
                        <thead class="thead">
                        <tr>
                            <?php foreach ($times as $key => $val):?>
                            <th><?= $val?></th>
                            <?php endforeach;?>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                            <?php for ($i = 0; $i < count($todayWeather); $i++):?>
                            <td><?= $todayWeather[$i]['weather'][0]['main']?></td>
                            <?php endfor;?>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="main2-wrapper">
                <h2>明日の天気:<?= $tomorrow?></h2>
                    <table class="table">
                        <thead class="thead">
                        <tr>
                            <?php foreach ($times1 as $key => $val):?>
                            <div class="resCon">
                                <div class="first">
                                    <?php if ($key < 4):?>
                                    <th><?= $val?></th>
                                    <?php endif;?>
                                </div>
                                <div class="second">
                                    <?php if ($key >= 4):?>
                                    <th><?= $val?></th>
                                    <?php endif;?>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                            <?php for ($i = 0; $i < count($tomorrowWeather); $i++):?>
                            <div class="resCon">
                                <div class="first">
                                    <?php if ($i <4):?>
                                        <td><?= $tomorrowWeather[$i]['weather'][0]['main']?></td>
                                    <?php endif;?>
                                    <?php if ($i >= 4):?>
                                        <td><?= $tomorrowWeather[$i]['weather'][0]['main']?></td>
                                    <?php endif;?>
                                </div>
                            </div>
                            
                            <?php endfor;?>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="main2-wrapper">
                <h2>明後日の天気:<?= $nextTwoDay?></h2>
                    <table class="table">
                        <thead class="thead">
                        <tr>
                            <?php foreach ($times2 as $key => $val):?>
                            <th><?= $val?></th>
                            <?php endforeach;?>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                            <?php for ($i = 0; $i < count($nextTwoWeather); $i++):?>
                            <td><?= $nextTwoWeather[$i]['weather'][0]['main']?></td>
                            <?php endfor;?>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="main2-wrapper">
                <h2>明明後日の天気:<?= $a?></h2>
                    <table class="table">
                        <thead class="thead">
                        <tr>
                            <?php foreach ($times2 as $key => $val):?>
                            <th><?= $val?></th>
                            <?php endforeach;?>
                        </tr>
                        </thead>
                        <tbody class="tbody">
                        <tr>
                            <?php for ($i = 0; $i < count($B); $i++):?>
                            <td><?= $B[$i]['weather'][0]['main']?></td>
                            <?php endfor;?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </session>

    <session class="contact">
        <div class="container">
            <div class="contact-head">
                <div class="contact-top">Contact</div>
                <div class="color"></div>
            </div>
            <div class="contact-wrapper">
                <form action="./contact.php" method="post">
                <div class="form">
                    <div class="name">
                        <div>
                            <p>お名前</p>
                        </div>
                    </div>
                    <div>
                        <input name="name1" type="text" value=<?= $_SESSION['name']?>>
                    </div>
                </div>

                <div class="contact-email form">
                    <div class="media">
                        <div class="name">
                            <p>お問い合わせ内容</p>
                        </div>
                        <div>
                            <p class="must">必須</p>
                        </div>
                    </div>
                    
                    <div class="contact-name-content">
                        <textarea name="text1" class="textarea" name="" id="" cols="30" rows="10" placeholder="お問い合わせ内容を入力してください。このような機能があれば嬉しいなど。"></textarea>
                    </div>
                </div>

                <div class="btn clear"><input type="submit" value="submit"></div>
                </form>
            </div>
        </div>
    </session>
</body>
</html>