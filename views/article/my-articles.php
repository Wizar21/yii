<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Мои статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="my-articles">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="header-actions">
            <?= Html::a('Добавить статью', ['add'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Все статьи', ['all'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <div class="articles-count">
        Всего ваших статей: <strong><?= count($articles) ?></strong>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <h3>У вас пока нет статей</h3>
            <p>Создайте свою первую статью и поделитесь знаниями с миром!</p>
            <?= Html::a('Создать первую статью', ['add'], ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    <?php else: ?>
        <div class="articles-grid">
            <?php foreach ($articles as $article): ?>
                <div class="article-card">
                    <?php if (!empty($article->img)): ?>
                    <div class="article-card-image">
                        <img src="<?= Yii::getAlias('@web/img/' . Html::encode($article->img)) ?>" 
                             alt="<?= Html::encode($article->title) ?>" 
                             class="img-fluid"
                             style="width: 350px; height: 200px; object-fit: cover;">
                    </div>
                    <?php endif; ?>
                    
                    <div class="article-card-body">
                        <div class="article-header">
                            <span class="article-card-id">ID: <?= $article->id ?></span>
                            <span class="article-status">
                                <?= $article->status ?? 'Опубликована' ?>
                            </span>
                        </div>
                        
                        <h3 class="article-card-title">
                            <?= Html::encode($article->title) ?>
                        </h3>
                        
                        <h4 class="article-card-name">
                            <?= Html::encode($article->name) ?>
                        </h4>
                        
                        <div class="article-meta">
                            <div class="meta-item">
                                <strong>Создана:</strong> 
                                <?php if ($article->created_at): ?>
                                    <?= Yii::$app->formatter->asDatetime($article->created_at) ?>
                                <?php else: ?>
                                    <span class="text-muted">Не указана</span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($article->updated_at && $article->updated_at != $article->created_at): ?>
                            <div class="meta-item">
                                <strong>Обновлена:</strong> 
                                <?= Yii::$app->formatter->asDatetime($article->updated_at) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <p class="article-card-content">
                            <?= Html::encode(mb_substr($article->content, 0, 120)) ?>...
                        </p>
                        
                        <div class="article-actions">
                            <?= Html::a('Читать', ['index', 'id' => $article->id], [
                                'class' => 'btn btn-primary btn-sm'
                            ]) ?>
                            
                            <?= Html::a('Редактировать', ['update', 'id' => $article->id], [
                                'class' => 'btn btn-outline-secondary btn-sm'
                            ]) ?>
                            
                            <?= Html::a('Удалить', ['delete', 'id' => $article->id], [
                                'class' => 'btn btn-outline-danger btn-sm',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить эту статью?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.article-card-image img {
    width: 350px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
    margin-bottom: 10px;
}
</style>