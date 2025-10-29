<?php
namespace app\models;
use yii\base\Model;

class ArticleForm extends Model{
    public $title;
    public $name;
    public $content;
    public $img;

    public function rules()
{
    return [
        
        [['title', 'name', 'content'], 'required'],
        [['img'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        
    ];
}
}