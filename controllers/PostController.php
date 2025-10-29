<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class PostController extends Controller
{
 function actionIndex()
    {
        return $this->render('index');
    }
    

    public function actionAdd()
    {
        return $this->render('add');
    }
    

    public function actionPreview()
    {
       
        $title = Yii::$app->request->post('title', '');
        $text = Yii::$app->request->post('text', '');
        
        
        if (Yii::$app->request->isPost && ($title || $text)) {
            return $this->render('preview', [
                'title' => $title,
                'text' => $text,
            ]);
        } else {
           
            Yii::$app->session->setFlash('error', 'Данные не были отправлены');
            return $this->redirect(['add']);
        }
    }
}