<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="col-md-12">
    <h1>Добавление статьи</h1>
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    
    <?= $form->field($article, 'title')->textInput(['maxlength' => true])->label('Заголовок статьи') ?>
    
    <?= $form->field($article, 'name')->textInput(['maxlength' => true])->label('Название статьи') ?>
    
    <?= $form->field($article, 'content')->textarea(['rows' => 8])->label('Содержание статьи') ?>
    
    <?= $form->field($article, 'img')->fileInput()->label('Изображение (jpg, png, webp)') ?>
    
    <div class="form-group mt-4">
        <?= Html::submitButton('Создать статью', ['class' => 'btn btn-success btn-lg']) ?>
        <?= Html::a('Отмена', ['all'], ['class' => 'btn btn-secondary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>