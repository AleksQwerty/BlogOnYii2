<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag_relation}}`.
 */
class m211009_160152_create_article_tag_relation_table extends Migration
{
    private const TABLE_NAME = 'article_tag_relation';
    private const FOREIGN_KEY_NAME_ARTICLE = 'fk_article_article_id';
    private const INDEX_NAME_ARTICLE = 'idx_article_article_id';
    private const FOREIGN_KEY_NAME_TAG = 'fk_tag_tag_id';
    private const INDEX_NAME_TAG = 'idx_tag_tag_id';


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            self::TABLE_NAME,
            [
                'id'         => $this->primaryKey(),
                'article_id' => $this->integer()->comment('Id статьи'),
                'tag_id'     => $this->integer()->comment('Id тега')
            ]
        );

        $this->createIndex(
            self::INDEX_NAME_ARTICLE,
            self::TABLE_NAME,
            'article_id'
        );

        $this->addForeignKey(
            self::FOREIGN_KEY_NAME_ARTICLE,
            self::TABLE_NAME,
            'article_id',
            'article',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            self::INDEX_NAME_TAG,
            self::TABLE_NAME,
            'tag_id'
        );

        $this->addForeignKey(
            self::FOREIGN_KEY_NAME_TAG,
            self::TABLE_NAME,
            'tag_id',
            'tag',
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
        $this->dropIndex(self::INDEX_NAME_ARTICLE, self::TABLE_NAME);
        $this->dropForeignKey(self::FOREIGN_KEY_NAME_ARTICLE, self::TABLE_NAME);
        $this->dropIndex(self::INDEX_NAME_TAG, self::TABLE_NAME);
        $this->dropForeignKey(self::FOREIGN_KEY_NAME_TAG, self::TABLE_NAME);
    }
}
