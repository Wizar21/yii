<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Html::encode($article->title);
$this->params['breadcrumbs'][] = ['label' => 'Все статьи', 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h1><?= Html::encode($this->title) ?></h1>

<p><strong>Автор:</strong> <?= Html::encode($article->author->name ?? 'Неизвестен') ?></p>
<p><strong>Дата создания:</strong> <?= Yii::$app->formatter->asDatetime($article->created_at, 'php:d.m.Y H:i:s') ?></p> 
<?php if ($article->updated_at && $article->updated_at != $article->created_at): ?>
    <p><strong>Дата обновления:</strong> <?= Yii::$app->formatter->asDatetime($article->updated_at, 'php:d.m.Y H:i:s') ?></p>
<?php endif; ?>
<p><?= nl2br(Html::encode($article->content)) ?></p>

<?php if ($article->img): ?>
    <img src="<?= Yii::getAlias('@web/img/' . Html::encode($article->img)) ?>" alt="<?= Html::encode($article->title) ?>" class="img-fluid" style="max-width: 100%; height: auto;">
<?php endif; ?>
<br><br>

<?php if ($article->user_id === Yii::$app->user->id): ?>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $article->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $article->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту статью?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php endif; ?>


<?php if (!Yii::$app->user->isGuest): ?>
<div class="comment-form mt-5">
    <h3>Добавить комментарий</h3>
    <?php $form = ActiveForm::begin([
        'action' => ['comment/create', 'article_id' => $article->id],
    ]); ?>
    
    <?= $form->field($comment, 'content')->textarea(['rows' => 3, 'placeholder' => 'Введите ваш комментарий...'])->label(false) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Добавить комментарий', ['class' => 'btn btn-primary']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
<?php else: ?>
    <div class="alert alert-info mt-5">
        <a href="<?= \yii\helpers\Url::to(['site/login']) ?>">Войдите</a>, чтобы оставить комментарий.
    </div>
<?php endif; ?>

<div class="comments mt-5">
    <h3>Комментарии (<?= count($article->comments) ?>)</h3>
    
    <?php if (empty($article->comments)): ?>
        <p class="text-muted">Комментариев пока нет. Будьте первым!</p>
    <?php else: ?>
        <?php foreach ($article->comments as $comment): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title"><?= Html::encode($comment->user->name ?? 'Неизвестен') ?></h6>
                            <p class="card-text"><?= nl2br(Html::encode($comment->content)) ?></p>
                            <small class="text-muted"><?= Yii::$app->formatter->asDatetime($comment->created_at, 'php:d.m.Y H:i:s') ?></small>
                        </div>
                        <?php if (!Yii::$app->user->isGuest && $comment->user_id === Yii::$app->user->id): ?>
                            <?= Html::a('Удалить', ['comment/delete', 'id' => $comment->id], [
                                'class' => 'btn btn-outline-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить этот комментарий?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<a href="<?= \yii\helpers\Url::to(['article/all']) ?>">Назад к списку статей</a>