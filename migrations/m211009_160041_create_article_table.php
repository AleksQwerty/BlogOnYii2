<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m211009_160041_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%article}}',
            [
                'id'          => $this->primaryKey(),
                'title'       => $this->string()->comment('Заголовок статьи'),
                'description' => $this->text()->comment('Описание статьи'),
                'content'     => $this->text()->comment('Содержимое статьи'),
                'created_at'  => $this->date()->comment('Дата создания статьи'),
                'image'       => $this->string(),
                'viewed'      => $this->integer()->defaultValue(0)->comment('Количество просмотров статьи'),
                'user_id'     => $this->integer()->comment('Id пользователя написавшего статью'),
                'status'      => $this->integer()->comment('Статус статьи'),
                'category_id' => $this->integer()->comment('Категория статьи')
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
