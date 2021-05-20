<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherApp</title>
    <?php
        echo $this->fetch('meta');
        echo $this->Html->css('reset.css');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>
</head>
<body>
    <div>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>