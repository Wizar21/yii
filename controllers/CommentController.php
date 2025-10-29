<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\models\Comment;
use app\models\Article;

class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCreate($article_id)
    {
        $article = Article::findOne($article_id);
        if (!$article) {
            throw new NotFoundHttpException('Статья не найдена.');
        }

        $comment = new Comment();
        $comment->article_id = $article_id;
        $comment->user_id = Yii::$app->user->id;

        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            Yii::$app->session->setFlash('success', 'Комментарий добавлен');
            return $this->redirect(['article/index', 'id' => $article_id]);
        }

        return $this->redirect(['article/index', 'id' => $article_id]);
    }

    public function actionDelete($id)
    {
        $comment = $this->findModel($id);
        
        if ($comment->user_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('Комментарий не найден.');
        }

        $article_id = $comment->article_id;
        $comment->delete();

        Yii::$app->session->setFlash('success', 'Комментарий удален');
        return $this->redirect(['article/index', 'id' => $article_id]);
    }

    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Комментарий не найден.');
    }
}