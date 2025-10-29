<?php
use yii\bootstrap5\Html;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
    <?= $this->params['login'] ?>
    <div class="container">
        <div class="row">
            <?= $content ?>
        </div>
    </div>
    
</body>
</html>