<?php
echo $this->Html->css('form');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>WeatherApp</title>
</head>
<body>
    <section class="login">
    <div class="container">
        <div class="form-wrapper">
        <h2>ログイン</h2>
        <div class="wrap">
        <form action="/users/login" method="post">
                <input
                type="hidden" name="_csrfToken" autocomplete="off"
                value="<?= $this->request->getAttribute('csrfToken') ?>">
                <div class="form-wrap"><input type="text" name="name" placeholder="名前"></div>
                <div class="form-wrap"><input type="password" name="pass" placeholder="パスワード"></div>
                <div class="form-wrap point"><input type="submit" value="submit"></div>
        </form>
        </div>
        </div>  
    </div>
    </section>
    
</body>
</html>