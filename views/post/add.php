<?php
use yii\helpers\Html;
?>
<h1>Добавить пост</h1>
<form action="skulkov.yii.loc/web/index.php?r=post/preview" method="get">
    <div>
        <label>Заголовок</label>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>Текст</label>
        <textarea name="text" rows="6" required></textarea>
    </div>
    <button type="submit">Предпросмотр</button>
</form>
