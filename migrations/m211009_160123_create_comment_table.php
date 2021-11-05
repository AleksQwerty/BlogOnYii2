<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m211009_160123_create_comment_table extends Migration
{
    private const TABLE_NAME = 'comment';
    private const COLUMN_NAME_TABLE_USER = 'user_id';
    private const COLUMN_NAME_TABLE_ARTICLE = 'article_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            self::TABLE_NAME,
            [
                'id'         => $this->primaryKey(),
                'text'       => $this->text(),
                'user_id'    => $this->integer()->comment('Id пользователя, оставившего коментарий'),
                'article_id' => $this->integer()->comment('Id статьи'),
                'status'     => $this->integer()
            ]
        );

        $this->createIndex(
            'idx_post_user_id',
            self::TABLE_NAME,
            self::COLUMN_NAME_TABLE_USER
        );

        $this->addForeignKey(
            'fk_post_user_id',
            self::TABLE_NAME,
            self::COLUMN_NAME_TABLE_USER,
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_article_id',
            self::TABLE_NAME,
            self::COLUMN_NAME_TABLE_ARTICLE
        );

        $this->addForeignKey(
            'fk_article_id',
            self::TABLE_NAME,
            self::COLUMN_NAME_TABLE_ARTICLE,
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
