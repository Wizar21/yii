<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Все статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-all">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="header-actions">
                <?= Html::a('Мои статьи', ['my-articles'], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::a('Добавить статью', ['add'], ['class' => 'btn btn-success']) ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="articles-count">
        Всего статей: <strong><?= count($articles) ?></strong>
    </div>
    
    <div class="articles-grid">
        <?php foreach ($articles as $article): ?>
            <div class="article-card">
                <?php if (!empty($article->img)): ?>
                <div class="article-card-image">
                    <img src="<?= Yii::getAlias('@web/img/' . Html::encode($article->img)) ?>" 
                         alt="<?= Html::encode($article->title) ?>" 
                         class="img-fluid">
                </div>
                <?php endif; ?>
                
                <div class="article-card-body">
                    <span class="article-card-id">ID: <?= $article->id ?></span>
                    <h3 class="article-card-title"><?= Html::encode($article->title) ?></h3>
                    
                    <div class="article-meta">
                        <div class="meta-item">
                            <strong>Автор:</strong> 
                            <?= $article->author ? Html::encode($article->author->name) : 'Неизвестен' ?>
                        </div>
                        
                        <div class="meta-item">
                            <strong>Создана:</strong> 
                            <?= Yii::$app->formatter->asDatetime($article->created_at) ?>
                        </div>
                        
                        <?php if ($article->updated_at && $article->updated_at != $article->created_at): ?>
                        <div class="meta-item">
                            <strong>Обновлена:</strong> 
                            <?= Yii::$app->formatter->asDatetime($article->updated_at) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <p class="article-card-content">
                        <?= Html::encode(mb_substr($article->content, 0, 150)) ?>...
                    </p>
                    
                    <a href="<?= Url::to(['article/index', 'id' => $article->id]) ?>" class="btn btn-primary">
                        Читать далее →
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.article-all { padding: 5px; }
.articles-grid { display: block; }
.article-card { padding: 8px; margin-bottom: 8px; }
.article-card-image img { max-width: 100%; height: auto; display: block; }
</style>