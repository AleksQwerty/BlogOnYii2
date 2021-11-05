<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string|null $title Заголовок тега
 *
 * @property ArticleTagRelation[] $articleTagRelations
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
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
            'id' => 'ID',
            'title' => 'Заголовок тега',
        ];
    }

    /**
     * Gets query for [[ArticleTagRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTagRelations()
    {
        return $this->hasMany(ArticleTagRelation::className(), ['tag_id' => 'id']);
    }
}
