<?php
namespace app\controllers;
use yii\web\Controller;

class SayController extends Controller{
    public function actionIndex()
    {
        $param = \Yii::$app->request->get('param', 'Параметр не указан');

        return $this -> render('index', ['param' => $param]);
    }

    public function actionSay($message = 'васап')
    {
        return $this->render('say', ['message' => $message]);
    }
}