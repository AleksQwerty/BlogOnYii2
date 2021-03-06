<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int         $id
 * @property string|null $title Заголовок  категории
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'title' => 'Заголовок  категории',
        ];
    }

    /**
     * Достаем все статьи по данной категории
     *
     * @return ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']);
    }

    public function getArticlesCount()
    {
        return $this->getArticles()->count();
    }

    public static function getAllCategory()
    {
        return self::find()->all();
    }

}
