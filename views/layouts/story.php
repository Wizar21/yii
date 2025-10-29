<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\StoryAsset;
StoryAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Clean Layout</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="clean-wrapper">
    <header class="clean-header">
        <div class="clean-header-container">
            <a href="<?= Url::to(['/']) ?>" class="clean-logo">
                <span>Articles</span>
            </a>
            <nav class="clean-nav">
                <a href="<?= Url::to(['article/all']) ?>" class="clean-nav-link active">Все статьи</a>
                <a href="<?= Url::to(['article/index', 'id' => 1]) ?>" class="clean-nav-link">Технологии</a>
                <a href="<?= Url::to(['article/index', 'id' => 2]) ?>" class="clean-nav-link">Дизайн</a>
                <a href="<?= Url::to(['article/index', 'id' => 3]) ?>" class="clean-nav-link">Разработка</a>
            </nav>
        </div>
    </header>

    <main class="clean-main">
        <div class="clean-content">
            <div class="content-decoration"></div>
            <?= $content ?>
        </div>
    </main>

    <footer class="clean-footer">
        <div class="clean-footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="<?= Url::to(['/']) ?>" class="footer-logo">
                        <span>Articles</span>
                    </a>
                    <p class="footer-description">
                        Современная платформа для публикации статей и блогов. 
                        Чистый дизайн, удобный интерфейс и мощный функционал.
                    </p>
                </div>
                
                <div class="footer-section">
                    <h3>Навигация</h3>
                    <div class="footer-links">
                        <a href="<?= Url::to(['article/all']) ?>" class="footer-link">Все статьи</a>
                        <a href="<?= Url::to(['site/index']) ?>" class="footer-link">Главная</a>
                        <a href="<?= Url::to(['test/index']) ?>" class="footer-link">Тесты</a>
                        <a href="<?= Url::to(['post/index']) ?>" class="footer-link">Блог</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3>Ресурсы</h3>
                    <div class="footer-links">
                        <a href="#" class="footer-link">Документация</a>
                        <a href="#" class="footer-link">Поддержка</a>
                        <a href="#" class="footer-link">API</a>
                        <a href="#" class="footer-link">Статус</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; <?= date('Y') ?>Все права защищены.
                </div>
                <div class="social-links">
                    <a href="#" class="social-link">Twitter</a>
                    <a href="#" class="social-link">GitHub</a>
                    <a href="#" class="social-link">LinkedIn</a>
                    <a href="#" class="social-link">Telegram</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>