<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description Описание статьи
 * @property string|null $content Содержимое статьи
 * @property string|null $created_at Дата создания статьи
 * @property string|null $image
 * @property int|null $viewed Количество просмотров статьи
 * @property int|null $user_id Id пользователя написавшего статью
 * @property int|null $status Статус статьи
 * @property int|null $category_id Категория статьи
 *
 * @property ArticleTagRelation[] $articleTagRelations
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
            [['created_at'], 'date', 'format' => 'php:Y-m-d'],
            [['created_at'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок статьи',
            'description' => 'Описание статьи',
            'content' => 'Содержимое статьи',
            'created_at' => 'Дата создания статьи',
            'image' => 'Image',
            'viewed' => 'Количество просмотров статьи',
            'user_id' => 'Id пользователя написавшего статью',
            'status' => 'Статус статьи',
            'category_id' => 'Категория статьи',
        ];
    }

    /**
     * Gets query for [[ArticleTagRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTagRelations()
    {
        return $this->hasMany(ArticleTagRelation::className(), ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
}
