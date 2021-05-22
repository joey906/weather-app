<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/form.css">
    <title>WeatherApp</title>
</head>
<body>
    <section class="login">
    <div class="container">
        <div class="form-wrapper">
        <h2>新規登録</h2>
        <div class="wrap">
            <form action="/users/add" method="post">
            <input
                type="hidden" name="_csrfToken" autocomplete="off"
                value="<?= $this->request->getAttribute('csrfToken') ?>">
                <div class="form-wrap"><input type="text" name="name" placeholder="名前"></div>
                <div class="form-wrap"><input type="password" name="pass" placeholder="パスワード"></div>
                <div class="form-wrap"><input type="email" name="email" placeholder="email"></div>
                <div class="form-wrap">
                <select name="prefecture">
                    <?php for ($i = 0; $i <count($arr1['marker']); $i++):?>
                    <option name="pref" value=<?= $arr1['marker'][$i]['pref']?>><?= $arr1['marker'][$i]['pref']?></option>
                    <?php endfor;?>
                </select>
                </div>
                
                <div class="form-wrap"><input type="submit" value="submit"></div>
            </form>
        </div>
        </div>
        
    </div>
    </section>
    
</body>
</html>