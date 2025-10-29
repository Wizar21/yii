<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Article extends ActiveRecord
{
    public $created_at; 
    public $updated_at; 

    public function rules()
    {
        return [
            [['title', 'content', 'user_id'], 'required'],
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['title', 'name', 'img'], 'string', 'max' => 255],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function() {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (empty($this->name)) {
                $this->name = $this->title;
            }
            return true;
        }
        return false;
    }

    public static function tableName()
    {
        return 'article'; 
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getComments()
{
    return $this->hasMany(Comment::class, ['article_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
}
    
}